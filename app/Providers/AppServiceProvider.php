<?php

namespace App\Providers;

use App\Models\FavoriteMovieUser;
use App\Models\Movie;
use App\Observers\FavoriteMovieUserObserver;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FavoriteMovieUser::observe(FavoriteMovieUserObserver::class);
    }
}
