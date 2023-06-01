<?php
namespace App\Filters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class Filters
{
    protected $builder;
    protected $filters = [];

    public function apply(Builder $threadBuilder): LengthAwarePaginator
    {
        $this->builder = $threadBuilder;

        foreach ($this->getFilters() as $filter => $value) {                     
            if (method_exists($this, $filter)){
                if ($value === NULL){                    
                    continue;
                }
                    $this->$filter($value);                                 
            }
        }

        return $this->builder->paginate($this->request->input('pagination'));
    }

    protected function getFilters(): array
    {
        /**
         * For the sake of testing commands, ->except() is used. Function ->validated() requires FormRequest with rules.
         * If you are not planning to create a new model with flags e.g. php artisan make:model Car -mcdbe you can use
         * either of the 2 functions. For more info, see readme.md.
         * 
         */
        
        // return $this->request->validated();
        return $this->request->except('_method');        
    }

}