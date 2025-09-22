<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
//    /**
//     * Determine whether the user can view any models.
//     */
//    public function viewAny(UserController $user): bool
//    {
//        //
//    }
//
//    /**
//     * Determine whether the user can view the model.
//     */
//    public function view(UserController $user, UserController $model): bool
//    {
//        //
//    }
//
//    /**
//     * Determine whether the user can create models.
//     */
//    public function create(UserController $user): bool
//    {
//        //
//    }
//
//    /**
//     * Determine whether the user can update the model.
//     */
//    public function update(UserController $user, UserController $model): bool
//    {
//        //
//    }
//
//    /**
//     * Determine whether the user can delete the model.
//     */
//    public function delete(UserController $user, UserController $model): bool
//    {
//        //
//    }
//
//    /**
//     * Determine whether the user can restore the model.
//     */
//    public function restore(UserController $user, UserController $model): bool
//    {
//        //
//    }
//
//    /**
//     * Determine whether the user can permanently delete the model.
//     */
//    public function forceDelete(UserController $user, UserController $model): bool
//    {
//        //
//    }
    public function verifyUser(User $user): bool
    {
        return $user->role->id === Role::ADMIN;
    }

    public function isStudent(User $user): bool
    {
        return $user->role->id === Role::STUDENT;
    }

    public function isCandidate(User $user): bool
    {
        return $user->role->id === Role::CANDIDATE;
    }

    public function isAdmin(User $user): bool
    {
        return $user->role->id === Role::ADMIN;
    }

    public function isIntern(User $user): bool
    {
        return $user->role->id === Role::INTERN;
    }

    public function isMentor(User $user): bool
    {
        return $user->role->id === Role::MENTOR;
    }

    public function isHr(User $user): bool
    {
        return $user->role->id === Role::HR;
    }
}
