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
class CreateResourceBody implements JsonSerializable {
    /**
     * Resource Name
     * @required
     * @var string $name public property
     */
    public $name;

    /**
     * Type of Resource
     * @required
     * @var string $type public property
     */
    public $type;

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
     * When Resource is a Thing, the type Id
     * @maps thing_type_id
     * @var integer $thingTypeId public property
     */
    public $thingTypeId;

    /**
     * Create a Resource for this User Id.  You must be authorized to manage this User Id.
     * @maps user_id
     * @var integer $userId public property
     */
    public $userId;

    /**
     * Constructor to set initial or default values of member properties
     * @param   string            $name            Initialization value for the property $this->name         
     * @param   string            $type            Initialization value for the property $this->type         
     * @param   integer           $capacity        Initialization value for the property $this->capacity     
     * @param   string            $description     Initialization value for the property $this->description  
     * @param   string            $gender          Initialization value for the property $this->gender       
     * @param   integer           $thingTypeId     Initialization value for the property $this->thingTypeId  
     * @param   integer           $userId          Initialization value for the property $this->userId       
     */
    public function __construct()
    {
        if(7 == func_num_args())
        {
            $this->name          = func_get_arg(0);
            $this->type          = func_get_arg(1);
            $this->capacity      = func_get_arg(2);
            $this->description   = func_get_arg(3);
            $this->gender        = func_get_arg(4);
            $this->thingTypeId   = func_get_arg(5);
            $this->userId        = func_get_arg(6);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['name']          = $this->name;
        $json['type']          = $this->type;
        $json['capacity']      = $this->capacity;
        $json['description']   = $this->description;
        $json['gender']        = $this->gender;
        $json['thing_type_id'] = $this->thingTypeId;
        $json['user_id']       = $this->userId;

        return $json;
    }
}