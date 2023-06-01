<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PostRepository extends BaseRepository
{
    protected $model;

    public function __construct(Post $model)
    {
        parent::__construct($model);
    }


    public function createPost(Request $request): Model
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


    public function updatePost(int $id, Request $request): Model
    {
        return $this->update($request->validated(), $id);
    }


    public function deletePost(int $id): bool
    {
        return $this->delete($id);
    }

}
