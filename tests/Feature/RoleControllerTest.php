<?php

namespace Tests\Feature;

use App\Constants\Models;
use App\Traits\TestTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class RoleControllerTest extends TestCase
{
    use RefreshDatabase, TestTrait;
    

    public function testCreate(): void
    {
        $user = $this->testUser();
        $requestData = ['name' => 'guest'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('POST', 'api/roles/create', $requestData);

        $response->assertStatus(201);
    }


    public function testIndex(): void
    {             
        $user = $this->testUser();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('GET', 'api/roles/index');

        $response->assertStatus(200);
    }


    public function testShow(): void
    {
        $user = $this->testUser();
        $role = $this->getSeededModel(Models::ROLE);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('GET', 'api/roles/show/' . $role->id);

        $response->assertStatus(200);
    }


    public function testUpdate(): void
    {
        $user = $this->testUser();
        $role = $this->getSeededModel(Models::ROLE);
        $requestData = ['name' => 'updated-guest'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('PUT', 'api/roles/update/' . $role->id, $requestData);

        $response->assertStatus(200);
    }


    public function testDelete(): void
    {
        $user = $this->testUser();
        $role = $this->getSeededModel(Models::ROLE);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('DELETE', 'api/roles/delete/' . $role->id);

        $response->assertStatus(200);
    }

}