<?php

namespace App\Filters;

use \App\Traits\Filters as FiltersTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


class PostFilters extends Filters
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


    public function description(string $description): Builder
    {
        return $this->builder->where('description', $description);
    }


    public function body(string $body): Builder
    {
        return $this->builder->where('body', $body);
    }


    public function author_id(int $author_id): Builder
    {
        return $this->builder->where('author_id', $author_id);
    }


    public function category_id(int $category_id): Builder
    {
        return $this->builder->where('category_id', $category_id);
    }


    public function subtitle(string $subtitle): Builder
    {
        return $this->builder->where('subtitle', $subtitle);
    }


    public function movie(): Builder
    {
        return $this->builder->with('movie');
    }


    public function author(): Builder
    {
        return $this->builder->with('author');
    }

}
