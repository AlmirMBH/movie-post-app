<?php

namespace Tests\Feature;

use App\Constants\HttpMethods;
use App\Constants\Methods;
use App\Constants\Models;
use App\Constants\Routes;
use App\Traits\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class PostControllerTest extends TestCase
{
    use RefreshDatabase, TestTrait;
    
    
    public function testCreated(): void
    {        
        $user = $this->testUser();
        
        $requestData = [         
            'title' => 'Test post' . random_int(1, 10000),   
            'subtitle' => 'Test post body',
            'description' => '3',
            'body' => 'Tester',
            'author_id' => $user['user']->id,
            'movie_id' => 3
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::POST, Routes::POSTS . Methods::CREATE, $requestData);

        $response->assertStatus(201);
    }


    public function testIndex(): void
    {             
        $user = $this->testUser();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::GET, Routes::POSTS . Methods::INDEX);

        $response->assertStatus(200);
    }


    public function testShow(): void
    {
        $user = $this->testUser();
        $post = $this->getSeededModel(Models::POST);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::GET, Routes::POSTS . Methods::SHOW . $post->slug);

        $response->assertStatus(200);
    }


    public function testUpdate(): void
    {
        $user = $this->testUser();
        $post = $this->getSeededModel(Models::POST);
        
        $requestData = [         
            'title' => 'Test post updated' . random_int(1, 1000),   
            'body' => 'Test post updated',
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::PUT, Routes::POSTS . Methods::UPDATE . $post->id, $requestData);

        $response->assertStatus(200);
    }


    public function testDelete(): void
    {
        $user = $this->testUser();
        $post = $this->getSeededModel(Models::POST);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::DELETE, Routes::POSTS . Methods::DELETE . $post->id);

        $response->assertStatus(200);
    }
    
}
