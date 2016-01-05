<?php 
/*
 * GoneBusy
 *
 * This file was automatically generated for GoneBusy Inc. by APIMATIC BETA v2.0 on 01/05/2016
 */

namespace GoneBusyLib\Models;

use JsonSerializable;

class CreateBookingBody implements JsonSerializable {
    /**
     * ID of Service being booked
     * @param int $serviceId public property
     */
    protected $serviceId;

    /**
     * Desired date of booking.  Several formats are supported: "2014-10-31", "October 31, 2014"
     * @param string $date public property
     */
    protected $date;

    /**
     * Desired time of booking.  Several formats are supported: '9am', '09:00', '9:00', '0900'
     * @param string $time public property
     */
    protected $time;

    /**
     * ID of a Resource to be booked.  If not provided, the first available Resource will be booked.
     * @param int|null $resourceId public property
     */
    protected $resourceId;

    /**
     * Length of time, in minutes, for the desired booking - if Service allows requesting a variable amount of time
     * @param int|null $duration public property
     */
    protected $duration;

    /**
     * Create a booking for this User Id.  You must be authorized to manage this User Id.
     * @param int|null $userId public property
     */
    protected $userId;

    /**
     * Valid API Key for your GoneBusy account
     * (edit in top nav)
     * @param string $apiKey public property
     */
    protected $apiKey;

    /**
     * Constructor to set initial or default values of member properties
	 * @param   int               $serviceId     Initialization value for the property $this->serviceId  
	 * @param   string            $date          Initialization value for the property $this->date       
	 * @param   string            $time          Initialization value for the property $this->time       
	 * @param   int|null          $resourceId    Initialization value for the property $this->resourceId 
	 * @param   int|null          $duration      Initialization value for the property $this->duration   
	 * @param   int|null          $userId        Initialization value for the property $this->userId     
	 * @param   string            $apiKey        Initialization value for the property $this->apiKey     
     */
    public function __construct()
    {
        if(7 == func_num_args())
        {
            $this->serviceId   = func_get_arg(0);
            $this->date        = func_get_arg(1);
            $this->time        = func_get_arg(2);
            $this->resourceId  = func_get_arg(3);
            $this->duration    = func_get_arg(4);
            $this->userId      = func_get_arg(5);
            $this->apiKey      = func_get_arg(6);
        }
    }

    /**
     * Return a property of the response if it exists.
     * Possibilities include: code, raw_body, headers, body (if the response is json-decodable)
     * @return mixed
     */
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            //UTF-8 is recommended for correct JSON serialization
            $value = $this->$property;
            if (is_string($value) && mb_detect_encoding($value, "UTF-8", TRUE) != "UTF-8") {
                return utf8_encode($value);
            }
            else {
                return $value;
            }
        }
    }
    
    /**
     * Set the properties of this object
     * @param string $property the property name
     * @param mixed $value the property value
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            //UTF-8 is recommended for correct JSON serialization
            if (is_string($value) && mb_detect_encoding($value, "UTF-8", TRUE) != "UTF-8") {
                $this->$property = utf8_encode($value);
            }
            else {
                $this->$property = $value;
            }
        }

        return $this;
    }

    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['service_id']  = $this->serviceId;
        $json['date']        = $this->date;
        $json['time']        = $this->time;
        $json['resource_id'] = $this->resourceId;
        $json['duration']    = $this->duration;
        $json['user_id']     = $this->userId;
        $json['api_key']     = $this->apiKey;
        return $json;
    }
}