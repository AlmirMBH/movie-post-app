<?php

namespace App\Observers;

use App\Models\FavoriteMovieUser;
use Illuminate\Support\Facades\Cache;

class FavoriteMovieUserObserver
{
    public function created(FavoriteMovieUser $favoriteMovieUser): void
    {
        $this->refreshCache($favoriteMovieUser->user_id);
    }

    public function deleted(FavoriteMovieUser $favoriteMovieUser): void
    {
        $this->refreshCache($favoriteMovieUser->user_id);
    }

    public function updated(FavoriteMovieUser $favoriteMovieUser): void
    {
        $this->refreshCache($favoriteMovieUser->user_id);
    }

    private function refreshCache($userId): void
    {        
        $cacheKey = "user_favorite_movies_{$userId}";
        Cache::forget($cacheKey);
    }
}
