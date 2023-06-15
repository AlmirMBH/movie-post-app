<?php

namespace App\Policies;

use App\Constants\Roles;
use App\Helpers\UserHelper;
use App\Models\Role;
use App\Models\User;


class RolePolicy
{
    public function __construct(private UserHelper $userHelper){ }

    
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->userHelper->getLoggedUserRoleId() == Roles::USER;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role): bool
    {
        return $this->userHelper->getLoggedUserRoleId() == Roles::ADMIN;
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
    public function update(User $user, Role $role): bool
    {
        return $this->userHelper->getLoggedUserRoleId() == Roles::ADMIN;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role): bool
    {
        return $this->userHelper->getLoggedUserRoleId() == Roles::ADMIN;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role): bool
    {
        return $this->userHelper->getLoggedUserRoleId() == Roles::ADMIN;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role): bool
    {
        return $this->userHelper->getLoggedUserRoleId() == Roles::ADMIN;
    }
}
