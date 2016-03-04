<?php 
/*
 * Gonebusy
 *
 * This file was automatically generated for GoneBusy Inc. by APIMATIC BETA v2.0 on 03/04/2016
 */

namespace GonebusyLib\Models;

use JsonSerializable;

class CreateUserBody implements JsonSerializable {
    /**
     * User's email address
     * @param string $email public property
     */
    protected $email;

    /**
     * Optional first name
     * @param string|null $firstName public property
     */
    protected $firstName;

    /**
     * Optional last name
     * @param string|null $lastName public property
     */
    protected $lastName;

    /**
     * Optional name for your Business/Organization
     * @param string|null $businessName public property
     */
    protected $businessName;

    /**
     * Optional website URL
     * @param string|null $externalUrl public property
     */
    protected $externalUrl;

    /**
     * Optional vanity url - ex: www.gonebusy.com/[permalink] - must be unique
     * @param string|null $permalink public property
     */
    protected $permalink;

    /**
     * Optional timezone
     * @param string|null $timezone public property
     */
    protected $timezone;

    /**
     * Valid API Key for your GoneBusy account
     * (edit in top nav)
     * @param string $apiKey public property
     */
    protected $apiKey;

    /**
     * Constructor to set initial or default values of member properties
	 * @param   string            $email           Initialization value for the property $this->email        
	 * @param   string|null       $firstName       Initialization value for the property $this->firstName    
	 * @param   string|null       $lastName        Initialization value for the property $this->lastName     
	 * @param   string|null       $businessName    Initialization value for the property $this->businessName 
	 * @param   string|null       $externalUrl     Initialization value for the property $this->externalUrl  
	 * @param   string|null       $permalink       Initialization value for the property $this->permalink    
	 * @param   string|null       $timezone        Initialization value for the property $this->timezone     
	 * @param   string            $apiKey          Initialization value for the property $this->apiKey       
     */
    public function __construct()
    {
        if(8 == func_num_args())
        {
            $this->email         = func_get_arg(0);
            $this->firstName     = func_get_arg(1);
            $this->lastName      = func_get_arg(2);
            $this->businessName  = func_get_arg(3);
            $this->externalUrl   = func_get_arg(4);
            $this->permalink     = func_get_arg(5);
            $this->timezone      = func_get_arg(6);
            $this->apiKey        = func_get_arg(7);
        }
    }

    /**
     * Return a property of the response if it exists.
     * Possibilities include: code, raw_body, headers, body (if the response is json-decodable)
     * @return mixed
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            //UTF-8 is recommended for correct JSON serialization
            $value = $this->$property;
            if (is_string($value) && mb_detect_encoding($value, "UTF-8", TRUE) != "UTF-8") {
                return utf8_encode($value);
            }
            else {
                return $value;
            }
        }
    }
    
    /**
     * Set the properties of this object
     * @param string $property the property name
     * @param mixed $value the property value
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            //UTF-8 is recommended for correct JSON serialization
            if (is_string($value) && mb_detect_encoding($value, "UTF-8", TRUE) != "UTF-8") {
                $this->$property = utf8_encode($value);
            }
            else {
                $this->$property = $value;
            }
        }

        return $this;
    }

    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['email']         = $this->email;
        $json['first_name']    = $this->firstName;
        $json['last_name']     = $this->lastName;
        $json['business_name'] = $this->businessName;
        $json['external_url']  = $this->externalUrl;
        $json['permalink']     = $this->permalink;
        $json['timezone']      = $this->timezone;
        $json['api_key']       = $this->apiKey;
        return $json;
    }
}