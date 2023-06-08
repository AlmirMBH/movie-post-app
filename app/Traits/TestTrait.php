<?php
namespace App\Traits;
use App\Models\User;
use Database\Seeders\TestUserSeeder;


trait TestTrait {

    private static $user = null;
    private static $token = null;
    protected $password = "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi";

    
    public function testUser(): array
    {
        $this->seed(TestUserSeeder::class);
        $requestData = ['email' => 'test@test.ba', 'password' => 'password'];
        $response = $this->json('POST', 'api/login', $requestData);        
        $response->assertStatus(200);
        $user = User::where(['email' => 'test@test.ba', 'password' => $this->password])->firstOrFail();
        self::$user = $user;
        self::$token = $response['token'];

        return ['user' => $user, 'token' => $response['token']];
    }


    public function getSeededModel($seeder){
        $this->seed($seeder);

        return User::latest()->first();
    }
    
}
