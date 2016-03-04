<?php 
/*
 * Gonebusy
 *
 * This file was automatically generated for GoneBusy Inc. by APIMATIC BETA v2.0 on 03/04/2016
 */

namespace GonebusyLib\Models;

use JsonSerializable;

class UpdateResourceByIdBody implements JsonSerializable {
    /**
     * Resource Name
     * @param string|null $name public property
     */
    protected $name;

    /**
     * Valid API Key for your GoneBusy account
     * (edit in top nav)
     * @param string $apiKey public property
     */
    protected $apiKey;

    /**
     * Optional Description
     * @param string|null $description public property
     */
    protected $description;

    /**
     * Optional Capacity
     * @param int|null $capacity public property
     */
    protected $capacity;

    /**
     * Optional Gender
     * @param string|null $gender public property
     */
    protected $gender;

    /**
     * When Resource is a Thing, the type Id
     * @param int|null $thingTypeId public property
     */
    protected $thingTypeId;

    /**
     * Constructor to set initial or default values of member properties
	 * @param   string|null       $name            Initialization value for the property $this->name         
	 * @param   string            $apiKey          Initialization value for the property $this->apiKey       
	 * @param   string|null       $description     Initialization value for the property $this->description  
	 * @param   int|null          $capacity        Initialization value for the property $this->capacity     
	 * @param   string|null       $gender          Initialization value for the property $this->gender       
	 * @param   int|null          $thingTypeId     Initialization value for the property $this->thingTypeId  
     */
    public function __construct()
    {
        if(6 == func_num_args())
        {
            $this->name          = func_get_arg(0);
            $this->apiKey        = func_get_arg(1);
            $this->description   = func_get_arg(2);
            $this->capacity      = func_get_arg(3);
            $this->gender        = func_get_arg(4);
            $this->thingTypeId   = func_get_arg(5);
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
        $json['name']          = $this->name;
        $json['api_key']       = $this->apiKey;
        $json['description']   = $this->description;
        $json['capacity']      = $this->capacity;
        $json['gender']        = $this->gender;
        $json['thing_type_id'] = $this->thingTypeId;
        return $json;
    }
}