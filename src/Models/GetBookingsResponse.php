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
class GetBookingsResponse implements JsonSerializable {
    /**
     * @todo Write general description for this property
     * @var EntitiesBookingResponse[] $bookings public property
     */
    public $bookings;

    /**
     * Constructor to set initial or default values of member properties
     * @param   array             $bookings   Initialization value for the property $this->bookings
     */
    public function __construct()
    {
        if(1 == func_num_args())
        {
            $this->bookings = func_get_arg(0);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['bookings'] = $this->bookings;

        return $json;
    }
}