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
class UpdateUserByIdBody implements JsonSerializable {
    /**
     * Optional name for your Business/Organization
     * @maps business_name
     * @var string $businessName public property
     */
    public $businessName;

    /**
     * User's email address
     * @var string $email public property
     */
    public $email;

    /**
     * Optional website URL
     * @maps external_url
     * @var string $externalUrl public property
     */
    public $externalUrl;

    /**
     * Optional first name
     * @maps first_name
     * @var string $firstName public property
     */
    public $firstName;

    /**
     * Optional last name
     * @maps last_name
     * @var string $lastName public property
     */
    public $lastName;

    /**
     * Optional vanity url - ex: www.gonebusy.com/[permalink] - must be unique
     * @var string $permalink public property
     */
    public $permalink;

    /**
     * Optional timezone
     * @var string $timezone public property
     */
    public $timezone;

    /**
     * Constructor to set initial or default values of member properties
     * @param   string            $businessName    Initialization value for the property $this->businessName 
     * @param   string            $email           Initialization value for the property $this->email        
     * @param   string            $externalUrl     Initialization value for the property $this->externalUrl  
     * @param   string            $firstName       Initialization value for the property $this->firstName    
     * @param   string            $lastName        Initialization value for the property $this->lastName     
     * @param   string            $permalink       Initialization value for the property $this->permalink    
     * @param   string            $timezone        Initialization value for the property $this->timezone     
     */
    public function __construct()
    {
        if(7 == func_num_args())
        {
            $this->businessName  = func_get_arg(0);
            $this->email         = func_get_arg(1);
            $this->externalUrl   = func_get_arg(2);
            $this->firstName     = func_get_arg(3);
            $this->lastName      = func_get_arg(4);
            $this->permalink     = func_get_arg(5);
            $this->timezone      = func_get_arg(6);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['business_name'] = $this->businessName;
        $json['email']         = $this->email;
        $json['external_url']  = $this->externalUrl;
        $json['first_name']    = $this->firstName;
        $json['last_name']     = $this->lastName;
        $json['permalink']     = $this->permalink;
        $json['timezone']      = $this->timezone;

        return $json;
    }
}