<?php

namespace App\Http\Controllers\Api;

use App\Filters\UserFilters;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserFilterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\SetLogMessagesAndHttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;


class UserController extends Controller
{

    public function __construct
    (
        private UserRepository $userRepository,
        private SetLogMessagesAndHttpResponse $setLogMessagesAndHttpResponse,
        private UserHelper $userHelper        
    ){
        $this->middleware('auth:api');
    }

    
    public function create(UserAddRequest $request): JsonResponse 
    {
       try {            
            $response = $this->userRepository->createUser($request);
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogCreatedOneInstance($response);
        }
        catch (\Exception $e) {
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotCreatedInstance($e);
        }
        return response()->json($result->response, $result->http_status);
    }


    public function index(): JsonResponse 
    {
       try {
            $response = $this->userRepository->getAll();
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogRetrieveInstances($response);
        }
        catch (\Exception $e) {
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrieveInstances($e);
        }
        return response()->json($result->response, $result->http_status);
    }


    public function show(int $id): JsonResponse 
    {
        try {
            $response = $this->userRepository->find($id); 
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogRetrieveOneInstance($response);
        }
        catch (\Exception $e) {
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrievedOneInstance($e);
        }
        return response()->json($result->response, $result->http_status);
    }


    public function update(UserUpdateRequest $request, $id): JsonResponse 
    {
        try {
            $category = $this->userRepository->updateUser($id, $request);
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogUpdatedInstance($category);
        }
        catch (\Exception $e) {
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotUpdatedInstance($e);
        }        
        return response()->json($result->response, $result->http_status);
    }


    public function delete($id): JsonResponse 
    {
        try {
            $response = $this->userRepository->deleteUser($id);
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogDeletedOneInstance($response);
        }
        catch (\Exception $e) {
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrievedOneInstance($e);
        }
        return response()->json($result->response, $result->http_status);
    }

    
    public function favorite(): JsonResponse 
    {
        try {
            $userId = $this->userHelper->getLoggedUserId();
            $cacheKey = "user_favorite_movies_{$userId}";
            $response = $this->userRepository->getFavorite($userId);
            
            $response = Cache::remember($cacheKey, 60*60*24, function() use ($response){
                return $response;
            });
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogRetrieveInstances($response);
         }
         catch (\Exception $e) {
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrieveInstances($e);
         }
            
        return response()->json($result->response, $result->http_status);
     }

     
    protected function filter(UserFilterRequest $request): JsonResponse
    {   
         //$request->session()->put('UserFilterInput', $request->input());         

         try {
            $response = (new User)->filter(new UserFilters($request));
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogRetrieveInstances($response);
        }
        catch (\Exception $e) {
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrieveInstances($e);
        }
        return response()->json($result->response, $result->http_status);       
    }

}
