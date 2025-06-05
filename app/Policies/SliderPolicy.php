<?php

namespace App\Policies;

use App\Models\Slider;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SliderPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user->checkPermissionAccess('slider_list');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionAccess('slider_add');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->checkPermissionAccess('slider_edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->checkPermissionAccess('slider_delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Slider $slider): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Slider $slider): bool
    {
        return false;
    }
}
