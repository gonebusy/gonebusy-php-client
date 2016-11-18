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
class EntitiesResourceResponse implements JsonSerializable {
    /**
     * capacity of Resource, if applicable
     * @var integer $capacity public property
     */
    public $capacity;

    /**
     * description of Resource
     * @var string $description public property
     */
    public $description;

    /**
     * gender of Resource, if applicable
     * @var integer $gender public property
     */
    public $gender;

    /**
     * id of Resource
     * @var integer $id public property
     */
    public $id;

    /**
     * name of Resource
     * @var string $name public property
     */
    public $name;

    /**
     * id of User owning Resource
     * @maps owner_id
     * @var integer $ownerId public property
     */
    public $ownerId;

    /**
     * type of Resource
     * @maps resource_type
     * @var string $resourceType public property
     */
    public $resourceType;

    /**
     * type Id of Thing Resource, if applicable
     * @maps thing_type_id
     * @var integer $thingTypeId public property
     */
    public $thingTypeId;

    /**
     * Constructor to set initial or default values of member properties
     * @param   integer           $capacity        Initialization value for the property $this->capacity     
     * @param   string            $description     Initialization value for the property $this->description  
     * @param   integer           $gender          Initialization value for the property $this->gender       
     * @param   integer           $id              Initialization value for the property $this->id           
     * @param   string            $name            Initialization value for the property $this->name         
     * @param   integer           $ownerId         Initialization value for the property $this->ownerId      
     * @param   string            $resourceType    Initialization value for the property $this->resourceType 
     * @param   integer           $thingTypeId     Initialization value for the property $this->thingTypeId  
     */
    public function __construct()
    {
        if(8 == func_num_args())
        {
            $this->capacity      = func_get_arg(0);
            $this->description   = func_get_arg(1);
            $this->gender        = func_get_arg(2);
            $this->id            = func_get_arg(3);
            $this->name          = func_get_arg(4);
            $this->ownerId       = func_get_arg(5);
            $this->resourceType  = func_get_arg(6);
            $this->thingTypeId   = func_get_arg(7);
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
        $json['id']            = $this->id;
        $json['name']          = $this->name;
        $json['owner_id']      = $this->ownerId;
        $json['resource_type'] = $this->resourceType;
        $json['thing_type_id'] = $this->thingTypeId;

        return $json;
    }
}