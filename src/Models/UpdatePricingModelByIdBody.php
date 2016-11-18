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
class UpdatePricingModelByIdBody implements JsonSerializable {
    /**
     * 3 Letter ISO Currency Code
     * @var string $currency public property
     */
    public $currency;

    /**
     * PricingModel Name
     * @var string $name public property
     */
    public $name;

    /**
     * Optional Notes Field
     * @var string $notes public property
     */
    public $notes;

    /**
     * Price
     * @var double $price public property
     */
    public $price;

    /**
     * Constructor to set initial or default values of member properties
     * @param   string            $currency   Initialization value for the property $this->currency
     * @param   string            $name       Initialization value for the property $this->name    
     * @param   string            $notes      Initialization value for the property $this->notes   
     * @param   double            $price      Initialization value for the property $this->price   
     */
    public function __construct()
    {
        if(4 == func_num_args())
        {
            $this->currency = func_get_arg(0);
            $this->name     = func_get_arg(1);
            $this->notes    = func_get_arg(2);
            $this->price    = func_get_arg(3);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['currency'] = $this->currency;
        $json['name']     = $this->name;
        $json['notes']    = $this->notes;
        $json['price']    = $this->price;

        return $json;
    }
}