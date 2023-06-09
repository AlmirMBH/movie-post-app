<?php

namespace App\Http\Controllers\Api;

use App\Filters\MovieFilters;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddFavoriteMovieRequest;
use App\Http\Requests\MovieAddRequest;
use App\Http\Requests\MovieFilterRequest;
use App\Http\Requests\MovieUpdateRequest;
use App\Models\Movie;
use App\Repositories\MovieRepository;
use App\Services\SetLogMessagesAndHttpResponse;
use Illuminate\Http\JsonResponse;


class MovieController extends Controller
{

    public function __construct(
        private MovieRepository $movieRepository,
        private SetLogMessagesAndHttpResponse $setLogMessagesAndHttpResponse,
        private UserHelper $userHelper
    ){
        $this->middleware('auth:api');
    }

    
    public function create(MovieAddRequest $request): JsonResponse 
    {
    //    $this->authorize('create'); 

       try {
            $response = $this->movieRepository->createMovie($request);
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
            $response = $this->movieRepository->getAll();
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
            $response = $this->movieRepository->find($id);
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogRetrieveOneInstance($response);
        }
        catch (\Exception $e) {
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrievedOneInstance($e);
        }
        return response()->json($result->response, $result->http_status);
    }


    public function update(int $id, MovieUpdateRequest $request): JsonResponse 
    {
        // $this->authorize('update');

        try {
            $category = $this->movieRepository->updateMovie($id, $request);
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogUpdatedInstance($category);
        }
        catch (\Exception $e) {
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotUpdatedInstance($e);
        }        
        return response()->json($result->response, $result->http_status);
    }


    public function delete(int $id): JsonResponse 
    {
        // $this->authorize('delete');   
        
        try {
            $response = $this->movieRepository->deleteMovie($id);
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogDeletedOneInstance($response);
        }
        catch (\Exception $e) {
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrievedOneInstance($e);
        }
        return response()->json($result->response, $result->http_status);
    }


        
    public function favorite(AddFavoriteMovieRequest $request): JsonResponse 
    {   
        $user = $this->userHelper->getLoggedUser();
        $movieId = $request->input('movieId');
        $addFavoriteMovie = (bool) $request->input('favoriteMovie');        
        $favoriteMovieAdded = $user->favoriteMovies()->wherePivot('movie_id', $movieId)->exists();
        
        try {
            $response = match (true) {
                (! $favoriteMovieAdded && $addFavoriteMovie) => $this->addFavoriteMovie($user, $movieId),
                ($favoriteMovieAdded && !$addFavoriteMovie) => $this->removeFavoriteMovie($user, $movieId),
                default => (object) ['status' => 'Bad request!'],
            };         

            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogCreatedOneInstance($response);
        } 
        catch (\Exception $e) {
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrieveInstances($e);
        }
        
        return response()->json($result->response, $result->http_status);
    }


    public function addFavoriteMovie($user, $movieId){        
        $user->favoriteMovies()->attach($movieId);
        return $this->movieRepository->findById($movieId);
    }


    public function removeFavoriteMovie($user, $movieId){
        $user->favoriteMovies()->detach($movieId);                    
        return (object) ['message' => 'Removed successfully!'];
    } 
    

    protected function filter(MovieFilterRequest $request): JsonResponse
    {   
         //$request->session()->put('MovieFilterInput', $request->input());         

         try {
            $response = (new Movie)->filter(new MovieFilters($request));
            $result = $this->setLogMessagesAndHttpResponse->setHttpResponseAndLogRetrieveInstances($response);
        }
        catch (\Exception $e) {
            $result = $this->setLogMessagesAndHttpResponse->setExceptionAndLogNotRetrieveInstances($e);
        }
        return response()->json($result->response, $result->http_status);       
    }

}
