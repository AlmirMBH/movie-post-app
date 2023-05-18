<?php

namespace App\Repositories;

use App\Models\Movie;


class MovieRepository extends BaseRepository
{
    protected $model;

    public function __construct(Movie $model){
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


    public function createMovie($request)
    {
        return $this->create($request->validated());
    }


    public function updateMovie(int $id, $request)
    {
        return $this->update($request->validated(), $id);
    }


    public function deleteMovie(int $id)
    {
        return $this->delete($id);
    }

}
