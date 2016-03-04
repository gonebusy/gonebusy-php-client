<?php
/*
 * Gonebusy
 *
 * This file was automatically generated for GoneBusy Inc. by APIMATIC BETA v2.0 on 03/04/2016
 */

namespace GonebusyLib\Controllers;

use GonebusyLib\APIException;
use GonebusyLib\APIHelper;
use GonebusyLib\Configuration;
use Unirest\Unirest;
class SchedulesController {
    /**
	 * Array access utility method
     * @param  array          $arr         Array of values to read from
     * @param  string         $key         Key to get the value from the array
     * @param  mixed|null     $default     Default value to use if the key was not found */
    private function val($arr, $key, $default = NULL)
    {
        if(isset($arr[$key])) {
            return is_bool($arr[$key]) ? var_export($arr[$key], true) : $arr[$key];
        }
        return $default;
    }

    /**
     * Return all Schedules that your account has access to.  Includes Schedules for your own User as well as any Users for which you are the Account Manager.
     * @param  array  $options    Array with all options for search
     * @param  string       $options['apiKey']       Required parameter: Valid API Key for your GoneBusy account (edit in top nav)
     * @param  int|null     $options['page']         Optional parameter: Page offset to fetch.
     * @param  int|null     $options['perPage']      Optional parameter: Number of results to return per page.
     * @param  int|null     $options['userId']       Optional parameter: Retrieve Schedules owned only by this User Id.  You must be authorized to manage this User Id.
     * @return mixed response from the API call*/
    public function getSchedules (
                $options) 
    {
        //the base uri for api requests
        $queryBuilder = Configuration::$BASEURI;
        
        //prepare query string for API call
        $queryBuilder = $queryBuilder.'/schedules';

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($queryBuilder, array (
            'api_key'  => $this->val($options, 'apiKey'),
            'page'     => $this->val($options, 'page', 1),
            'per_page' => $this->val($options, 'perPage', 10),
            'user_id'  => $this->val($options, 'userId'),
        ));

        //validate and preprocess url
        $queryUrl = APIHelper::cleanUrl($queryBuilder);

        //prepare headers
        $headers = array (
            'user-agent'    => 'APIMATIC 2.0',
            'Accept'        => 'application/json'
        );

        //prepare API request
        $request = Unirest::get($queryUrl, $headers);

        //and invoke the API call request to fetch the response
        $response = Unirest::getResponse($request);

        //Error handling using HTTP status codes
        if ($response->code == 400) {
            throw new APIException('Bad Request', 400, $response->body);
        }

        else if ($response->code == 401) {
            throw new APIException('Unauthorized/Missing Token', 401, $response->body);
        }

        else if ($response->code == 403) {
            throw new APIException('Forbidden', 403, $response->body);
        }

        else if ($response->code == 404) {
            throw new APIException('Not Found', 404, $response->body);
        }

        else if ($response->code == 500) {
            throw new APIException('Unexpected error', 500, $response->body);
        }

        else if (($response->code < 200) || ($response->code > 206)) { //[200,206] = HTTP OK
            throw new APIException("HTTP Response Not OK", $response->code, $response->body);
        }

        return $response->body;
    }
        
