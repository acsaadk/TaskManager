<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use App\Policies\UserPolicy;


class UserController extends Controller
{
    public function create(Request $request) {
      $this->validateCreation($request);
      UserPolicy::create(Auth::user());
      $user = new User();
      $user->first_name = $request->input('first_name');
      $user->last_name = $request->input('last_name');
      $user->email = $request->input('email');
      $user->password = app('hash')->make($request->input('password'));
      $user->isAdmin = $request->input('isAdmin', false);
      $user->save();
      return response($user, 201)->header('Content-Type', 'application/json');
    }

    public function retrieveList() {
      UserPolicy::retrieveList(Auth::user());
      return response()->json(User::all());
    }

    public function retrieve($uid = null) {
      if($uid == null) {
        $user = Auth::user();
      } else {
        $user = User::findOrFail($uid);
        UserPolicy::retrieve(Auth::user(), $user);
      }
      return $user;
    }

    public function delete($uid) {
      $user = User::findOrFail($uid);
      UserPolicy::delete(Auth::user(), $user);
      $user->delete();
      return response(null, 204);
    }

    public function update(Request $request, $uid = null) {
      $user = ($uid == null) ? Auth::user() : User::findOrFail($uid);
      UserPolicy::update(Auth::user(), $user);
      $this->validateEmailOnly($request);
      $user->first_name = $request->input('first_name', $user->first_name);
      $user->last_name = $request->input('last_name', $user->last_name);
      $user->email = $request->input('email', $user->email);
      $user->password = $request->input('password', $user->password);
      $user->save();
      return response()->json($user);
    }

    public function getTasks($uid = null) {
      if($uid == null) {
        $user = Auth::user();
      } else {
        $user = User::findOrFail($uid);
        UserPolicy::retrieveTasks(Auth::user(), $user);
      }
      return $user->tasks;
    }

    private function validateCreation(Request $request) {
      $this->validate($request, [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required'
      ]);
    }

    private function validateEmailOnly(Request $request) {
      $this->validate($request, ['email' => 'email|unique:users']);
    }
}
