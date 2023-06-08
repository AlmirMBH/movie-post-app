<?php

namespace Tests\Feature;

use App\Models\Image;
use App\Traits\TestTrait;
use Database\Seeders\TestImageSeeder;
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
        ])->json('POST', 'api/images/create', $requestData);

        $response->assertStatus(201);
    }


    public function testIndex(): void
    {             
        $user = $this->testUser();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('GET', 'api/images/index');

        $response->assertStatus(200);
    }


    public function testShow(): void
    {
        $user = $this->testUser();
        $this->seed(TestImageSeeder::class);
        $image = Image::where(['model_name' => 'movie', 'model_id' => 2])->firstOrFail();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('GET', 'api/images/show/' . $image->id);

        $response->assertStatus(200);
    }


    public function testUpdate(): void
    {
        $user = $this->testUser();
        $this->seed(TestImageSeeder::class);
        $image = Image::where(['model_name' => 'movie', 'model_id' => 2])->firstOrFail();
        $requestData = [
            'model_name' => 'Test post updated' . random_int(1, 1000),
            'path' => 'storage/images/thumbnails',
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('PUT', 'api/images/update/' . $image->id, $requestData);

        $response->assertStatus(200);
    }


    public function testDelete(): void
    {
        $user = $this->testUser();
        $this->seed(TestImageSeeder::class);
        $image = Image::where(['model_name' => 'movie', 'model_id' => 2])->firstOrFail();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('DELETE', 'api/images/delete/' . $image->id);

        $response->assertStatus(200);
    }
    
}
