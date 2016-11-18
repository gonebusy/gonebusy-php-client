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
class CreateBookingBody implements JsonSerializable {
    /**
     * Desired date of booking.  Several formats are supported: "2014-10-31", "October 31, 2014"
     * @required
     * @var string $date public property
     */
    public $date;

    /**
     * ID of Service being booked
     * @required
     * @maps service_id
     * @var integer $serviceId public property
     */
    public $serviceId;

    /**
     * Desired time of booking.  Several formats are supported: '9am', '09:00', '9:00', '0900'
     * @required
     * @var string $time public property
     */
    public $time;

    /**
     * Length of time, in minutes, for the desired booking - if Service allows requesting a variable amount of time
     * @var integer $duration public property
     */
    public $duration;

    /**
     * ID of a Resource to be booked.  If not provided, the first available Resource will be booked.
     * @maps resource_id
     * @var integer $resourceId public property
     */
    public $resourceId;

    /**
     * Create a booking for this User Id.  You must be authorized to manage this User Id.
     * @maps user_id
     * @var integer $userId public property
     */
    public $userId;

    /**
     * Constructor to set initial or default values of member properties
     * @param   string            $date          Initialization value for the property $this->date       
     * @param   integer           $serviceId     Initialization value for the property $this->serviceId  
     * @param   string            $time          Initialization value for the property $this->time       
     * @param   integer           $duration      Initialization value for the property $this->duration   
     * @param   integer           $resourceId    Initialization value for the property $this->resourceId 
     * @param   integer           $userId        Initialization value for the property $this->userId     
     */
    public function __construct()
    {
        if(6 == func_num_args())
        {
            $this->date        = func_get_arg(0);
            $this->serviceId   = func_get_arg(1);
            $this->time        = func_get_arg(2);
            $this->duration    = func_get_arg(3);
            $this->resourceId  = func_get_arg(4);
            $this->userId      = func_get_arg(5);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['date']        = $this->date;
        $json['service_id']  = $this->serviceId;
        $json['time']        = $this->time;
        $json['duration']    = $this->duration;
        $json['resource_id'] = $this->resourceId;
        $json['user_id']     = $this->userId;

        return $json;
    }
}