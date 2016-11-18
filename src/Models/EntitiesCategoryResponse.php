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
class EntitiesCategoryResponse implements JsonSerializable {
    /**
     * description of Category
     * @var string $description public property
     */
    public $description;

    /**
     * id of Category
     * @var integer $id public property
     */
    public $id;

    /**
     * status of Category
     * @maps is_active
     * @var bool $isActive public property
     */
    public $isActive;

    /**
     * extended name for Category
     * @maps long_name
     * @var string $longName public property
     */
    public $longName;

    /**
     * name of Category
     * @var string $name public property
     */
    public $name;

    /**
     * id of parent Category, if any
     * @maps parent_category_id
     * @var integer $parentCategoryId public property
     */
    public $parentCategoryId;

    /**
     * abbreviated name for Category
     * @maps short_name
     * @var string $shortName public property
     */
    public $shortName;

    /**
     * array of subcategory ids, if any
     * @var array $subcategories public property
     */
    public $subcategories;

    /**
     * Constructor to set initial or default values of member properties
     * @param   string            $description          Initialization value for the property $this->description       
     * @param   integer           $id                   Initialization value for the property $this->id                
     * @param   bool              $isActive             Initialization value for the property $this->isActive          
     * @param   string            $longName             Initialization value for the property $this->longName          
     * @param   string            $name                 Initialization value for the property $this->name              
     * @param   integer           $parentCategoryId     Initialization value for the property $this->parentCategoryId  
     * @param   string            $shortName            Initialization value for the property $this->shortName         
     * @param   array             $subcategories        Initialization value for the property $this->subcategories     
     */
    public function __construct()
    {
        if(8 == func_num_args())
        {
            $this->description        = func_get_arg(0);
            $this->id                 = func_get_arg(1);
            $this->isActive           = func_get_arg(2);
            $this->longName           = func_get_arg(3);
            $this->name               = func_get_arg(4);
            $this->parentCategoryId   = func_get_arg(5);
            $this->shortName          = func_get_arg(6);
            $this->subcategories      = func_get_arg(7);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['description']        = $this->description;
        $json['id']                 = $this->id;
        $json['is_active']          = $this->isActive;
        $json['long_name']          = $this->longName;
        $json['name']               = $this->name;
        $json['parent_category_id'] = $this->parentCategoryId;
        $json['short_name']         = $this->shortName;
        $json['subcategories']      = $this->subcategories;

        return $json;
    }
}