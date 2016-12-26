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
class EntitiesPricingModelResponse implements JsonSerializable {
    /**
     * currency symbol, as per ISO-4217
     * @var string $currency public property
     */
    public $currency;

    /**
     * id of PricingModel
     * @var integer $id public property
     */
    public $id;

    /**
     * name of PricingModel
     * @var string $name public property
     */
    public $name;

    /**
     * notes and description
     * @var string $notes public property
     */
    public $notes;

    /**
     * id of owner of PricingModel
     * @maps owner_id
     * @var integer $ownerId public property
     */
    public $ownerId;

    /**
     * price/rate
     * @var string $price public property
     */
    public $price;

    /**
     * type of PricingModel
     * @maps pricing_model_type
     * @var string $pricingModelType public property
     */
    public $pricingModelType;

    /**
     * Constructor to set initial or default values of member properties
     * @param   string            $currency             Initialization value for the property $this->currency          
     * @param   integer           $id                   Initialization value for the property $this->id                
     * @param   string            $name                 Initialization value for the property $this->name              
     * @param   string            $notes                Initialization value for the property $this->notes             
     * @param   integer           $ownerId              Initialization value for the property $this->ownerId           
     * @param   string            $price                Initialization value for the property $this->price             
     * @param   string            $pricingModelType     Initialization value for the property $this->pricingModelType  
     */
    public function __construct()
    {
        if(7 == func_num_args())
        {
            $this->currency           = func_get_arg(0);
            $this->id                 = func_get_arg(1);
            $this->name               = func_get_arg(2);
            $this->notes              = func_get_arg(3);
            $this->ownerId            = func_get_arg(4);
            $this->price              = func_get_arg(5);
            $this->pricingModelType   = func_get_arg(6);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['currency']           = $this->currency;
        $json['id']                 = $this->id;
        $json['name']               = $this->name;
        $json['notes']              = $this->notes;
        $json['owner_id']           = $this->ownerId;
        $json['price']              = $this->price;
        $json['pricing_model_type'] = $this->pricingModelType;

        return $json;
    }
}