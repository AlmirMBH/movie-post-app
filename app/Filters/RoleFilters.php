<?php

namespace App\Filters;

use \App\Traits\Filters as FiltersTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


class RoleFilters extends Filters
{
    use FiltersTrait;

    protected $request;


    public function __construct(Request $request){
        $this->request = $request;
    }


    public function name(string $name): Builder
    {
        return $this->builder->where('name',  $name);
    }


    public function users(): Builder
    {
        return $this->builder->with('users');
    }

}
