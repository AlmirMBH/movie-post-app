<?php

namespace App\Services;

use App\Constants\CustomHttpStatusMessages;
use App\Constants\LogMessage;
use App\Services\CustomResponse;
use Illuminate\Support\Facades\Log;


class SetLogMessagesAndHttpResponse {

    private CustomResponse $customResponse;

    public function __construct(CustomResponse $customResponse)
    {
        $this->customResponse = $customResponse;
    }


    public function setHttpResponseAndLogRegisterUser(?array $response): object
    {        
        if (!isset($response)) {
            Log::stack(['custom_error'])->error(LogMessage::USER_NOT_REGISTERED);
            return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::BAD_REQUEST);
        }

        Log::channel('custom_info')->info(LogMessage::USER_REGISTERED);
        return $this->customResponse->httpResponse($response, CustomHttpStatusMessages::CREATED);
    }


    public function setHttpResponseAndLogLoginUser(?array $response): object
    {    
        if (!isset($response)) {
            Log::stack(['custom_error'])->error(LogMessage::USER_NOT_LOGGED_IN);
            return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::UNAUTHORIZED);
        }

        Log::channel('custom_info')->error(LogMessage::USER_LOGGED_IN);
        return $this->customResponse->httpResponse($response, CustomHttpStatusMessages::OK);
    }


    public function setExceptionAndLogUnauthorizedLoginAttempt(): object
    {
        Log::stack(['custom_error'])->error("A user has not been logged in.");
        return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::UNAUTHORIZED);
    }


    public function setHttpResponseAndLogLogoutUser(): object
    {
        Log::channel('custom_info')->info(LogMessage::USER_LOGGED_OUT);
        return $this->customResponse->httpResponse(LogMessage::USER_LOGGED_OUT, CustomHttpStatusMessages::OK);
    }


    public function setHttpResponseAndLogCreatedOneInstance(?object $response): object 
    {
        if (empty($response)) {
            Log::stack(['custom_error'])->error(LogMessage::INSTANCE_NOT_CREATED);
            return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::BAD_REQUEST);
        }

        Log::stack(['custom_info'])->info(LogMessage::INSTANCE_CREATED);
        return $this->customResponse->httpResponse($response, CustomHttpStatusMessages::CREATED);
    }


    public function setExceptionAndLogNotCreatedInstance(\Exception $e): object
    {
        Log::stack(['custom_error'])->error(LogMessage::INSTANCE_NOT_CREATED_WITH_ERROR . $e->getMessage());
        return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::BAD_REQUEST);
    }


    public function setHttpResponseAndLogRetrieveInstances($response): object 
    {
        if (! isset($response) || (count($response) < 1)) {
            Log::stack(['custom_error'])->info(LogMessage::INSTANCES_NOT_RETRIEVED);
            return $this->customResponse->httpResponse($response, CustomHttpStatusMessages::BAD_REQUEST);
        }

        Log::stack(['custom_info'])->info(LogMessage::INSTANCES_RETRIEVED);
        return $this->customResponse->httpResponse($response, CustomHttpStatusMessages::OK);
    }


    public function setExceptionAndLogNotRetrieveInstances(\Exception $e): object
    {
        Log::stack(['custom_error'])->error(LogMessage::INSTANCES_NOT_RETRIEVED_WITH_ERROR . $e->getMessage());
        return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::BAD_REQUEST);
    }


    public function setHttpResponseAndLogRetrieveOneInstance(object|int $response): object 
    {
        if(! $response || empty($response) ){
            Log::stack(['custom_error'])->error(LogMessage::INSTANCE_NOT_RETRIEVED);
            return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::NO_CONTENT);
        }

        Log::stack(['custom_info'])->info(LogMessage::INSTANCE_RETRIEVED);
        return $this->customResponse->httpResponse($response, CustomHttpStatusMessages::OK);
    }


    public function setExceptionAndLogNotRetrievedOneInstance(\Exception $e): object
    {
        Log::stack(['custom_error'])->error(LogMessage::INSTANCE_NOT_RETRIEVED_WITH_ERROR . $e->getMessage());
        return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::BAD_REQUEST);
    }


    public function setHttpResponseAndLogUpdatedInstance(?object $response): object
    {
        if (empty($response)) {
            Log::stack(['custom_error'])->error(LogMessage::INSTANCE_NOT_UPDATED);
            return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::NOT_FOUND);
        }

        Log::stack(['custom_info'])->info(LogMessage::INSTANCE_UPDATED);
        return $this->customResponse->httpResponse($response, CustomHttpStatusMessages::OK);
    }


    public function setExceptionAndLogNotUpdatedInstance(\Exception $e): object
    {
        Log::stack(['custom_error'])->error(LogMessage::INSTANCE_NOT_UPDATED_WITH_ERROR . $e->getMessage());
        return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::BAD_REQUEST);
    }


    public function setHttpResponseAndLogDeletedOneInstance(bool $response): object
    {
        if (! $response) {
            Log::stack(['custom_error'])->error(LogMessage::INSTANCE_NOT_DELETED);
            return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::NOT_FOUND);
        }

        Log::stack(['custom_error'])->info(LogMessage::INSTANCE_DELETED);
        return $this->customResponse->httpResponse($response, CustomHttpStatusMessages::DELETED);
    }


    public function setExceptionAndLogNotDeletedInstance(\Exception $e): object
    {
        Log::stack(['custom_error'])->error(LogMessage::INSTANCE_NOT_DELETED_WITH_ERROR . $e->getMessage());
        return $this->customResponse->httpResponse(null, CustomHttpStatusMessages::NOT_FOUND);
    }


    public function setHttpResponseAndLogNoMovieSelected(): object
    {
        Log::stack(['custom_error'])->error(LogMessage::MOVIE_NOT_SELECTED);
        return $this->customResponse->httpResponse(LogMessage::MOVIE_NOT_SELECTED, CustomHttpStatusMessages::BAD_REQUEST);
    }


    public function setHttpResponseAndLogNoMovieSelectedAndLiked(): object
    {
        Log::stack(['custom_error'])->error(LogMessage::MOVIE_NOT_SELECTED_AND_LIKED);
        return $this->customResponse->httpResponse(LogMessage::MOVIE_NOT_SELECTED_AND_LIKED, CustomHttpStatusMessages::BAD_REQUEST);
    }
    
    
    public function setHttpResponseAndLogMovieSelected(): object
    {
        Log::stack(['custom_error'])->error(LogMessage::MOVIE_ALREADY_ADDED_TO_FAVORITES);
        return $this->customResponse->httpResponse(LogMessage::MOVIE_ALREADY_ADDED_TO_FAVORITES, CustomHttpStatusMessages::CONFLICT);
    }

}