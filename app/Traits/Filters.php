<?php
namespace App\Traits;

trait Filters {

    public function scopeFilter($query, $filters)
    {   
        return $filters->apply($query);
    }


    public function orderById($order){        
        return $this->builder->orderBy('id', $order);
    }


    public function id($id){        
        return $this->builder->where('id', $id ?? "");        
    }
    
}
