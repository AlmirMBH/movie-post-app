<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoriteMovieUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('favorite_movie_user')->insert(
            [
                [
                    'user_id' => 1,
                    'movie_id' => 1,
                ],
                [
                    'user_id' => 1,
                    'movie_id' => 2,
                ],
                [
                    'user_id' => 1,
                    'movie_id' => 3,
                ],
                [
                    'user_id' => 1,
                    'movie_id' => 4,
                ]
            ]);
    }
}
