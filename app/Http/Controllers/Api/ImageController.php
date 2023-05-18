<?php

namespace App\Http\Controllers\Api;

use App\Filters\ImageFilters;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImageAddRequest;
use App\Http\Requests\ImageFilterRequest;
use App\Http\Requests\ImageUpdateRequest;
use App\Models\Image;
use App\Repositories\ImageRepository;
use App\Services\SetLogMessagesAndHttpResponse;
use Illuminate\Http\JsonResponse;


class ImageController extends Controller
{

    public function __construct(
        private ImageRepository $imageRepository,
        private SetLogMessagesAndHttpResponse $setLogMessagesAndHttpResponse
    ){
        $this->middleware('auth:api');
    }

    
    public function create(ImageAddRequest $request): JsonResponse {
       try {            
            $response = $this->imageRepository->createImage($request);
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogCreatedOneInstance($response);
        }
        catch(\Exception $e){
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotCreatedInstance($e);
        }
        return response()->json($result->response, $result->http_status);
    }


    public function index(): JsonResponse {
       try {
            $response = $this->imageRepository->getAll();
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogRetrieveInstances($response);
        }
        catch(\Exception $e){
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrieveInstances($e);
        }
        return response()->json($result->response, $result->http_status);
    }


    public function show(Image $image): JsonResponse {
        try {
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogRetrieveOneInstance($image);
        }
        catch(\Exception $e){
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrievedOneInstance($e);
        }
        return response()->json($result->response, $result->http_status);
    }


    public function update(ImageUpdateRequest $request, $id): JsonResponse {
        try {
            $category = $this->imageRepository->updateImage($id, $request);
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogUpdatedInstance($category);
        }
        catch(\Exception $e){
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotUpdatedInstance($e);
        }        
        return response()->json($result->response, $result->http_status);
    }


    public function delete($id): JsonResponse {   
        try {
            $response = $this->imageRepository->deleteImage($id);
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogRetrieveOneInstance($response);
        }
        catch(\Exception $e){
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrievedOneInstance($e);
        }
        return response()->json($result->response, $result->http_status);
    }


    protected function filter(ImageFilterRequest $request) // validation
    {   
         //$request->session()->put('ImageFilterInput', $request->input());         

         try {            
            $response = (new Image)->filter(new ImageFilters($request));
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogRetrieveInstances($response);
        }
        catch(\Exception $e){
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrieveInstances($e);
        }
        return response()->json($result->response, $result->http_status);       
    }

}
