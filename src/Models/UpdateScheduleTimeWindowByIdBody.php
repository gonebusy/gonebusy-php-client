<?php 
/*
 * Gonebusy
 *
 * This file was automatically generated for GoneBusy Inc. by APIMATIC BETA v2.0 on 03/04/2016
 */

namespace GonebusyLib\Models;

use JsonSerializable;

class UpdateScheduleTimeWindowByIdBody implements JsonSerializable {
    /**
     * Start Date of TimeWindow. Several formats are supported: '2014-10-31', 'October 31, 2014'.
     * @param DateTime|null $startDate public property
     */
    protected $startDate;

    /**
     * End Date of TimeWindow, leave blank for infinitely available. Several formats are supported: '2014-10-31', 'October 31, 2014'.
     * @param DateTime|null $endDate public property
     */
    protected $endDate;

    /**
     * Start Time of first TimeWindow.  Several formats are supported: '9am', '09:00', '9:00', '0900'
     * @param string|null $startTime public property
     */
    protected $startTime;

    /**
     * End Time of first TimeWindow.  Several formats are supported: '5pm', '17:00', '1700'
     * @param string|null $endTime public property
     */
    protected $endTime;

    /**
     * Optional total number of minutes in TimeWindow.  Useful when duration of window is greater than 24 hours.
     * @param int|null $totalMinutes public property
     */
    protected $totalMinutes;

    /**
     * List of comma-separated days of the week this window of time falls on.  If provided, at least one must be specified.
     * @param string|null $days public property
     */
    protected $days;

    /**
     * One of the possible recurrence values
     * @param string|null $recursBy public property
     */
    protected $recursBy;

    /**
     * Optional frequency of recurrence as specified by :recurs_by.  E.g, :single, :every, :every_other, etc. If not provided, assumed to be :every
     * @param string|null $frequency public property
     */
    protected $frequency;

    /**
     * Optional occurrence of frequency. E.g, :first, :2nd, :last, :2nd_to_last, etc.  If not provided, assumed to be :every.  See Schedule examples.
     * @param string|null $occurrence public property
     */
    protected $occurrence;

    /**
     * Required only when :recurs_by is 'monthly' or 'yearly' to differentiate between exact date or 'day in month/year'.  See Schedule examples.
     * @param string|null $dateRecursBy public property
     */
    protected $dateRecursBy;

    /**
     * Valid API Key for your GoneBusy account
     * (edit in top nav)
     * @param string $apiKey public property
     */
    protected $apiKey;

    /**
     * Constructor to set initial or default values of member properties
	 * @param   DateTime|null     $startDate        Initialization value for the property $this->startDate     
	 * @param   DateTime|null     $endDate          Initialization value for the property $this->endDate       
	 * @param   string|null       $startTime        Initialization value for the property $this->startTime     
	 * @param   string|null       $endTime          Initialization value for the property $this->endTime       
	 * @param   int|null          $totalMinutes     Initialization value for the property $this->totalMinutes  
	 * @param   string|null       $days             Initialization value for the property $this->days          
	 * @param   string|null       $recursBy         Initialization value for the property $this->recursBy      
	 * @param   string|null       $frequency        Initialization value for the property $this->frequency     
	 * @param   string|null       $occurrence       Initialization value for the property $this->occurrence    
	 * @param   string|null       $dateRecursBy     Initialization value for the property $this->dateRecursBy  
	 * @param   string            $apiKey           Initialization value for the property $this->apiKey        
     */
    public function __construct()
    {
        if(11 == func_num_args())
        {
            $this->startDate      = func_get_arg(0);
            $this->endDate        = func_get_arg(1);
            $this->startTime      = func_get_arg(2);
            $this->endTime        = func_get_arg(3);
            $this->totalMinutes   = func_get_arg(4);
            $this->days           = func_get_arg(5);
            $this->recursBy       = func_get_arg(6);
            $this->frequency      = func_get_arg(7);
            $this->occurrence     = func_get_arg(8);
            $this->dateRecursBy   = func_get_arg(9);
            $this->apiKey         = func_get_arg(10);
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
        $json['start_date']     = $this->startDate;
        $json['end_date']       = $this->endDate;
        $json['start_time']     = $this->startTime;
        $json['end_time']       = $this->endTime;
        $json['total_minutes']  = $this->totalMinutes;
        $json['days']           = $this->days;
        $json['recurs_by']      = $this->recursBy;
        $json['frequency']      = $this->frequency;
        $json['occurrence']     = $this->occurrence;
        $json['date_recurs_by'] = $this->dateRecursBy;
        $json['api_key']        = $this->apiKey;
        return $json;
    }
}