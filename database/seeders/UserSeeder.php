<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Sasa',
                    'email' => 'sasa@sasa.ba',
                    'email_verified_at' => now(),
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'role_id' => 1,
                    'registered_by' => 1,
                ],
                [
                    'name' => 'Alen',
                    'email' => 'alen@alen.ba',
                    'email_verified_at' => now(),
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'role_id' => 1,
                    'registered_by' => 1,
                ],
                [
                    'name' => 'Almir',
                    'email' => 'almir@almir.ba',
                    'email_verified_at' => now(),
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'role_id' => 1,
                    'registered_by' => 1,
                ],
                [
                    'name' => 'Seha',
                    'email' => 'seha@seha.ba',
                    'email_verified_at' => now(),
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password                    
                    'role_id' => 2,
                    'registered_by' => 1,
                ],
                [
                    'name' => 'Nerma',
                    'email' => 'nerma@nerma.ba',
                    'email_verified_at' => now(),
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password                    
                    'role_id' => 2,
                    'registered_by' => 1,
                ],
                [
                    'name' => 'Hulk',
                    'email' => 'hulk@hulk.ba',
                    'email_verified_at' => now(),
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password                    
                    'role_id' => 2,
                    'registered_by' => 1,
                ]
            ]
        );        
    }
}
