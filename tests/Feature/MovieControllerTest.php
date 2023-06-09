<?php

namespace Tests\Feature;

use App\Traits\TestTrait;
use Database\Seeders\TestMovieSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        ])->json('POST', 'api/movies/create', $requestData);

        $response->assertStatus(201);
    }


    public function testIndex(): void
    {             
        $user = $this->testUser();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('GET', 'api/movies/index');

        $response->assertStatus(200);
    }


    public function testShow(): void
    {
        $user = $this->testUser();
        $movie = $this->getSeededModel(TestMovieSeeder::class);
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('GET', 'api/movies/show/' . $movie->id);

        $response->assertStatus(200);
    }


    public function testUpdate(): void
    {
        $user = $this->testUser();
        $movie = $this->getSeededModel(TestMovieSeeder::class);        
        
        $requestData = [         
            'title' => 'Test movie updated' . random_int(1, 1000),   
            'body' => 'Test movie updated',
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('PUT', 'api/movies/update/' . $movie->id, $requestData);

        $response->assertStatus(200);
    }


    public function testDelete(): void
    {
        $user = $this->testUser();
        $movie = $this->getSeededModel(TestMovieSeeder::class);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('DELETE', 'api/movies/delete/' . $movie->id);

        $response->assertStatus(200);
    }

}
