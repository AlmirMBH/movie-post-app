<?php

namespace App\Http\Controllers\Api;

use App\Filters\PostFilters;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostAddRequest;
use App\Http\Requests\PostFilterRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Repositories\PostRepository;
use App\Services\SetLogMessagesAndHttpResponse;
use Illuminate\Http\JsonResponse;


class PostController extends Controller
{

    public function __construct(
        private PostRepository $postRepository,
        private SetLogMessagesAndHttpResponse $setLogMessagesAndHttpResponse,
        private UserHelper $userHelper
    ){
        $this->middleware('auth:api');
    }

    
    public function create(PostAddRequest $request): JsonResponse 
    {
    //    $this->authorize('create');

       try {
            $response = $this->postRepository->createPost($request);
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogCreatedOneInstance($response);
        }
        catch(\Exception $e){
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotCreatedInstance($e);
        }
        return response()->json($result->response, $result->http_status);
    }


    public function index(): JsonResponse 
    {
       try {
            $response = $this->postRepository->getAll();
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogRetrieveInstances($response);
        }
        catch(\Exception $e){
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrieveInstances($e);
        }
        return response()->json($result->response, $result->http_status);
    }


    public function show(Post $post): JsonResponse 
    {
        try {
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogRetrieveOneInstance($post);
        }
        catch(\Exception $e){
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrievedOneInstance($e);
        }
        return response()->json($result->response, $result->http_status);
    }


    public function update(PostUpdateRequest $request, $id): JsonResponse 
    {        
        // $this->authorize('update');
        
        try {
            $category = $this->postRepository->updatePost($id, $request);
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogUpdatedInstance($category);
        }
        catch(\Exception $e){
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotUpdatedInstance($e);
        }        
        return response()->json($result->response, $result->http_status);
    }


    public function delete($id): JsonResponse 
    {        
        // $this->authorize('delete');
        
        try {
            $response = $this->postRepository->deletePost($id);
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogRetrieveOneInstance($response);
        }
        catch(\Exception $e){
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrievedOneInstance($e);
        }
        return response()->json($result->response, $result->http_status);
    }


    protected function filter(PostFilterRequest $request): JsonResponse
    {   
         try {
            $response = (new Post)->filter(new PostFilters($request));
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogRetrieveInstances($response);
        }
        catch(\Exception $e){
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrieveInstances($e);
        }
        return response()->json($result->response, $result->http_status);       
    }

}
