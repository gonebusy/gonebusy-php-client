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
class CreateServiceBody implements JsonSerializable {
    /**
     * Service Description
     * @required
     * @var string $description public property
     */
    public $description;

    /**
     * Duration of the Service in minutes
     * @required
     * @var integer $duration public property
     */
    public $duration;

    /**
     * Max duration of the Service in minutes
     * @required
     * @var integer $maxDuration public property
     */
    public $maxDuration;

    /**
     * Service Name
     * @required
     * @var string $name public property
     */
    public $name;

    /**
     * Optional List of comma-separated Category IDs to associate with Service
     * @var string $categories public property
     */
    public $categories;

    /**
     * Optional Price Model Id
     * @maps price_model_id
     * @var integer $priceModelId public property
     */
    public $priceModelId;

    /**
     * Optional List of comma-separated Resource IDs that will provide this Service, default: API user's resource id
     * @var string $resources public property
     */
    public $resources;

    /**
     * Optional abbreviated Service name
     * @maps short_name
     * @var string $shortName public property
     */
    public $shortName;

    /**
     * ID of User to create Service for.  You must be authorized to manage this User Id.
     * @maps user_id
     * @var integer $userId public property
     */
    public $userId;

    /**
     * Constructor to set initial or default values of member properties
     * @param   string            $description      Initialization value for the property $this->description   
     * @param   integer           $duration         Initialization value for the property $this->duration      
     * @param   integer           $maxDuration      Initialization value for the property $this->maxDuration      
     * @param   string            $name             Initialization value for the property $this->name          
     * @param   string            $categories       Initialization value for the property $this->categories    
     * @param   integer           $priceModelId     Initialization value for the property $this->priceModelId  
     * @param   string            $resources        Initialization value for the property $this->resources     
     * @param   string            $shortName        Initialization value for the property $this->shortName     
     * @param   integer           $userId           Initialization value for the property $this->userId        
     */
    public function __construct()
    {
        if(9 == func_num_args())
        {
            $this->description    = func_get_arg(0);
            $this->duration       = func_get_arg(1);
            $this->maxDuration    = func_get_arg(2);
            $this->name           = func_get_arg(3);
            $this->categories     = func_get_arg(4);
            $this->priceModelId   = func_get_arg(5);
            $this->resources      = func_get_arg(6);
            $this->shortName      = func_get_arg(7);
            $this->userId         = func_get_arg(8);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['description']    = $this->description;
        $json['duration']       = $this->duration;
        $json['max_duration']   = $this->maxDuration;
        $json['name']           = $this->name;
        $json['categories']     = $this->categories;
        $json['price_model_id'] = $this->priceModelId;
        $json['resources']      = $this->resources;
        $json['short_name']     = $this->shortName;
        $json['user_id']        = $this->userId;

        return $json;
    }
}
