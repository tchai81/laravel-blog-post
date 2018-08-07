<?php

namespace App\Transformers;

use App\Transformers\TransformerAbstract;

class UserRoleTransformer extends TransformerAbstract
{
    /**
     * Format the user role
     *
     * @param array $role
     * @return array
     */

    public function transform($role)
    {
        if (!is_null($role)) {
            return [
                'id' => $role['id'],
                'name' => __("registration.{$role["name"]}"),
            ];
        }
        return null;
    }

}
