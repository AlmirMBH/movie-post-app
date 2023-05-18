<?php

namespace Tests\Feature;

use App\Models\User;
use App\Traits\TestTrait;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, TestTrait;

    protected $password = "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi";

    public function testRegister()
    {        
        $requestData = [         
            'name' => 'Tester',   
            'email' => 'tester' . random_int(1, 10000) . '@tester.ba',
            'password' => 'password',
            'c_password' => 'password'
        ];

        $response = $this->json('POST', 'api/register', $requestData);
        $response->assertStatus(200);
    }


    public function testIndex()
    {
        $user = $this->testUser();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('GET', 'api/users/index');

        $response->assertStatus(200);
    }


    public function testShow()
    {
        $user = $this->testUser();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('GET', 'api/users/show/' . $user['user']->id);

        $response->assertStatus(200);
    }


    public function testUpdate()
    {
        $user = $this->testUser();
        $requestData = ['name' => 'Michael'];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('PUT', 'api/users/update/' . $user['user']->id, $requestData);

        $response->assertStatus(200);
    }


    public function testDelete()
    {
        $user = User::factory()->create();
        $loggedUser = $this->testUser();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $loggedUser['token'],
        ])->json('DELETE', 'api/users/delete/' . $user->id);

        $response->assertStatus(200);
    }

}