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
class SearchController {
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
     * Search for Providers and Provided Services.
     * @param  array  $options    Array with all options for search
     * @param  string     $options['apiKey']      Required parameter: Valid API Key for your GoneBusy account (edit in top nav)
     * @param  string     $options['query']       Required parameter: TODO: type description here
     * @return mixed response from the API call*/
    public function searchQuery (
                $options) 
    {
        //the base uri for api requests
        $queryBuilder = Configuration::$BASEURI;
        
        //prepare query string for API call
        $queryBuilder = $queryBuilder.'/search/{query}';

        //process optional query parameters
        APIHelper::appendUrlWithTemplateParameters($queryBuilder, array (
            'query'   => $this->val($options, 'query'),
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

        else if ($response->code == 500) {
            throw new APIException('Unexpected error', 500, $response->body);
        }

        else if (($response->code < 200) || ($response->code > 206)) { //[200,206] = HTTP OK
            throw new APIException("HTTP Response Not OK", $response->code, $response->body);
        }

        return $response->body;
    }
        
}