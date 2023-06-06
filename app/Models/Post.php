<?php

namespace App\Models;

use App\Traits\Filters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes, Filters;


    protected $fillable = ['title', 'description', 'body', 'author_id', 'category_id', 'slug', 'subtitle', 'movie_id'];


    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function setTitleAttribute(string $value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
    
    
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }


    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }


    public function author(): HasOne 
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
    
}
