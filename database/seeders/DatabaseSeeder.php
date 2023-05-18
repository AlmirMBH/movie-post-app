<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Image;
use App\Models\Movie;
use App\Models\Post;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            MovieSeeder::class,
            PostSeeder::class,
            FavoriteMovieUserSeeder::class,
            ImageSeeder::class
        ]);
        
        $users = User::factory(30)->create();


        Movie::factory(50)->make()->each(function ($movie) use ($users) {
            $movie->added_by_id = $users->random()->id;
            $movie->save();
        });


        Post::factory(30)->make()->each(function ($post) use ($users) {            
            $post->author_id = $users->random()->id;
            $post->save();
        });


        Image::factory(50)->create();

    }
}
