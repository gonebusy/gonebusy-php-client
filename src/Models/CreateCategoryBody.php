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
class CreateCategoryBody implements JsonSerializable {
    /**
     * Category Description
     * @required
     * @var string $description public property
     */
    public $description;

    /**
     * Category Name
     * @required
     * @var string $name public property
     */
    public $name;

    /**
     * Optional full name of Category
     * @maps long_name
     * @var string $longName public property
     */
    public $longName;

    /**
     * Optional Id of Parent Category
     * @maps parent_category_id
     * @var integer $parentCategoryId public property
     */
    public $parentCategoryId;

    /**
     * Optional abbreviated Category name
     * @maps short_name
     * @var string $shortName public property
     */
    public $shortName;

    /**
     * Constructor to set initial or default values of member properties
     * @param   string            $description          Initialization value for the property $this->description       
     * @param   string            $name                 Initialization value for the property $this->name              
     * @param   string            $longName             Initialization value for the property $this->longName          
     * @param   integer           $parentCategoryId     Initialization value for the property $this->parentCategoryId  
     * @param   string            $shortName            Initialization value for the property $this->shortName         
     */
    public function __construct()
    {
        if(5 == func_num_args())
        {
            $this->description        = func_get_arg(0);
            $this->name               = func_get_arg(1);
            $this->longName           = func_get_arg(2);
            $this->parentCategoryId   = func_get_arg(3);
            $this->shortName          = func_get_arg(4);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['description']        = $this->description;
        $json['name']               = $this->name;
        $json['long_name']          = $this->longName;
        $json['parent_category_id'] = $this->parentCategoryId;
        $json['short_name']         = $this->shortName;

        return $json;
    }
}