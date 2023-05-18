<?php

namespace App\Repositories;

use App\Models\Post;


class PostRepository extends BaseRepository
{
    protected $model;

    public function __construct(Post $model){
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


    public function createPost($request)
    {
        return $this->create($request->validated());
    }


    public function updatePost(int $id, $request)
    {
        return $this->update($request->validated(), $id);
    }


    public function deletePost(int $id)
    {
        return $this->delete($id);
    }

}
