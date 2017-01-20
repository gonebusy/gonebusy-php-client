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
class CreatePricingModelResponse implements JsonSerializable {
    /**
     * @todo Write general description for this property
     * @maps pricing_model
     * @var EntitiesPricingModelResponse $pricingModel public property
     */
    public $pricingModel;

    /**
     * Constructor to set initial or default values of member properties
     * @param   EntitiesPricingModelResponse   $pricingModel    Initialization value for the property $this->pricingModel 
     */
    public function __construct()
    {
        if(1 == func_num_args())
        {
            $this->pricingModel  = func_get_arg(0);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['pricing_model'] = $this->pricingModel;

        return $json;
    }
}
