<?php

namespace App\Http\Controllers;

use App\Priority;
use App\Policies\PriorityPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PriorityController extends Controller
{

    public function retrieveList() {
      PriorityPolicy::retrieve(Auth::user());
      return response()->json(Priority::all());
    }

    public function delete($pid) {
      $priority = Priority::findOrFail($pid);
      PriorityPolicy::delete(Auth::user());
      $priority->delete();
      return response(null, 204);
    }

    public function create(Request $request) {
      $this->validateCreaton($request);
      PriorityPolicy::create(Auth::user());
      $priority = Priority::create($request->input('name'));
      return response($priority, 201)->header('Content-Type', 'application/json');
    }

    private function validateCreation(Request $request) {
      $this->validate($request, [
        'name' => 'required|unique:priorities',
      ]);
    }
}
