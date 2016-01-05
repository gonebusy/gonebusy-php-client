<?php 
/*
 * GoneBusy
 *
 * This file was automatically generated for GoneBusy Inc. by APIMATIC BETA v2.0 on 01/05/2016
 */

namespace GoneBusyLib\Models;

use JsonSerializable;

class CreateServiceBody implements JsonSerializable {
    /**
     * Service Name
     * @param string $name public property
     */
    protected $name;

    /**
     * Service Description
     * @param string $description public property
     */
    protected $description;

    /**
     * Duration in minutes of the Service
     * @param int $duration public property
     */
    protected $duration;

    /**
     * ID of User to create Service for.  You must be authorized to manage this User Id.
     * @param int|null $userId public property
     */
    protected $userId;

    /**
     * Optional abbreviated Service name
     * @param string|null $shortName public property
     */
    protected $shortName;

    /**
     * Optional Price Model Id
     * @param int|null $priceModelId public property
     */
    protected $priceModelId;

    /**
     * Optional List of comma-separated Resource IDs that will provide this Service, default: API user's resource id
     * @param string|null $resources public property
     */
    protected $resources;

    /**
     * Optional List of comma-separated Category IDs to associate with Service
     * @param string|null $categories public property
     */
    protected $categories;

    /**
     * Valid API Key for your GoneBusy account
     * (edit in top nav)
     * @param string $apiKey public property
     */
    protected $apiKey;

    /**
     * Constructor to set initial or default values of member properties
	 * @param   string            $name             Initialization value for the property $this->name          
	 * @param   string            $description      Initialization value for the property $this->description   
	 * @param   int               $duration         Initialization value for the property $this->duration      
	 * @param   int|null          $userId           Initialization value for the property $this->userId        
	 * @param   string|null       $shortName        Initialization value for the property $this->shortName     
	 * @param   int|null          $priceModelId     Initialization value for the property $this->priceModelId  
	 * @param   string|null       $resources        Initialization value for the property $this->resources     
	 * @param   string|null       $categories       Initialization value for the property $this->categories    
	 * @param   string            $apiKey           Initialization value for the property $this->apiKey        
     */
    public function __construct()
    {
        if(9 == func_num_args())
        {
            $this->name           = func_get_arg(0);
            $this->description    = func_get_arg(1);
            $this->duration       = func_get_arg(2);
            $this->userId         = func_get_arg(3);
            $this->shortName      = func_get_arg(4);
            $this->priceModelId   = func_get_arg(5);
            $this->resources      = func_get_arg(6);
            $this->categories     = func_get_arg(7);
            $this->apiKey         = func_get_arg(8);
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
        $json['name']           = $this->name;
        $json['description']    = $this->description;
        $json['duration']       = $this->duration;
        $json['user_id']        = $this->userId;
        $json['short_name']     = $this->shortName;
        $json['price_model_id'] = $this->priceModelId;
        $json['resources']      = $this->resources;
        $json['categories']     = $this->categories;
        $json['api_key']        = $this->apiKey;
        return $json;
    }
}