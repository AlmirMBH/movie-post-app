<?php

namespace App\Observers;

use App\Models\FavoriteMovieUser;
use Illuminate\Support\Facades\Cache;

class FavoriteMovieUserObserver
{
    public function created(FavoriteMovieUser $favoriteMovieUser)
    {
        $this->refreshCache($favoriteMovieUser->user_id);
    }

    public function deleted(FavoriteMovieUser $favoriteMovieUser)
    {
        $this->refreshCache($favoriteMovieUser->user_id);
    }

    public function updated(FavoriteMovieUser $favoriteMovieUser)
    {
        $this->refreshCache($favoriteMovieUser->user_id);
    }

    private function refreshCache($userId)
    {        
        $cacheKey = "user_favorite_movies_{$userId}";
        Cache::forget($cacheKey);
    }
}