    /**
     * Create a Schedule with params.
     * @param  CreateScheduleBody     $createScheduleBody       Required parameter: the content of the request
     * @return mixed response from the API call*/
    public function createSchedule (
                $createScheduleBody) 
    {
        //the base uri for api requests
        $queryBuilder = Configuration::$BASEURI;
        
        //prepare query string for API call
        $queryBuilder = $queryBuilder.'/schedules/new';

        //validate and preprocess url
        $queryUrl = APIHelper::cleanUrl($queryBuilder);

        //prepare headers
        $headers = array (
            'user-agent'         => 'APIMATIC 2.0',
            'Accept'             => 'application/json',
            'content-type'       => 'application/json; charset=utf-8'
        );

        //prepare API request
        $request = Unirest::post($queryUrl, $headers, json_encode($createScheduleBody));

        //and invoke the API call request to fetch the response
        $response = Unirest::getResponse($request);

        //Error handling using HTTP status codes
        if ($response->code == 400) {
            throw new APIException('Bad Request', 400, $response->body);
        }

        else if ($response->code == 401) {
            throw new APIException('Unauthorized/Missing Token', 401, $response->body);
        }

        else if ($response->code == 403) {
            throw new APIException('Forbidden', 403, $response->body);
        }

        else if ($response->code == 404) {
            throw new APIException('Not Found', 404, $response->body);
        }

        else if ($response->code == 422) {
            throw new APIException('Unprocessable Entity', 422, $response->body);
        }

        else if ($response->code == 500) {
            throw new APIException('Unexpected error', 500, $response->body);
        }

        else if (($response->code < 200) || ($response->code > 206)) { //[200,206] = HTTP OK
            throw new APIException("HTTP Response Not OK", $response->code, $response->body);
        }

        return $response->body;
    }
        
    /**
     * Return a Schedule by id.
     * @param  array  $options    Array with all options for search
     * @param  string     $options['apiKey']      Required parameter: Valid API Key for your GoneBusy account (edit in top nav)
     * @param  string     $options['id']          Required parameter: TODO: type description here
     * @return mixed response from the API call*/
    public function getScheduleById (
                $options) 
    {
        //the base uri for api requests
        $queryBuilder = Configuration::$BASEURI;
        
        //prepare query string for API call
        $queryBuilder = $queryBuilder.'/schedules/{id}';

        //process optional query parameters
        APIHelper::appendUrlWithTemplateParameters($queryBuilder, array (
            'id'      => $this->val($options, 'id'),
            ));

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($queryBuilder, array (
            'api_key' => $this->val($options, 'apiKey'),
        ));

        //validate and preprocess url
        $queryUrl = APIHelper::cleanUrl($queryBuilder);

        //prepare headers
        $headers = array (
            'user-agent'    => 'APIMATIC 2.0',
            'Accept'        => 'application/json'
        );

        //prepare API request
        $request = Unirest::get($queryUrl, $headers);

        //and invoke the API call request to fetch the response
        $response = Unirest::getResponse($request);

        //Error handling using HTTP status codes
        if ($response->code == 400) {
            throw new APIException('Bad Request', 400, $response->body);
        }

        else if ($response->code == 401) {
            throw new APIException('Unauthorized/Missing Token', 401, $response->body);
        }

        else if ($response->code == 403) {
            throw new APIException('Forbidden', 403, $response->body);
        }

        else if ($response->code == 404) {
            throw new APIException('Not Found', 404, $response->body);
        }

        else if ($response->code == 410) {
            throw new APIException('Gone', 410, $response->body);
        }

        else if ($response->code == 500) {
            throw new APIException('Unexpected error', 500, $response->body);
        }

        else if (($response->code < 200) || ($response->code > 206)) { //[200,206] = HTTP OK
            throw new APIException("HTTP Response Not OK", $response->code, $response->body);
        }

        return $response->body;
    }
        
