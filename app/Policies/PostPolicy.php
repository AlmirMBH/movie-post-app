<?php

namespace App\Policies;

use App\Constants\Roles;
use App\Helpers\UserHelper;
use App\Models\Post;
use App\Models\User;


class PostPolicy
{

    public function __construct(private UserHelper $userHelper){ }

    
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Post $post): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->userHelper->getLoggedUserRoleId() == Roles::ADMIN;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        return $this->userHelper->getLoggedUserRoleId() == Roles::ADMIN;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        return $this->userHelper->getLoggedUserRoleId() == Roles::ADMIN;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        return $this->userHelper->getLoggedUserRoleId() == Roles::ADMIN;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return $this->userHelper->getLoggedUserRoleId() == Roles::ADMIN;
    }

}
