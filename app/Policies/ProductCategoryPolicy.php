<?php

namespace App\Policies;

use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductCategoryPolicy
{
    use HandlesAuthorization;

    public function policy(User $user)
    {
        return $user->role === User::ROLE_ADMIN;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $this->policy($user);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ProductCategory $productCategory)
    {
        return $productCategory->active ? true : $this->policy($user);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $this->policy($user);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ProductCategory $productCategory)
    {
        return $this->policy($user);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ProductCategory $productCategory)
    {
        return $this->policy($user);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ProductCategory $productCategory)
    {
        return $this->policy($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductCategory  $productCategory
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ProductCategory $productCategory)
    {
        return $this->policy($user);
    }
}
