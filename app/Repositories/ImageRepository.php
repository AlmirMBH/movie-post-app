<?php

namespace App\Repositories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class ImageRepository extends BaseRepository
{
    protected $model;

    public function __construct(Image $model)
    {
        parent::__construct($model);
    }


    public function createImage(Request $request): Model
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


    public function updateImage(int $id, $request):Model
    {
        return $this->update($request->validated(), $id);
    }


    public function deleteImage(int $id): bool
    {
        return $this->delete($id);
    }

}
