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
class GetResourcesResponse implements JsonSerializable {
    /**
     * @todo Write general description for this property
     * @var EntitiesResourceResponse[] $resources public property
     */
    public $resources;

    /**
     * Constructor to set initial or default values of member properties
     * @param   array             $resources   Initialization value for the property $this->resources
     */
    public function __construct()
    {
        if(1 == func_num_args())
        {
            $this->resources = func_get_arg(0);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['resources'] = $this->resources;

        return $json;
    }
}