    /**
     * Delete a Schedule
     * @param  array  $options    Array with all options for search
     * @param  string     $options['apiKey']      Required parameter: Valid API Key for your GoneBusy account (edit in top nav)
     * @param  string     $options['id']          Required parameter: TODO: type description here
     * @return mixed response from the API call*/
    public function deleteScheduleById (
                $options) 
    {
        //the base uri for api requests
        $queryBuilder = Configuration::$BASEURI;
        
        //prepare query string for API call
        $queryBuilder = $queryBuilder.'/schedules/{id}';

        //process optional query parameters
        APIHelper::appendUrlWithTemplateParameters($queryBuilder, array (
            'id'      => $this->val($options, 'id'),
            ));

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($queryBuilder, array (
            'api_key' => $this->val($options, 'apiKey'),
        ));

        //validate and preprocess url
        $queryUrl = APIHelper::cleanUrl($queryBuilder);

        //prepare headers
        $headers = array (
            'user-agent'    => 'APIMATIC 2.0',
            'Accept'        => 'application/json'
        );

        //prepare API request
        $request = Unirest::delete($queryUrl, $headers);

        //and invoke the API call request to fetch the response
        $response = Unirest::getResponse($request);

        //Error handling using HTTP status codes
        if ($response->code == 400) {
            throw new APIException('Bad Request', 400, $response->body);
        }

        else if ($response->code == 401) {
            throw new APIException('Unauthorized/Missing Token', 401, $response->body);
        }

        else if ($response->code == 403) {
            throw new APIException('Forbidden', 403, $response->body);
        }

        else if ($response->code == 404) {
            throw new APIException('Not Found', 404, $response->body);
        }

        else if ($response->code == 500) {
            throw new APIException('Unexpected error', 500, $response->body);
        }

        else if (($response->code < 200) || ($response->code > 206)) { //[200,206] = HTTP OK
            throw new APIException("HTTP Response Not OK", $response->code, $response->body);
        }

        return $response->body;
    }
        
    /**
     * Add a TimeWindow to a Schedule.
     * @param  array  $options    Array with all options for search
     * @param  CreateScheduleTimeWindowBody     $options['createScheduleTimeWindowBody']         Required parameter: the content of the request
     * @param  string                           $options['id']                                   Required parameter: TODO: type description here
     * @return mixed response from the API call*/
    public function createScheduleTimeWindow (
                $options) 
    {
        //the base uri for api requests
        $queryBuilder = Configuration::$BASEURI;
        
        //prepare query string for API call
        $queryBuilder = $queryBuilder.'/schedules/{id}/time_windows/new';

        //process optional query parameters
        APIHelper::appendUrlWithTemplateParameters($queryBuilder, array (
            'id'                               => $this->val($options, 'id'),
            ));

        //validate and preprocess url
        $queryUrl = APIHelper::cleanUrl($queryBuilder);

        //prepare headers
        $headers = array (
            'user-agent'                     => 'APIMATIC 2.0',
            'Accept'                         => 'application/json',
            'content-type'                   => 'application/json; charset=utf-8'
        );

        //prepare API request
        $request = Unirest::post($queryUrl, $headers, json_encode($createScheduleTimeWindowBody));

        //and invoke the API call request to fetch the response
        $response = Unirest::getResponse($request);

        //Error handling using HTTP status codes
        if ($response->code == 400) {
            throw new APIException('Bad Request', 400, $response->body);
        }

        else if ($response->code == 401) {
            throw new APIException('Unauthorized/Missing Token', 401, $response->body);
        }

        else if ($response->code == 403) {
            throw new APIException('Forbidden', 403, $response->body);
        }

        else if ($response->code == 404) {
            throw new APIException('Not Found', 404, $response->body);
        }

        else if ($response->code == 422) {
            throw new APIException('Unprocessable Entity', 422, $response->body);
        }

        else if ($response->code == 500) {
            throw new APIException('Unexpected error', 500, $response->body);
        }

        else if (($response->code < 200) || ($response->code > 206)) { //[200,206] = HTTP OK
            throw new APIException("HTTP Response Not OK", $response->code, $response->body);
        }

        return $response->body;
    }
        
