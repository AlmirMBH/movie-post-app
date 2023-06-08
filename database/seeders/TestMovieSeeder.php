<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movies')->insert(
            [
                [
                    'title' => "Test movie",
                    'body' => "Test movie body",
                    'image_id' => 3,
                    'director' => "Almir",
                    'slug' => "test-movie",
                    'added_by_id' => 1,
                    'created_at' => '2023-05-17 12:24:45',
                    'updated_at' => '2023-05-17 12:24:45'
                ],
            ]
        );
    }
}
