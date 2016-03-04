<?php 
/*
 * Gonebusy
 *
 * This file was automatically generated for GoneBusy Inc. by APIMATIC BETA v2.0 on 03/04/2016
 */

namespace GonebusyLib\Models;

use JsonSerializable;

class CreateCategoryBody implements JsonSerializable {
    /**
     * Category Name
     * @param string $name public property
     */
    protected $name;

    /**
     * Category Description
     * @param string $description public property
     */
    protected $description;

    /**
     * Optional abbreviated Category name
     * @param string|null $shortName public property
     */
    protected $shortName;

    /**
     * Optional full name of Category
     * @param string|null $longName public property
     */
    protected $longName;

    /**
     * Optional Id of Parent Category
     * @param int|null $parentCategoryId public property
     */
    protected $parentCategoryId;

    /**
     * Valid API Key for your GoneBusy account
     * (edit in top nav)
     * @param string $apiKey public property
     */
    protected $apiKey;

    /**
     * Constructor to set initial or default values of member properties
	 * @param   string            $name                 Initialization value for the property $this->name              
	 * @param   string            $description          Initialization value for the property $this->description       
	 * @param   string|null       $shortName            Initialization value for the property $this->shortName         
	 * @param   string|null       $longName             Initialization value for the property $this->longName          
	 * @param   int|null          $parentCategoryId     Initialization value for the property $this->parentCategoryId  
	 * @param   string            $apiKey               Initialization value for the property $this->apiKey            
     */
    public function __construct()
    {
        if(6 == func_num_args())
        {
            $this->name               = func_get_arg(0);
            $this->description        = func_get_arg(1);
            $this->shortName          = func_get_arg(2);
            $this->longName           = func_get_arg(3);
            $this->parentCategoryId   = func_get_arg(4);
            $this->apiKey             = func_get_arg(5);
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
        $json['name']               = $this->name;
        $json['description']        = $this->description;
        $json['short_name']         = $this->shortName;
        $json['long_name']          = $this->longName;
        $json['parent_category_id'] = $this->parentCategoryId;
        $json['api_key']            = $this->apiKey;
        return $json;
    }
}