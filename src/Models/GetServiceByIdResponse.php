<?php
/*
 * GonebusyLib
 *
 * This file was automatically generated by APIMATIC v2.0 ( https://apimatic.io ).
 */

namespace GonebusyLib\Models;

use JsonSerializable;

/**
 * @todo Write general description for this model
 */
class GetServiceByIdResponse implements JsonSerializable
{
    /**
     * @todo Write general description for this property
     * @var EntitiesServiceResponse $service public property
     */
    public $service;

    /**
     * Constructor to set initial or default values of member properties
     * @param EntitiesServiceResponse $service Initialization value for $this->service
     */
    public function __construct()
    {
        if (1 == func_num_args()) {
            $this->service = func_get_arg(0);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['service'] = $this->service;

        return $json;
    }
}
