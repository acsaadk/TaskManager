<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;
use App\Policies\TaskPolicy;
use DateTime;
use DateTimeZone;

class TaskController extends Controller
{
    public function create(Request $request) {
      $this->validateCreation($request);
      TaskPolicy::create(Auth::user());
      $task = new Task();
      $task->name = $request->input('name');
      $task->priority_id = $request->input('priority_id');
      $task->due_date = $request->input('due_date');
      $task->description = $request->input('description', '');
      $task->assignedTo_id = $request->input('assignedTo_id');
      Auth::user()->createdTasks()->save($task);
      return response($task, 201)->header('Content-Type', 'application/json');
    }

    public function retrieveList() {
      TaskPolicy::retrieveList(Auth::user());
      return response()->json(Task::all());
    }

    public function retrieve($tid) {
      $task = Task::findOrFail($tid);
      TaskPolicy::retrieve(Auth::user(), $task);
      return $task;
    }

    public function delete($tid) {
      $task = Task::findOrFail($tid);
      TaskPolicy::delete(Auth::user(), $task);
      $task->delete();
      return response(null, 204);
    }

    public function update(Request $request, $tid) {
      $task = Task::findOrFail($tid);
      $this->validateDueDateNotExpired($request);
      TaskPolicy::update(Auth::user(), $task);
      $task->name = $request->input('name', $task->name);
      $task->description = $request->input('description', $task->description);
      $task->due_date = $request->input('due_date', $task->due_date);
      $task->priority = $request->input('priority', $task->priority);
      $task->save();
      return $task;
    }

    private function validateCreation(Request $request, $timezone = 'UTC') {
      $today = new DateTime('now', new DateTimeZone($timezone));
      $this->validate($request, [
        'name' => 'required|unique:tasks',
        'priority_id' => 'required|exists:priorities,id',
        'assignedTo_id' => 'required|exists:users,id',
        'due_date' => 'required|after:' . $today->format('Y/m/d')
      ]);
    }

    private function validateDueDateNotExpired(Request $request, $timezone = 'UTC') {
      $today = new DateTime('now', new DateTimeZone($timezone));
      $this->validate($request, [
        'due_date' => 'after:' . $today->format('Y/m/d')
      ]);
    }
}
