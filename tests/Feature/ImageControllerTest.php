<?php

namespace Tests\Feature;

use App\Constants\HttpMethods;
use App\Constants\Methods;
use App\Constants\Models;
use App\Constants\Routes;
use App\Traits\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImageControllerTest extends TestCase
{
    use RefreshDatabase, TestTrait;
    

    public function testCreated(): void
    {        
        $user = $this->testUser();
        
        $requestData = [         
            'model_name' => 'post' . random_int(1, 10000),   
            'model_id' => $user['user']->id,
            'path' => 'storage/images/profile',
            'description' => 'Profile image',
            'imageable_id' => $user['user']->id,
            'imageable_name' => 'post'
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::POST, Routes::IMAGES . Methods::CREATE, $requestData);

        $response->assertStatus(201);
    }


    public function testIndex(): void
    {             
        $user = $this->testUser();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::GET, Routes::IMAGES . Methods::INDEX);

        $response->assertStatus(200);
    }


    public function testShow(): void
    {
        $user = $this->testUser();
        $image = $this->getSeededModel(Models::IMAGE);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::GET, Routes::IMAGES . Methods::SHOW . $image->id);

        $response->assertStatus(200);
    }


    public function testUpdate(): void
    {
        $user = $this->testUser();
        $image = $this->getSeededModel(Models::IMAGE);

        $requestData = [
            'model_name' => 'Test post updated' . random_int(1, 1000),
            'path' => 'storage/images/thumbnails',
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::PUT, Routes::IMAGES . Methods::UPDATE . $image->id, $requestData);

        $response->assertStatus(200);
    }


    public function testDelete(): void
    {
        $user = $this->testUser();
        $image = $this->getSeededModel(Models::IMAGE);
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::DELETE, Routes::IMAGES . Methods::DELETE . $image->id);

        $response->assertStatus(200);
    }
    
}
