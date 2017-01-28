<?php

namespace App\Policies;

use App\User;

class UserPolicy
{

    public static function create(User $user) {
      !$user->isAdmin && abort(403, 'Unauthorized action');
    }

    public static function update(User $user, User $userToUpdate) {
      !($user->isAdmin || $user->id == $userToUpdate->id) && abort(403, 'Unauthorized action');
    }

    public static function retrieve(User $user, User $userToRetrieve = null) {
      !($user->isAdmin || ($userToRetrieve != null && $user->id == $userToRetrieve->id))
      && abort(403, 'Unauthorized action');
    }
    public static function retrieveList(User $user) {
      !$user->isAdmin && abort(403, 'Unauthorized action');
    }

    public static function retrieveTasks(User $user, User $userToRetrieveTasks) {
      !($user->isAdmin || ($userToRetrieveTasks != null && $user->id == $userToRetrieveTasks->id))
      && abort(403, 'Unauthorized action');
    }

    public static function delete(User $user, User $userToDelete) {
      !($user->isAdmin && !$userToDelete->isAdmin) && abort(403, 'Unauthorized action');
    }
}
