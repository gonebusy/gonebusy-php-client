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
class GetSchedulesResponse implements JsonSerializable {
    /**
     * @todo Write general description for this property
     * @var EntitiesScheduleResponse[] $schedules public property
     */
    public $schedules;

    /**
     * Constructor to set initial or default values of member properties
     * @param   array             $schedules   Initialization value for the property $this->schedules
     */
    public function __construct()
    {
        if(1 == func_num_args())
        {
            $this->schedules = func_get_arg(0);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['schedules'] = $this->schedules;

        return $json;
    }
}