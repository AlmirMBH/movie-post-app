<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('images')->insert(
            [
                [
                    'model_name' => "movie",
                    'model_id' => 2,
                    'path' => "storage/images/movie",
                    'description' => "movie image",                    
                    'imageable_name' => "movie",
                    'imageable_id' => 2,
                ],
        ]);
    }
}
