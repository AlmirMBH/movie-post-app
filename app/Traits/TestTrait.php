<?php

namespace App\Traits;

use Database\Seeders\TestUserSeeder;
use Illuminate\Database\Eloquent\Model;

trait TestTrait {

    
    public function testUser(): array
    {
        $user = $this->getSeededModel(TestUserSeeder::class);
        $requestData = ['email' => 'test@test.ba', 'password' => 'password'];        
        $response = $this->json('POST', 'api/login', $requestData);        
        $response->assertStatus(200);       

        return ['user' => $user, 'token' => $response['token']];
    }


    /**
     * Test seeder classes are passed as parameters to this method (e.g. TestUserSeeder). The seeders are executed and
     * the seeded models are returned.
     */
    public function getSeededModel(string $seeder): Model
    {
        $this->seed($seeder);
        $model = str_replace(['Database\Seeders\Test', 'Seeder'], '', $seeder);
        $modelClass = '\\App\\Models\\' . $model;
        return app($modelClass)->latest()->first();
    }

    
}
