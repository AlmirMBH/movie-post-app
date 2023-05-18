<?php

namespace App\Filters;

use \App\Traits\Filters as FiltersTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


class ImageFilters extends Filters
{
    use FiltersTrait;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    
    public function model_name(string $modelName): Builder 
    {
        return $this->builder->where('model_name', $modelName);
    }


    public function model_id(int $modelId): Builder 
    {
        return $this->builder->where('model_id', $modelId);
    }


    public function path(string $path): Builder 
    {
        return $this->builder->where('path', $path);
    }


    public function description(string $description): Builder 
    {
        return $this->builder->where('description', $description);
    }


    public function imageable_id(string $imageableId): Builder 
    {
        return $this->builder->where('imageable_id', $imageableId);
    }


    public function imageable_name(string $imageableName): Builder 
    {
        return $this->builder->where('imageable_name',  $imageableName);
    }

}
