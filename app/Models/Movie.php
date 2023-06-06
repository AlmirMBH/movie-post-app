<?php

namespace App\Models;

use App\Traits\Filters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Movie extends Model
{
    use HasFactory, SoftDeletes, Filters;

    protected $fillable = ['title', 'body', 'image_id', 'director', 'category_id', 'slug', 'added_by_id'];


    public function setTitleAttribute($value): void 
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function posts(): HasMany 
    {
        return $this->hasMany(Post::class);
    }


    public function users(): BelongsToMany 
    {
        return $this->belongsToMany(User::class, 'favorite_movie_user');
    }


    public function author(): HasOne 
    {
        return $this->hasOne(User::class, 'id', 'added_by_id');
    }

}
