<?php

namespace App\Filters;

use \App\Traits\Filters as FiltersTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


class MovieFilters extends Filters
{
    use FiltersTrait;

    protected $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    
    public function slug(string $slug): Builder 
    {
        return $this->builder->where('slug', $slug);
    }


    public function title(string $title): Builder 
    {
        return $this->builder->where('title', $title);
    }


    public function body(string $body): Builder 
    {
        return $this->builder->where('body', 'LIKE', '%' . $body .'%');
    }


    public function image_id(int $image_id): Builder 
    {
        return $this->builder->where('image_id', $image_id);
    }


    public function director(string $director): Builder 
    {
        return $this->builder->where('director', $director);
    }


    public function category_id(int $category_id): Builder 
    {
        return $this->builder->where('category_id', $category_id);
    }


    public function added_by_id(int $added_by_id): Builder 
    {
        return $this->builder->where('added_by_id', $added_by_id);
    }


    public function posts(): Builder 
    {
        return $this->builder->with('posts');
    }


    public function author(): Builder 
    {
        return $this->builder->with('author');
    }

}
