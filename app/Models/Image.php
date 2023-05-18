<?php

namespace App\Models;

use App\Traits\Filters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory, SoftDeletes, Filters;

    protected $fillable = ['model_name', 'model_id', 'path', 'description', 'imageable_id', 'imageable_name'];
    
    public function imageable()
    {
        return $this->morphTo();
    }
}
