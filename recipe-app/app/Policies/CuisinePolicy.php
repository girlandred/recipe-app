<?php

namespace App\Policies;

use App\Models\Cuisine;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class CuisinePolicy
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
        return $user()->is_admin;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cuisine  $cuisine
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Cuisine $cuisine)
    {
        return $user()->is_admin || !($user->is_admin);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user()->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cuisine  $cuisine
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Cuisine $cuisine)
    {
        return $user()->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cuisine  $cuisine
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Cuisine $cuisine)
    {
        return $user()->is_admin;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cuisine  $cuisine
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Cuisine $cuisine)
    {
        return $user()->is_admin;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Cuisine  $cuisine
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Cuisine $cuisine)
    {
        return $user()->is_admin;
    }
}
