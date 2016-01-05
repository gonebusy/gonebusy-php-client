<?php 
/*
 * GoneBusy
 *
 * This file was automatically generated for GoneBusy Inc. by APIMATIC BETA v2.0 on 01/05/2016
 */

namespace GoneBusyLib\Models;

use JsonSerializable;

class RegisterUserAsProBody implements JsonSerializable {
    /**
     * User Name
     * @param string $businessName public property
     */
    protected $businessName;

    /**
     * User's Website URL
     * @param string|null $externalUrl public property
     */
    protected $externalUrl;

    /**
     * Valid API Key for your GoneBusy account
     * (edit in top nav)
     * @param string $apiKey public property
     */
    protected $apiKey;

    /**
     * Constructor to set initial or default values of member properties
	 * @param   string            $businessName    Initialization value for the property $this->businessName 
	 * @param   string|null       $externalUrl     Initialization value for the property $this->externalUrl  
	 * @param   string            $apiKey          Initialization value for the property $this->apiKey       
     */
    public function __construct()
    {
        if(3 == func_num_args())
        {
            $this->businessName  = func_get_arg(0);
            $this->externalUrl   = func_get_arg(1);
            $this->apiKey        = func_get_arg(2);
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
        $json['business_name'] = $this->businessName;
        $json['external_url']  = $this->externalUrl;
        $json['api_key']       = $this->apiKey;
        return $json;
    }
}