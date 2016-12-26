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
class CreateBookingResponse implements JsonSerializable {
    /**
     * @todo Write general description for this property
     * @var EntitiesBookingResponse $booking public property
     */
    public $booking;

    /**
     * Constructor to set initial or default values of member properties
     * @param   EntitiesBookingResponse   $booking   Initialization value for the property $this->booking
     */
    public function __construct()
    {
        if(1 == func_num_args())
        {
            $this->booking = func_get_arg(0);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['booking'] = $this->booking;

        return $json;
    }
}