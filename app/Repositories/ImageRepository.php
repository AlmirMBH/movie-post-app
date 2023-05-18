<?php

namespace App\Repositories;

use App\Models\Image;


class ImageRepository extends BaseRepository
{
    protected $model;

    public function __construct(Image $model){
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


    public function createImage($request)
    {
        return $this->create($request->validated());
    }


    public function updateImage(int $id, $request)
    {
        return $this->update($request->validated(), $id);
    }


    public function deleteImage(int $id)
    {
        return $this->delete($id);
    }

}
