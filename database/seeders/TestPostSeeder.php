<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert(
            [
                [
                    'title' => "Test post",
                    'subtitle' => "Test post subtitle",
                    'description' => "Test post description",
                    'body' => "Test post body",
                    'author_id' => 1,
                    'movie_id' => 1,
                    'slug' => "Test-post",
                    'created_at' => '2023-05-17 12:24:45',
                    'updated_at' => '2023-05-17 12:24:45'
                ],
            ]
        );
    }
}
