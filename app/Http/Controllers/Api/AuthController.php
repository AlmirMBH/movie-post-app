<?php
   
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Repositories\UserRepository;
use App\Services\SetLogMessagesAndHttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
   
class AuthController extends Controller
{
    public function __construct(
        private SetLogMessagesAndHttpResponse $setLogMessagesAndHttpResponse,
        private UserRepository $userRepository
    ){
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }


    public function login(UserLoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        $token = auth()->guard('api')->attempt($credentials);
        if (! $token) {
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogUnauthorizedLoginAttempt();            
        }

        $authorisation = ['type' => 'bearer', 'token' => $token];
        $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogLoginUser($authorisation);        
        return response()->json($result->response, $result->http_status);
    }


    public function logout(): JsonResponse
    {
        Auth::logout();
        $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogLogoutUser();
        return response()->json($result->response, $result->http_status);
    }


    public function register(UserRegisterRequest $request): JsonResponse
    {
        $user = $this->userRepository->createUser($request);
        $token = auth()->guard('api')->login($user);
        $response = ['user' => $user, 'type' => 'bearer', 'token' => $token];
        $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogRegisterUser($response);
        return response()->json($result->response, $result->http_status);
    }
    
}