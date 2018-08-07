<?php

namespace App\Services;

use App\Repositories\UserRoleRepository;
use App\Transformers\UserRoleTransformer;

class UserRoleService
{

    public function __construct(
        UserRoleRepository $repository,
        UserRoleTransformer $transformer
    ) {
        $this->repository = $repository;
        $this->transformer = $transformer;
    }

    /**
     * Get user roles
     *
     * @return array
     */

    public function getAll()
    {
        return $this->transformer->transformCollection($this->repository->getAll());
    }

}
