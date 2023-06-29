<?php

namespace Tests\Feature;

use App\Constants\HttpMethods;
use App\Constants\Methods;
use App\Constants\Models;
use App\Constants\Routes;
use App\Traits\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Tests\TestCase;

class MovieControllerTest extends TestCase
{
    use RefreshDatabase, TestTrait;


    public function testCreated(): void
    {        
        $user = $this->testUser();
        
        $requestData = [         
            'title' => 'Test movie' . random_int(1, 10000),   
            'body' => 'test movie body',
            'image_id' => '3',
            'director' => 'Tester',
            'added_by_id' => $user['user']->id
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::POST, Routes::MOVIES . Methods::CREATE, $requestData);

        $response->assertStatus(201);
    }


    public function testIndex(): void
    {             
        $user = $this->testUser();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::GET, Routes::MOVIES . Methods::INDEX);

        $response->assertStatus(200);
    }


    public function testShow(): void
    {
        $user = $this->testUser();
        $movie = $this->getSeededModel(Models::MOVIE);
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::GET, Routes::MOVIES . Methods::SHOW . $movie->id);

        $response->assertStatus(200);
    }


    public function testUpdate(): void
    {
        $user = $this->testUser();
        $movie = $this->getSeededModel(Models::MOVIE);
        
        $requestData = [         
            'title' => 'Test movie updated' . random_int(1, 1000),   
            'body' => 'Test movie updated',
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::PUT, Routes::MOVIES . Methods::UPDATE . $movie->id, $requestData);

        $response->assertStatus(200);
    }


    public function testDelete(): void
    {
        $user = $this->testUser();        
        $movie = $this->getSeededModel(Models::MOVIE);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::DELETE, Routes::MOVIES . Methods::DELETE . $movie->id);

        $response->assertStatus(200);
    }

}
