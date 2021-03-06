<?php
/*
 * Gonebusy
 *
 * This file was automatically generated by APIMATIC v2.0 ( https://apimatic.io ).
 */

namespace GonebusyLib\Models;

use JsonSerializable;

/**
 * @todo Write general description for this model
 */
class EntitiesSearchResponse implements JsonSerializable
{
    /**
     * array of Services matching query
     * @var EntitiesServiceResponse[]|null $services public property
     */
    public $services;

    /**
     * array of Users matching query
     * @var EntitiesUserResponse[]|null $users public property
     */
    public $users;

    /**
     * Constructor to set initial or default values of member properties
     * @param array $services Initialization value for $this->services
     * @param array $users    Initialization value for $this->users
     */
    public function __construct()
    {
        if (2 == func_num_args()) {
            $this->services = func_get_arg(0);
            $this->users    = func_get_arg(1);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['services'] = $this->services;
        $json['users']    = $this->users;

        return $json;
    }
}
