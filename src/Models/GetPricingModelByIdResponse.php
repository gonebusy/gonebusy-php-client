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
class GetPricingModelByIdResponse implements JsonSerializable {
    /**
     * @todo Write general description for this property
     * @maps pricing_models
     * @var EntitiesPricingModelResponse $pricingModels public property
     */
    public $pricingModels;

    /**
     * Constructor to set initial or default values of member properties
     * @param   EntitiesPricingModelResponse   $pricingModels    Initialization value for the property $this->pricingModels 
     */
    public function __construct()
    {
        if(1 == func_num_args())
        {
            $this->pricingModels  = func_get_arg(0);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['pricing_models'] = $this->pricingModels;

        return $json;
    }
}