<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('images')->insert(
            [
                [
                    'model_name' => "post",
                    'model_id' => 2,
                    'path' => "storage/images/profile/user",
                    'description' => "profile image",                    
                    'imageable_name' => "post",
                    'imageable_id' => 2,
                ],
            ]);
    }
}
