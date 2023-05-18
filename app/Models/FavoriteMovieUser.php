<?php

namespace App\Models;

use App\Traits\Filters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FavoriteMovieUser extends Pivot
{
    use HasFactory, Filters;

    protected $fillable = ['user_id', 'movie_id'];

    protected $table = 'favorite_movie_user';

}
