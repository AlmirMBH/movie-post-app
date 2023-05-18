<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert(
            [
                [
                    'title' => "Important post",
                    'subtitle' => "Important post subtitle",
                    'description' => "Important post description",
                    'body' => "Important post body",
                    'author_id' => 1,
                    'movie_id' => 1,
                    'slug' => "Important-post",
                    'created_at' => '2023-05-17 12:24:45',
                    'updated_at' => '2023-05-17 12:24:45'
                ],
                [
                    'title' => "Important post I",
                    'subtitle' => "Important post I subtitle",
                    'description' => "Important post I description",
                    'body' => "Important post body",
                    'author_id' => 1,
                    'movie_id' => 1,
                    'slug' => "Important-post-i",
                    'created_at' => '2023-05-17 12:24:45',
                    'updated_at' => '2023-05-17 12:24:45'
                ],
                [
                    'title' => "Important post II",
                    'subtitle' => "Important post II subtitle",
                    'description' => "Important post I description",
                    'body' => "Important post II description",
                    'author_id' => 1,
                    'movie_id' => 1,
                    'slug' => "important-post-ii",
                    'created_at' => '2023-05-17 12:24:45',
                    'updated_at' => '2023-05-17 12:24:45'
                ],
            ]);
    }
}
