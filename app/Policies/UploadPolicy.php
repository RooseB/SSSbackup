<?php

namespace App\Policies;

use App\Models\User;
use App\Models\webapp;
use Illuminate\Auth\Access\Response;

use Illuminate\Auth\Access\HandlesAuthorization;

class UploadPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, webapp $webapp): bool
    {
        //
        dd($user, $webapp);
        return true;
    }


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        //
        return $user!==null;
        //return yes;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, webapp $webapp)
    {
        //
        return $user->id === $upload->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, webapp $webapp)
    {
        //
        return $user->id === $upload->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, webapp $webapp): bool
    {
        //
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, webapp $webapp): bool
    {
        //
        return false;
    }
}
