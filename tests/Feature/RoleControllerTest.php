<?php

namespace Tests\Feature;

use App\Models\Role;
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
            'Authorization' => 'Bearer ' . $user['user'],
        ])->json('POST', 'api/roles/create', $requestData);

        $response->assertStatus(201);
    }


    public function testIndex(): void
    {             
        $user = $this->testUser();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['user'],
        ])->json('GET', 'api/roles/index');

        $response->assertStatus(200);
    }


    public function testShow(): void
    {
        $role = Role::factory()->create();        
        $user = $this->testUser();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['user'],
        ])->json('GET', 'api/roles/show/' . $role->id);

        $response->assertStatus(200);
    }


    public function testUpdate(): void
    {
        $user = $this->testUser();
        $requestData = ['name' => 'tourist'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['user'],
        ])->json('POST', 'api/roles/create', $requestData);
        $response->assertStatus(201);

        $role = Role::where('name', 'tourist')->firstOrFail();
        $requestData = ['name' => 'updated-guest'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['user'],
        ])->json('PUT', 'api/roles/update/' . $role->id, $requestData);

        $response->assertStatus(200);
    }


    public function testDelete(): void
    {
        $user = $this->testUser();
        $requestData = ['name' => 'student'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['user'],
        ])->json('POST', 'api/roles/create', $requestData);
        $response->assertStatus(201);

        $role = Role::where('name', 'student')->firstOrFail();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['user'],
        ])->json('DELETE', 'api/roles/delete/' . $role->id);

        $response->assertStatus(200);
    }

}