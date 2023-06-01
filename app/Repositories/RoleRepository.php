<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RoleRepository extends BaseRepository
{
    protected $model;

    public function __construct(Role $model)
    {
        parent::__construct($model);
    }


    public function createRole(Request $request): Model
    {
        return $this->create($request->validated());
    }


    public function getAll(): Collection
    {
        return $this->fetchAll();
    }


    public function find(int $id): Model
    {
        return $this->findById($id);
    }


    public function updateRole(int $id, Request $request): Model
    {
        return $this->update($request->validated(), $id);
    }


    public function deleteRole(int $id): bool
    {
        return $this->delete($id);
    }

}