    /**
     * Update a TimeWindow for a Schedule.
     * @param  array  $options    Array with all options for search
     * @param  string                               $options['id']                                         Required parameter: TODO: type description here
     * @param  string                               $options['timeWindowId']                               Required parameter: TODO: type description here
     * @param  UpdateScheduleTimeWindowByIdBody     $options['updateScheduleTimeWindowByIdBody']           Required parameter: the content of the request
     * @return mixed response from the API call*/
    public function updateScheduleTimeWindowById (
                $options) 
    {
        //the base uri for api requests
        $queryBuilder = Configuration::$BASEURI;
        
        //prepare query string for API call
        $queryBuilder = $queryBuilder.'/schedules/{id}/time_windows/{time_window_id}';

        //process optional query parameters
        APIHelper::appendUrlWithTemplateParameters($queryBuilder, array (
            'id'                                     => $this->val($options, 'id'),
            'time_window_id'                         => $this->val($options, 'timeWindowId'),
            ));

        //validate and preprocess url
        $queryUrl = APIHelper::cleanUrl($queryBuilder);

        //prepare headers
        $headers = array (
            'user-agent'                           => 'APIMATIC 2.0',
            'Accept'                               => 'application/json',
            'content-type'                         => 'application/json; charset=utf-8'
        );

        //prepare API request
        $request = Unirest::put($queryUrl, $headers, json_encode($updateScheduleTimeWindowByIdBody));

        //and invoke the API call request to fetch the response
        $response = Unirest::getResponse($request);

        //Error handling using HTTP status codes
        if ($response->code == 400) {
            throw new APIException('Bad Request', 400, $response->body);
        }

        else if ($response->code == 401) {
            throw new APIException('Unauthorized/Missing Token', 401, $response->body);
        }

        else if ($response->code == 403) {
            throw new APIException('Forbidden', 403, $response->body);
        }

        else if ($response->code == 404) {
            throw new APIException('Not Found', 404, $response->body);
        }

        else if ($response->code == 422) {
            throw new APIException('Unprocessable Entity', 422, $response->body);
        }

        else if ($response->code == 500) {
            throw new APIException('Unexpected error', 500, $response->body);
        }

        else if (($response->code < 200) || ($response->code > 206)) { //[200,206] = HTTP OK
            throw new APIException("HTTP Response Not OK", $response->code, $response->body);
        }

        return $response->body;
    }
        
    /**
     * Delete a TimeWindow from a Schedule
     * @param  array  $options    Array with all options for search
     * @param  string     $options['apiKey']             Required parameter: Valid API Key for your GoneBusy account (edit in top nav)
     * @param  string     $options['id']                 Required parameter: TODO: type description here
     * @param  string     $options['timeWindowId']       Required parameter: TODO: type description here
     * @return mixed response from the API call*/
    public function deleteScheduleTimeWindowById (
                $options) 
    {
        //the base uri for api requests
        $queryBuilder = Configuration::$BASEURI;
        
        //prepare query string for API call
        $queryBuilder = $queryBuilder.'/schedules/{id}/time_windows/{time_window_id}';

        //process optional query parameters
        APIHelper::appendUrlWithTemplateParameters($queryBuilder, array (
            'id'             => $this->val($options, 'id'),
            'time_window_id' => $this->val($options, 'timeWindowId'),
            ));

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($queryBuilder, array (
            'api_key'        => $this->val($options, 'apiKey'),
        ));

        //validate and preprocess url
        $queryUrl = APIHelper::cleanUrl($queryBuilder);

        //prepare headers
        $headers = array (
            'user-agent'    => 'APIMATIC 2.0',
            'Accept'        => 'application/json'
        );

        //prepare API request
        $request = Unirest::delete($queryUrl, $headers);

        //and invoke the API call request to fetch the response
        $response = Unirest::getResponse($request);

        //Error handling using HTTP status codes
        if ($response->code == 400) {
            throw new APIException('Bad Request', 400, $response->body);
        }

        else if ($response->code == 401) {
            throw new APIException('Unauthorized/Missing Token', 401, $response->body);
        }

        else if ($response->code == 403) {
            throw new APIException('Forbidden', 403, $response->body);
        }

        else if ($response->code == 404) {
            throw new APIException('Not Found', 404, $response->body);
        }

        else if ($response->code == 500) {
            throw new APIException('Unexpected error', 500, $response->body);
        }

        else if (($response->code < 200) || ($response->code > 206)) { //[200,206] = HTTP OK
            throw new APIException("HTTP Response Not OK", $response->code, $response->body);
        }

        return $response->body;
    }
        
}