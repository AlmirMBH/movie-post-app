<?php

namespace App\Traits;

use App\Constants\Models;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

trait TestTrait {

    
    public function testUser(): array
    {
        $user = $this->getSeededModel(Models::USER);        
        $requestData = ['email' => $user->email, 'password' => 'password']; // Password specified in UserFactory
        $response = $this->json('POST', 'api/login', $requestData);        
        $response->assertStatus(200);
        
        return ['user' => $user, 'token' => $response['token']];
    }


    public function getSeededModel(string $model): Model
    {
        return Factory::factoryForModel($model)->create();
    }
   
}
