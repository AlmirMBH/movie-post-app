<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CustomResponse{

    private array $ok = ['http_status' => ResponseAlias::HTTP_OK, 'response' => 'Your action has been performed successfully.'];
    private array $created = ['http_status' => ResponseAlias::HTTP_CREATED, 'response' => 'Created'];
    private array $deleted = ['http_status' => ResponseAlias::HTTP_OK, 'response' => 'The action has been performed successfully.'];
    private array $no_content = ['http_status' => ResponseAlias::HTTP_NO_CONTENT, 'response' => 'No content. The entries that you are looking for do not exist'];  //getting status and response message is not allowed on 204 http status, instead of that used 404 http status and custom messages in single case and 200 status in list cases
    private array $bad_request = ['http_status' => ResponseAlias::HTTP_BAD_REQUEST, 'response' => 'Bad Request. Check all the parameters and make sure the method is allowed.'];
    private array $unauthorized = ['http_status' => ResponseAlias::HTTP_UNAUTHORIZED, 'response' => 'Unauthorized access. Check your credentials and make sure you are allowed to perform this action.'];
    private array $forbidden = ['http_status' => ResponseAlias::HTTP_FORBIDDEN, 'response' => 'The access is forbidden. Make sure you are allowed to perform this action.'];
    private array $not_found = ['http_status' => ResponseAlias::HTTP_NOT_FOUND, 'response' => 'Not found. Make sure you are looking for an existing entry.'];
    private array $method_not_allowed = ['http_status' => ResponseAlias::HTTP_METHOD_NOT_ALLOWED, 'response' => 'This method cannot be used with this request.'];
    private array $conflict = ['http_status' => ResponseAlias::HTTP_CONFLICT, 'response' => 'Request conflict. The entry either already exists or it cannot be created or updated with the current parameters.'];
    private array $request_timeout = ['http_status' => ResponseAlias::HTTP_REQUEST_TIMEOUT, 'response' => 'Request timeout. Try again or try later.'];
    private array $unsupported_media_type = ['http_status' => ResponseAlias::HTTP_UNSUPPORTED_MEDIA_TYPE, 'response' => 'Unsupported media type. Make sure you are allowed this type of media.'];
    private array $unprocessable_entity = ['http_status' => ResponseAlias::HTTP_UNPROCESSABLE_ENTITY, 'response' => 'Unsupported media type. Make sure you are allowed this type of media.'];
    private array $internal_server_error = ['http_status' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR, 'response' => 'Internal Server Error. Try again later.'];
    private array $bad_gateway = ['http_status' => ResponseAlias::HTTP_BAD_GATEWAY, 'response' => 'Bad gateway. The issue will be solved soon.'];
    private array $service_unavailable = ['http_status' => ResponseAlias::HTTP_SERVICE_UNAVAILABLE, 'response' => 'Service temporary unavailable. Try later or contact the administrator.'];
    private array $gateway_timeout = ['http_status' => ResponseAlias::HTTP_GATEWAY_TIMEOUT, 'response' => 'Gateway Timeout. Close and re-open the web browser or change your DNS server.'];
    private array $insufficient_storage = ['http_status' => ResponseAlias::HTTP_INSUFFICIENT_STORAGE, 'response' => 'Insufficient storage. Make sure you have enough space to perform this action. You can delete some of your old files or contact the administrator.'];



    public function httpResponse($response = null, $status): object {
        $this->$status['response'] = $response ?? $this->$status['response'];
        return  (object) $this->$status;
    }

}