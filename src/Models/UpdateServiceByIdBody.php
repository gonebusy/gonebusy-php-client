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
class UpdateServiceByIdBody implements JsonSerializable {
    /**
     * Optional List of comma-separated Category IDs to associate with Service
     * @var string $categories public property
     */
    public $categories;

    /**
     * Service Description
     * @var string $description public property
     */
    public $description;

    /**
     * Duration of the Service in minutes
     * @var integer $duration public property
     */
    public $duration;

    /**
     * Max duration of the Service in minutes
     * @var integer $maxDuration public property
     */
    public $maxDuration;

    /**
     * Service Name
     * @var string $name public property
     */
    public $name;

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
     * Constructor to set initial or default values of member properties
     * @param   string            $categories       Initialization value for the property $this->categories    
     * @param   string            $description      Initialization value for the property $this->description   
     * @param   integer           $duration         Initialization value for the property $this->duration      
     * @param   integer           $maxDuration      Initialization value for the property $this->maxDuration      
     * @param   string            $name             Initialization value for the property $this->name          
     * @param   integer           $priceModelId     Initialization value for the property $this->priceModelId  
     * @param   string            $resources        Initialization value for the property $this->resources     
     * @param   string            $shortName        Initialization value for the property $this->shortName     
     */
    public function __construct()
    {
        if(8 == func_num_args())
        {
            $this->categories     = func_get_arg(0);
            $this->description    = func_get_arg(1);
            $this->duration       = func_get_arg(2);
            $this->maxDuration    = func_get_arg(3);
            $this->name           = func_get_arg(4);
            $this->priceModelId   = func_get_arg(5);
            $this->resources      = func_get_arg(6);
            $this->shortName      = func_get_arg(7);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['categories']     = $this->categories;
        $json['description']    = $this->description;
        $json['duration']       = $this->duration;
        $json['max_duration']   = $this->maxDuration;
        $json['name']           = $this->name;
        $json['price_model_id'] = $this->priceModelId;
        $json['resources']      = $this->resources;
        $json['short_name']     = $this->shortName;

        return $json;
    }
}
