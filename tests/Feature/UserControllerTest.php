<?php

namespace Tests\Feature;

use App\Constants\HttpMethods;
use App\Constants\Methods;
use App\Constants\Routes;
use App\Traits\TestTrait;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, TestTrait;


    public function testRegister(): void
    {        
        $requestData = [         
            'name' => 'Tester',   
            'email' => 'tester' . random_int(1, 10000) . '@tester.ba',
            'password' => 'password',
            'c_password' => 'password'
        ];

        $response = $this->json(HttpMethods::POST, Routes::API . Methods::REGISTER, $requestData);
        $response->assertStatus(201);
    }


    public function testIndex(): void
    {
        $user = $this->testUser();
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::GET, Routes::USERS . Methods::INDEX);

        $response->assertStatus(200);
    }


    public function testShow(): void
    {
        $user = $this->testUser();
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::GET, Routes::USERS . Methods::SHOW . $user['user']->id);

        $response->assertStatus(200);
    }


    public function testUpdate(): void
    {
        $user = $this->testUser();
        $requestData = ['name' => 'Michael'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::PUT, Routes::USERS . Methods::UPDATE . $user['user']->id, $requestData);

        $response->assertStatus(200);
    }


    public function testDelete(): void
    {
        $user = $this->testUser();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json(HttpMethods::DELETE, Routes::USERS . Methods::DELETE . $user['user']->id);

        $response->assertStatus(200);
    }

}
