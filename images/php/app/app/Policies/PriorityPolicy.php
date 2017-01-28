<?php

namespace App\Policies;

use App\User;

class PriorityPolicy
{

    public static function create(User $user) {
      !$user->isAdmin && abort(403, 'Unauthorized action');
    }

    public static function retrieve(User $user) {
      !$user->isAdmin && abort(403, 'Unauthorized action');
    }

    public static function delete(User $user) {
      !$user->isAdmin && abort(403, 'Unauthorized action');
    }
}
