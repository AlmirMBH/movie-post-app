<?php

namespace App\Http\Controllers\Api;

use App\Filters\RoleFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleAddRequest;
use App\Http\Requests\RoleFilterRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\Role;
use App\Repositories\RoleRepository;
use App\Services\SetLogMessagesAndHttpResponse;
use Illuminate\Http\JsonResponse;


class RoleController extends Controller
{

    public function __construct(
        private RoleRepository $roleRepository,
        private SetLogMessagesAndHttpResponse $setLogMessagesAndHttpResponse
    ){
        $this->middleware('auth:api');
    }

    
    public function create(RoleAddRequest $request): JsonResponse 
    {
    //    $this->authorize('create');

       try {
            $response = $this->roleRepository->createRole($request);
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogCreatedOneInstance($response);
        }
        catch(\Exception $e){
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotCreatedInstance($e);
        }
        return response()->json($result->response, $result->http_status);
    }


    public function index(): JsonResponse 
    {
    //    $this->authorize('viewAny'); 

       try {
            $response = $this->roleRepository->getAll();
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogRetrieveInstances($response);
        }
        catch(\Exception $e){
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrieveInstances($e);
        }
        return response()->json($result->response, $result->http_status);
    }


    public function show(Role $role): JsonResponse 
    {        
        // $this->authorize('view');

        try {
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogRetrieveOneInstance($role);
        }
        catch(\Exception $e){
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrievedOneInstance($e);
        }
        return response()->json($result->response, $result->http_status);
    }


    public function update(RoleUpdateRequest $request, $id): JsonResponse 
    {
        // $this->authorize('update');

        try {
            $category = $this->roleRepository->updateRole($id, $request);
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
            $response = $this->roleRepository->deleteRole($id);
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogRetrieveOneInstance($response);
        }
        catch(\Exception $e){
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrievedOneInstance($e);
        }
        return response()->json($result->response, $result->http_status);
    }


    protected function filter(RoleFilterRequest $request) // validation
    {   
        //  $this->authorize('viewAny');         

         try {
            $response = (new Role)->filter(new RoleFilters($request));
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogRetrieveInstances($response);
        }
        catch(\Exception $e){
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrieveInstances($e);
        }
        return response()->json($result->response, $result->http_status);       
    }

}
