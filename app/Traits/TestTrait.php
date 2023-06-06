<?php
namespace App\Traits;
use App\Models\User;

trait TestTrait {

    protected $password = "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi";

    
    public function testUser(): array
    {
        $requestData = [            
            'email' => 'almir@almir.ba',
            'password' => 'password'            
        ];        
        $response = $this->json('POST', 'api/login', $requestData);        
        $response->assertStatus(200);
        $user = User::where(['email' => 'almir@almir.ba', 'password' => $this->password])->firstOrFail();

        return ['user' => $user, 'token' => $response['token']];
    }
    
}
