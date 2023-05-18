<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Movie::factory()->times(50)->create();
        DB::table('movies')->insert(
            [
                [
                    'title' => "Big movie",
                    'body' => "Big movie body",
                    'image_id' => 3,
                    'director' => "Almir",
                    'slug' => "big-movie",
                    'added_by_id' => 1,
                    'created_at' => '2023-05-17 12:24:45',
                    'updated_at' => '2023-05-17 12:24:45'
                ],
                [
                    'title' => "Big movie I",
                    'body' => "Big movie I body",
                    'image_id' => 3,
                    'director' => "Almir",
                    'slug' => "big-movie-i",
                    'added_by_id' => 1,
                    'created_at' => '2023-05-17 12:24:45',
                    'updated_at' => '2023-05-17 12:24:45'
                ],
                [
                    'title' => "Big movie II",
                    'body' => "Big movie II body",
                    'image_id' => 3,
                    'director' => "Almir",
                    'slug' => "big-movie-ii",
                    'added_by_id' => 1,
                    'created_at' => '2023-05-17 12:24:45',
                    'updated_at' => '2023-05-17 12:24:45'
                ],
            ]
        );
    }
}
