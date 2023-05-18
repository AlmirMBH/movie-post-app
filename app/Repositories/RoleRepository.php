<?php

namespace App\Repositories;

use App\Models\Role;


class RoleRepository extends BaseRepository
{
    protected $model;

    public function __construct(Role $model){
        parent::__construct($model);
    }


    public function getAll()
    {
        return $this->fetchAll();
    }


    public function find(int $id)
    {
        return $this->findById($id);
    }


    public function createRole($request)
    {
        return $this->create($request->validated());
    }


    public function updateRole(int $id, $request)
    {
        return $this->update($request->validated(), $id);
    }


    public function deleteRole(int $id)
    {
        return $this->delete($id);
    }

}
