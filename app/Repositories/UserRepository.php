<?php

namespace App\Repositories;

use App\Models\User;


class UserRepository extends BaseRepository
{
    protected $model;

    public function __construct(User $model){
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


    public function createUser($request)
    {
        return $this->create($request->validated());
    }


    public function updateUser(int $id, $request)
    {
        return $this->update($request->validated(), $id);
    }


    public function deleteUser(int $id)
    {
        return $this->delete($id);
    }


    public function getFavorite($id){        
        return $this->findById($id)->favoriteMovies()->get();
    }

}
