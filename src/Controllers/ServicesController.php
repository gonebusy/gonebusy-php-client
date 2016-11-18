<?php
/*
 * Gonebusy
 *
 * This file was automatically generated for GoneBusy Inc. by APIMATIC v2.0 ( https://apimatic.io ) on 11/18/2016
 */

namespace GonebusyLib\Controllers;

use GonebusyLib\APIException;
use GonebusyLib\APIHelper;
use GonebusyLib\Configuration;
use GonebusyLib\Models;
use GonebusyLib\Exceptions;
use GonebusyLib\Http\HttpRequest;
use GonebusyLib\Http\HttpResponse;
use GonebusyLib\Http\HttpMethod;
use GonebusyLib\Http\HttpContext;
use GonebusyLib\CustomAuthUtility;
use Unirest\Request;

/**
 * @todo Add a general description for this controller.
 */
class ServicesController extends BaseController {

    /**
     * @var ServicesController The reference to *Singleton* instance of this class
     */
    private static $instance;
    
    /**
     * Returns the *Singleton* instance of this class.
     * @return ServicesController The *Singleton* instance.
     */
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        
        return static::$instance;
    }

    /**
     * Delete a Service by id
     * @param  array  $options    Array with all options for search
     * @param  string     $options['authorization']     Required parameter: A valid API key, in the format 'Token API_KEY'
     * @param  string     $options['id']                Required parameter: Example: 
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function deleteServiceById (
                $options) 
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;
        
        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/services/{id}';

        //process optional query parameters
        $_queryBuilder = APIHelper::appendUrlWithTemplateParameters($_queryBuilder, array (
            'id'            => $this->val($options, 'id'),
            ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'APIMATIC 2.0',
            'Accept'        => 'application/json',
            'Authorization' => Configuration::$authorization,
            'Authorization'   => $this->val($options, 'authorization')
        );

        //append custom auth authorization headers
        CustomAuthUtility::appendCustomAuthParams($_headers);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::DELETE, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);            
        }

        //and invoke the API call request to fetch the response
        $response = Request::delete($_queryUrl, $_headers);

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);
            
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);            
        }

        //Error handling using HTTP status codes
        if ($response->code == 400) {
            throw new Exceptions\EntitiesErrorException('Bad Request', $_httpContext);
        }

        else if ($response->code == 401) {
            throw new Exceptions\EntitiesErrorException('Unauthorized/Missing Token', $_httpContext);
        }

        else if ($response->code == 403) {
            throw new Exceptions\EntitiesErrorException('Forbidden', $_httpContext);
        }

        else if ($response->code == 404) {
            throw new Exceptions\EntitiesErrorException('Not Found', $_httpContext);
        }

        else if ($response->code == 500) {
            throw new APIException('Unexpected error', $_httpContext);
        }

        else if (($response->code < 200) || ($response->code > 208)) { //[200,208] = HTTP OK
            throw new APIException("HTTP Response Not OK", $_httpContext);
        }

        $mapper = $this->getJsonMapper();

        return $mapper->map($response->body, new Models\DeleteServiceByIdResponse());
    }
        
    /**
     * Update a Service with params.
     * @param  array  $options    Array with all options for search
     * @param  string                    $options['authorization']                 Required parameter: A valid API key, in the format 'Token API_KEY'
     * @param  string                    $options['id']                            Required parameter: Example: 
     * @param  Models\UpdateServiceByIdBody $options['updateServiceByIdBody']         Required parameter: the content of the request
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function updateServiceById (
                $options) 
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;
        
        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/services/{id}';

        //process optional query parameters
        $_queryBuilder = APIHelper::appendUrlWithTemplateParameters($_queryBuilder, array (
            'id'                        => $this->val($options, 'id'),
            ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'              => 'APIMATIC 2.0',
            'Accept'                  => 'application/json',
            'content-type'            => 'application/json; charset=utf-8',
            'Authorization' => Configuration::$authorization,
            'Authorization'             => $this->val($options, 'authorization')
        );

        //append custom auth authorization headers
        CustomAuthUtility::appendCustomAuthParams($_headers);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::PUT, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);            
        }

        //and invoke the API call request to fetch the response
        $response = Request::put($_queryUrl, $_headers, Request\Body::Json($this->val($options, 'update_service_by_id_body')));

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);
            
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);            
        }

        //Error handling using HTTP status codes
        if ($response->code == 400) {
            throw new Exceptions\EntitiesErrorException('Bad Request', $_httpContext);
        }

        else if ($response->code == 401) {
            throw new Exceptions\EntitiesErrorException('Unauthorized/Missing Token', $_httpContext);
        }

        else if ($response->code == 403) {
            throw new Exceptions\EntitiesErrorException('Forbidden', $_httpContext);
        }

        else if ($response->code == 404) {
            throw new Exceptions\EntitiesErrorException('Not Found', $_httpContext);
        }

        else if ($response->code == 422) {
            throw new Exceptions\EntitiesErrorException('Unprocessable Entity', $_httpContext);
        }

        else if ($response->code == 500) {
            throw new APIException('Unexpected error', $_httpContext);
        }

        else if (($response->code < 200) || ($response->code > 208)) { //[200,208] = HTTP OK
            throw new APIException("HTTP Response Not OK", $_httpContext);
        }

        $mapper = $this->getJsonMapper();

        return $mapper->map($response->body, new Models\UpdateServiceByIdResponse());
    }
        
    /**
     * Return a Service by id.
     * @param  array  $options    Array with all options for search
     * @param  string     $options['authorization']     Required parameter: A valid API key, in the format 'Token API_KEY'
     * @param  string     $options['id']                Required parameter: Example: 
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function getServiceById (
                $options) 
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;
        
        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/services/{id}';

        //process optional query parameters
        $_queryBuilder = APIHelper::appendUrlWithTemplateParameters($_queryBuilder, array (
            'id'            => $this->val($options, 'id'),
            ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'APIMATIC 2.0',
            'Accept'        => 'application/json',
            'Authorization' => Configuration::$authorization,
            'Authorization'   => $this->val($options, 'authorization')
        );

        //append custom auth authorization headers
        CustomAuthUtility::appendCustomAuthParams($_headers);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);            
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);
            
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);            
        }

        //Error handling using HTTP status codes
        if ($response->code == 400) {
            throw new Exceptions\EntitiesErrorException('Bad Request', $_httpContext);
        }

        else if ($response->code == 401) {
            throw new Exceptions\EntitiesErrorException('Unauthorized/Missing Token', $_httpContext);
        }

        else if ($response->code == 403) {
            throw new Exceptions\EntitiesErrorException('Forbidden', $_httpContext);
        }

        else if ($response->code == 404) {
            throw new Exceptions\EntitiesErrorException('Not Found', $_httpContext);
        }

        else if ($response->code == 500) {
            throw new APIException('Unexpected error', $_httpContext);
        }

        else if (($response->code < 200) || ($response->code > 208)) { //[200,208] = HTTP OK
            throw new APIException("HTTP Response Not OK", $_httpContext);
        }

        $mapper = $this->getJsonMapper();

        return $mapper->map($response->body, new Models\GetServiceByIdResponse());
    }
        
    /**
     * Create a Service with params.
     * @param  array  $options    Array with all options for search
     * @param  string                $options['authorization']           Required parameter: A valid API key, in the format 'Token API_KEY'
     * @param  Models\CreateServiceBody $options['createServiceBody']       Required parameter: the content of the request
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function createService (
                $options) 
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;
        
        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/services/new';

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'        => 'APIMATIC 2.0',
            'Accept'            => 'application/json',
            'content-type'      => 'application/json; charset=utf-8',
            'Authorization' => Configuration::$authorization,
            'Authorization'       => $this->val($options, 'authorization')
        );

        //append custom auth authorization headers
        CustomAuthUtility::appendCustomAuthParams($_headers);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::POST, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);            
        }

        //and invoke the API call request to fetch the response
        $response = Request::post($_queryUrl, $_headers, Request\Body::Json($this->val($options, 'create_service_body')));

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);
            
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);            
        }

        //Error handling using HTTP status codes
        if ($response->code == 400) {
            throw new Exceptions\EntitiesErrorException('Bad Request', $_httpContext);
        }

        else if ($response->code == 401) {
            throw new Exceptions\EntitiesErrorException('Unauthorized/Missing Token', $_httpContext);
        }

        else if ($response->code == 403) {
            throw new Exceptions\EntitiesErrorException('Forbidden', $_httpContext);
        }

        else if ($response->code == 404) {
            throw new Exceptions\EntitiesErrorException('Not Found', $_httpContext);
        }

        else if ($response->code == 422) {
            throw new Exceptions\EntitiesErrorException('Unprocessable Entity', $_httpContext);
        }

        else if ($response->code == 500) {
            throw new APIException('Unexpected error', $_httpContext);
        }

        else if (($response->code < 200) || ($response->code > 208)) { //[200,208] = HTTP OK
            throw new APIException("HTTP Response Not OK", $_httpContext);
        }

        $mapper = $this->getJsonMapper();

        return $mapper->map($response->body, new Models\CreateServiceResponse());
    }
        
    /**
     * Return list of Services.
     * @param  array  $options    Array with all options for search
     * @param  string      $options['authorization']     Required parameter: A valid API key, in the format 'Token API_KEY'
     * @param  integer     $options['page']              Optional parameter: Page offset to fetch.
     * @param  integer     $options['perPage']           Optional parameter: Number of results to return per page.
     * @param  integer     $options['userId']            Optional parameter: Retrieve Services provided by the User specified by Id.  You must be authorized to manage this User Id.
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function getServices (
                $options) 
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;
        
        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/services';

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'page'          => $this->val($options, 'page', 1),
            'per_page'      => $this->val($options, 'perPage', 10),
            'user_id'       => $this->val($options, 'userId'),
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'APIMATIC 2.0',
            'Accept'        => 'application/json',
            'Authorization' => Configuration::$authorization,
            'Authorization'   => $this->val($options, 'authorization')
        );

        //append custom auth authorization headers
        CustomAuthUtility::appendCustomAuthParams($_headers);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);            
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);
            
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);            
        }

        //Error handling using HTTP status codes
        if ($response->code == 401) {
            throw new Exceptions\EntitiesErrorException('Unauthorized/Missing Token', $_httpContext);
        }

        else if ($response->code == 403) {
            throw new Exceptions\EntitiesErrorException('Forbidden', $_httpContext);
        }

        else if ($response->code == 404) {
            throw new Exceptions\EntitiesErrorException('Not Found', $_httpContext);
        }

        else if ($response->code == 500) {
            throw new APIException('Unexpected error', $_httpContext);
        }

        else if (($response->code < 200) || ($response->code > 208)) { //[200,208] = HTTP OK
            throw new APIException("HTTP Response Not OK", $_httpContext);
        }

        $mapper = $this->getJsonMapper();

        return $mapper->map($response->body, new Models\GetServicesResponse());
    }
        
    /**
     * Return available times for a Service.
     * @param  array  $options    Array with all options for search
     * @param  string     $options['authorization']     Required parameter: A valid API key, in the format 'Token API_KEY'
     * @param  string     $options['id']                Required parameter: Example: 
     * @param  string     $options['date']              Optional parameter: Date to check for availability.  Either this field or a date range employing start_date and end_date must be supplied.  If date is provided, start_date/end_date are ignored.  Several formats are supported: '2014-10-31', 'October 31, 2014'.
     * @param  string     $options['endDate']           Optional parameter: End Date of a range to check for availability.  If supplied, date must not be supplied and start_date must be supplied.  Several formats are supported: '2014-10-31', 'October 31, 2014'.
     * @param  string     $options['startDate']         Optional parameter: Start Date of a range to check for availability.  If supplied, date must not be supplied and end_date must be supplied.  Several formats are supported: '2014-10-31', 'October 31, 2014'.
     * @return mixed response from the API call
     * @throws APIException Thrown if API call fails
     */
    public function getServiceAvailableSlotsById (
                $options) 
    {
        //the base uri for api requests
        $_queryBuilder = Configuration::$BASEURI;
        
        //prepare query string for API call
        $_queryBuilder = $_queryBuilder.'/services/{id}/available_slots';

        //process optional query parameters
        $_queryBuilder = APIHelper::appendUrlWithTemplateParameters($_queryBuilder, array (
            'id'            => $this->val($options, 'id'),
            ));

        //process optional query parameters
        APIHelper::appendUrlWithQueryParameters($_queryBuilder, array (
            'date'          => $this->val($options, 'date'),
            'end_date'      => $this->val($options, 'endDate'),
            'start_date'    => $this->val($options, 'startDate'),
        ));

        //validate and preprocess url
        $_queryUrl = APIHelper::cleanUrl($_queryBuilder);

        //prepare headers
        $_headers = array (
            'user-agent'    => 'APIMATIC 2.0',
            'Accept'        => 'application/json',
            'Authorization' => Configuration::$authorization,
            'Authorization'   => $this->val($options, 'authorization')
        );

        //append custom auth authorization headers
        CustomAuthUtility::appendCustomAuthParams($_headers);

        //call on-before Http callback
        $_httpRequest = new HttpRequest(HttpMethod::GET, $_headers, $_queryUrl);
        if($this->getHttpCallBack() != null) {
            $this->getHttpCallBack()->callOnBeforeRequest($_httpRequest);            
        }

        //and invoke the API call request to fetch the response
        $response = Request::get($_queryUrl, $_headers);

        //call on-after Http callback
        if($this->getHttpCallBack() != null) {
            $_httpResponse = new HttpResponse($response->code, $response->headers, $response->raw_body);
            $_httpContext = new HttpContext($_httpRequest, $_httpResponse);
            
            $this->getHttpCallBack()->callOnAfterRequest($_httpContext);            
        }

        //Error handling using HTTP status codes
        if ($response->code == 400) {
            throw new Exceptions\EntitiesErrorException('Bad Request', $_httpContext);
        }

        else if ($response->code == 401) {
            throw new Exceptions\EntitiesErrorException('Unauthorized/Missing Token', $_httpContext);
        }

        else if ($response->code == 403) {
            throw new Exceptions\EntitiesErrorException('Forbidden', $_httpContext);
        }

        else if ($response->code == 404) {
            throw new Exceptions\EntitiesErrorException('Not Found', $_httpContext);
        }

        else if ($response->code == 500) {
            throw new APIException('Unexpected error', $_httpContext);
        }

        else if (($response->code < 200) || ($response->code > 208)) { //[200,208] = HTTP OK
            throw new APIException("HTTP Response Not OK", $_httpContext);
        }

        $mapper = $this->getJsonMapper();

        return $mapper->map($response->body, new Models\GetServiceAvailableSlotsByIdResponse());
    }
        


    /**
	 * Array access utility method
     * @param  array          $arr         Array of values to read from
     * @param  string         $key         Key to get the value from the array
     * @param  mixed|null     $default     Default value to use if the key was not found
     * @return mixed
     */
    private function val($arr, $key, $default = NULL)
    {
        if(isset($arr[$key])) {
            return is_bool($arr[$key]) ? var_export($arr[$key], true) : $arr[$key];
        }
        return $default;
    }

}