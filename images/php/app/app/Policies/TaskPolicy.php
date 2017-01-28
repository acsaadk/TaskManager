<?php

namespace App\Policies;

use App\User;
use App\Task;

class TaskPolicy
{

    public static function create(User $user) {
      !$user->isAdmin && abort(403, 'Unauthorized action');
    }

    public static function update(User $user, Task $task) {
      !($user->isAdmin && $task->creator_id == $user->id) && abort(403, 'Unauthorized action');
    }

    public static function delete(User $user, Task $task) {
      !($user->isAdmin && $task->creator_id == $user->id) && abort(403, 'Unauthorized action');
    }

    public static function retrieveList(User $user) {
      !$user->isAdmin && abort(403, 'Unauthorized action');
    }

    public static function retrieve(User $user, Task $task) {
      !($user->isAdmin || $user->id == $task->assignedTo_id) && abort(403, 'Unauthorized action');
    }
}
