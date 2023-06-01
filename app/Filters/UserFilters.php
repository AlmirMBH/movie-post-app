<?php

namespace App\Filters;

use \App\Traits\Filters as FiltersTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


class UserFilters extends Filters
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


    public function name(string $name): Builder
    {
        return $this->builder->where('name', $name);
    }


    public function email(string $email): Builder
    {
        return $this->builder->where('email', $email);
    }


    public function role_id(int $roleId): Builder
    {
        return $this->builder->where('role_id', $roleId);
    }


    public function registered_by(int $roleId): Builder
    {
        return $this->builder->where('registered_by', $roleId);
    }


    public function movies(): Builder
    {
        return $this->builder->with('movies');
    }


    public function posts(): Builder
    {
        return $this->builder->with('posts');
    }


    public function roles(): Builder
    {
        return $this->builder->with('role');
    }

}
