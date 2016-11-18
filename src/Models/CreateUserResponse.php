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
class CreateUserResponse implements JsonSerializable {
    /**
     * @todo Write general description for this property
     * @var EntitiesUserResponse $user public property
     */
    public $user;

    /**
     * Constructor to set initial or default values of member properties
     * @param   EntitiesUserResponse   $user   Initialization value for the property $this->user
     */
    public function __construct()
    {
        if(1 == func_num_args())
        {
            $this->user = func_get_arg(0);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['user'] = $this->user;

        return $json;
    }
}