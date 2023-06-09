<?php

namespace Tests\Feature;

use App\Traits\TestTrait;
use Database\Seeders\TestPostSeeder;
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
        ])->json('POST', 'api/posts/create', $requestData);

        $response->assertStatus(201);
    }


    public function testIndex(): void
    {             
        $user = $this->testUser();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('GET', 'api/posts/index');

        $response->assertStatus(200);
    }


    public function testShow(): void
    {
        $user = $this->testUser();
        $post = $this->getSeededModel(TestPostSeeder::class);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('GET', 'api/posts/show/' . $post->slug);

        $response->assertStatus(200);
    }


    public function testUpdate(): void
    {
        $user = $this->testUser();
        $post = $this->getSeededModel(TestPostSeeder::class);
        
        $requestData = [         
            'title' => 'Test post updated' . random_int(1, 1000),   
            'body' => 'Test post updated',
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('PUT', 'api/posts/update/' . $post->id, $requestData);

        $response->assertStatus(200);
    }


    public function testDelete(): void
    {
        $user = $this->testUser();
        $post = $this->getSeededModel(TestPostSeeder::class);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('DELETE', 'api/posts/delete/' . $post->id);

        $response->assertStatus(200);
    }
    
}
