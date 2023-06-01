<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\Filters as BaseFilters;
use Illuminate\Pagination\LengthAwarePaginator;

trait Filters {

    public function scopeFilter(Builder $query, BaseFilters $filters): LengthAwarePaginator
    {   
        return $filters->apply($query);
    }


    public function orderById(int $order): Builder
    {        
        return $this->builder->orderBy('id', $order);
    }


    public function id(int $id): Builder
    {
        return $this->builder->where('id', $id ?? "");        
    }
    
}
