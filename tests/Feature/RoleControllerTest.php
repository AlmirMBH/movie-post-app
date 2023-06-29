<?php

namespace Tests\Feature;

use App\Constants\HttpMethods;
use App\Constants\Methods;
use App\Constants\Models;
use App\Constants\Routes;
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
        ])->json(HttpMethods::POST, Routes::ROLES . Methods::CREATE, $requestData);

        $response->assertStatus(201);
    }


    public function testIndex(): void
    {             
        $user = $this->testUser();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::GET, Routes::ROLES . Methods::INDEX);

        $response->assertStatus(200);
    }


    public function testShow(): void
    {
        $user = $this->testUser();
        $role = $this->getSeededModel(Models::ROLE);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::GET, Routes::ROLES . Methods::SHOW . $role->id);

        $response->assertStatus(200);
    }


    public function testUpdate(): void
    {
        $user = $this->testUser();
        $role = $this->getSeededModel(Models::ROLE);
        $requestData = ['name' => 'updated-guest'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::PUT, Routes::ROLES . Methods::UPDATE . $role->id, $requestData);

        $response->assertStatus(200);
    }


    public function testDelete(): void
    {
        $user = $this->testUser();
        $role = $this->getSeededModel(Models::ROLE);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::DELETE, Routes::ROLES . Methods::DELETE . $role->id);

        $response->assertStatus(200);
    }

}