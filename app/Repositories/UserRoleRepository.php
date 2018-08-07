<?php

namespace App\Repositories;

use App\UserRoles;

class UserRoleRepository
{
    /**
     * Get user roles
     * @return collection
     */

    public function getAll()
    {
        return UserRoles::all();
    }

}
