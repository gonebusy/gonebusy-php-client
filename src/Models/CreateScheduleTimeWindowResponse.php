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
class CreateScheduleTimeWindowResponse implements JsonSerializable {
    /**
     * @todo Write general description for this property
     * @var EntitiesScheduleResponse $schedule public property
     */
    public $schedule;

    /**
     * Constructor to set initial or default values of member properties
     * @param   EntitiesScheduleResponse   $schedule   Initialization value for the property $this->schedule
     */
    public function __construct()
    {
        if(1 == func_num_args())
        {
            $this->schedule = func_get_arg(0);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['schedule'] = $this->schedule;

        return $json;
    }
}