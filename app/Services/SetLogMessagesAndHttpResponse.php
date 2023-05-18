<?php

namespace App\Services;

use App\Helpers\CustomHttpStatusMessages;
use App\Helpers\LogMessage;
use App\Services\CustomResponse;
use Illuminate\Support\Facades\Log;


class SetLogMessagesAndHttpResponse {

    private CustomResponse $customResponse;

    public function __construct(CustomResponse $customResponse){
        $this->customResponse = $customResponse;
    }

    public function setHttpResponseAndLogCreatedOneInstance($response): object {
        if(empty($response)){
            Log::stack(['custom_error'])->error(LogMessage::INSTANCE_NOT_CREATED);
            return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::BAD_REQUEST);
        }

        Log::stack(['custom_info'])->info(LogMessage::INSTANCE_CREATED);
        return $this->customResponse->httpResponse($response, CustomHttpStatusMessages::CREATED);
    }


    public function setExceptionAndLogNotCreatedInstance($e): object{
        Log::stack(['custom_error'])->error(LogMessage::INSTANCE_NOT_CREATED_WITH_ERROR . $e->getMessage());
        return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::BAD_REQUEST);
    }


    public function setHttpResponseAndLogRetrieveInstances($response): object {
        if(! isset($response) || (count($response) < 1)){
            Log::stack(['custom_error'])->info(LogMessage::INSTANCES_NOT_RETRIEVED);
            return $this->customResponse->httpResponse($response, CustomHttpStatusMessages::BAD_REQUEST);
        }

        Log::stack(['custom_info'])->info(LogMessage::INSTANCES_RETRIEVED);
        return $this->customResponse->httpResponse($response, CustomHttpStatusMessages::OK);
    }


    public function setExceptionAndLogNotRetrieveInstances($e): object{
        Log::stack(['custom_error'])->error(LogMessage::INSTANCES_NOT_RETRIEVED_WITH_ERROR . $e->getMessage());
        return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::BAD_REQUEST);
    }


    public function setHttpResponseAndLogRetrieveOneInstance($response): object {
        if(!$response || empty($response) ){
            Log::stack(['custom_error'])->error(LogMessage::INSTANCE_NOT_RETRIEVED);
            return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::NO_CONTENT);
        }
        Log::stack(['custom_info'])->info(LogMessage::INSTANCE_RETRIEVED);
        return $this->customResponse->httpResponse($response, CustomHttpStatusMessages::OK);
    }


    public function setExceptionAndLogNotRetrievedOneInstance($e): object{
        Log::stack(['custom_error'])->error(LogMessage::INSTANCE_NOT_RETRIEVED_WITH_ERROR . $e->getMessage());
        return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::BAD_REQUEST);
    }


    public function setHttpResponseAndLogUpdatedInstance($response): object{
        if(empty($response)){
            Log::stack(['custom_error'])->error(LogMessage::INSTANCE_NOT_UPDATED);
            return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::NOT_FOUND);
        }
        Log::stack(['custom_info'])->info(LogMessage::INSTANCE_UPDATED);
        return $this->customResponse->httpResponse($response, CustomHttpStatusMessages::OK);
    }


    public function setExceptionAndLogNotUpdatedInstance($e): object{
        Log::stack(['custom_error'])->error(LogMessage::INSTANCE_NOT_UPDATED_WITH_ERROR . $e->getMessage());
        return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::BAD_REQUEST);
    }


    public function setHttpResponseAndLogDeletedOneInstance($response): object {
        if(! $response){
            Log::stack(['custom_error'])->error(LogMessage::INSTANCE_NOT_DELETED);
            return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::NOT_FOUND);
        }

        Log::stack(['custom_error'])->info(LogMessage::INSTANCE_DELETED);
        return $this->customResponse->httpResponse($response, CustomHttpStatusMessages::DELETED);
    }


    public function setExceptionAndLogNotDeletedInstance($e): object{
        Log::stack(['custom_error'])->error(LogMessage::INSTANCE_NOT_DELETED_WITH_ERROR . $e->getMessage());
        return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::NOT_FOUND);
    }




    public function setHttpResponseAndLogNoMovieSelected(): object{
        Log::stack(['custom_error'])->error(LogMessage::MOVIE_NOT_SELECTED);
        return $this->customResponse->httpResponse(LogMessage::MOVIE_NOT_SELECTED, CustomHttpStatusMessages::BAD_REQUEST);
    }


    public function setHttpResponseAndLogNoMovieSelectedAndLiked(): object{
        Log::stack(['custom_error'])->error(LogMessage::MOVIE_NOT_SELECTED_AND_LIKED);
        return $this->customResponse->httpResponse(LogMessage::MOVIE_NOT_SELECTED_AND_LIKED, CustomHttpStatusMessages::BAD_REQUEST);
    }
    
    
    public function setHttpResponseAndLogMovieSelected(): object {
        Log::stack(['custom_error'])->error(LogMessage::MOVIE_ALREADY_ADDED_TO_FAVORITES);
        return $this->customResponse->httpResponse(LogMessage::MOVIE_ALREADY_ADDED_TO_FAVORITES, CustomHttpStatusMessages::CONFLICT);
    }

}