<?php 
/*
 * Gonebusy
 *
 * This file was automatically generated for GoneBusy Inc. by APIMATIC v2.0 ( https://apimatic.io ) on 11/18/2016
 */

namespace GonebusyLib\Models;

use JsonSerializable;

/**
 * @todo Write general description for this model
 */
class UpdateResourceByIdBody implements JsonSerializable {
    /**
     * Optional Capacity
     * @var integer $capacity public property
     */
    public $capacity;

    /**
     * Optional Description
     * @var string $description public property
     */
    public $description;

    /**
     * Optional Gender
     * @var string $gender public property
     */
    public $gender;

    /**
     * Resource Name
     * @var string $name public property
     */
    public $name;

    /**
     * When Resource is a Thing, the type Id
     * @maps thing_type_id
     * @var integer $thingTypeId public property
     */
    public $thingTypeId;

    /**
     * Constructor to set initial or default values of member properties
     * @param   integer           $capacity        Initialization value for the property $this->capacity     
     * @param   string            $description     Initialization value for the property $this->description  
     * @param   string            $gender          Initialization value for the property $this->gender       
     * @param   string            $name            Initialization value for the property $this->name         
     * @param   integer           $thingTypeId     Initialization value for the property $this->thingTypeId  
     */
    public function __construct()
    {
        if(5 == func_num_args())
        {
            $this->capacity      = func_get_arg(0);
            $this->description   = func_get_arg(1);
            $this->gender        = func_get_arg(2);
            $this->name          = func_get_arg(3);
            $this->thingTypeId   = func_get_arg(4);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['capacity']      = $this->capacity;
        $json['description']   = $this->description;
        $json['gender']        = $this->gender;
        $json['name']          = $this->name;
        $json['thing_type_id'] = $this->thingTypeId;

        return $json;
    }
}