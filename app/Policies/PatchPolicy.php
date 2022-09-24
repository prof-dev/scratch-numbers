<?php

namespace App\Policies;

use App\Models\ExportPatch;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Role;

class PatchPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return current_user()->role_id == Role::IS_ADMIN || Role::IS_READ_AND_WRITE || Role::IS_READ;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ExportPatch  $exportPatch
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ExportPatch $exportPatch)
    {
        return current_user()->role_id == Role::IS_ADMIN || Role::IS_READ_AND_WRITE || Role::IS_READ;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return current_user()->role_id == Role::IS_ADMIN || Role::IS_READ_AND_WRITE;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ExportPatch  $exportPatch
     * @return \Illuminate\Auth\Access\Response|bool
     */
    // public function update(User $user, ExportPatch $exportPatch)
    // {
    //     //
    // }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ExportPatch  $exportPatch
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ExportPatch $exportPatch)
    {
        return current_user()->role_id == Role::IS_ADMIN || Role::IS_READ_AND_WRITE;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ExportPatch  $exportPatch
     * @return \Illuminate\Auth\Access\Response|bool
     */
    // public function restore(User $user, ExportPatch $exportPatch)
    // {
    //     //
    // }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ExportPatch  $exportPatch
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ExportPatch $exportPatch)
    {
        return current_user()->role_id == Role::IS_ADMIN;
    }
}
