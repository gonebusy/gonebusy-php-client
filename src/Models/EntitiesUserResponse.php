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
class EntitiesUserResponse implements JsonSerializable {
    /**
     * id of Account Manager user for User
     * @maps account_manager_id
     * @var integer $accountManagerId public property
     */
    public $accountManagerId;

    /**
     * address of User
     * @var EntitiesAddressEntity $address public property
     */
    public $address;

    /**
     * business name for User
     * @maps business_name
     * @var string $businessName public property
     */
    public $businessName;

    /**
     * status of user
     * @var bool $disabled public property
     */
    public $disabled;

    /**
     * email of User
     * @var string $email public property
     */
    public $email;

    /**
     * external url to business
     * @maps external_url
     * @var string $externalUrl public property
     */
    public $externalUrl;

    /**
     * first name of User
     * @maps first_name
     * @var string $firstName public property
     */
    public $firstName;

    /**
     * id of User
     * @var integer $id public property
     */
    public $id;

    /**
     * last name of User
     * @maps last_name
     * @var string $lastName public property
     */
    public $lastName;

    /**
     * permalink of User
     * @var string $permalink public property
     */
    public $permalink;

    /**
     * phone number of User
     * @var string $phone public property
     */
    public $phone;

    /**
     * id of defacto Resource for User
     * @maps resource_id
     * @var integer $resourceId public property
     */
    public $resourceId;

    /**
     * User account type
     * @var string $role public property
     */
    public $role;

    /**
     * timezone of User,
     * @var string $timezone public property
     */
    public $timezone;

    /**
     * Constructor to set initial or default values of member properties
     * @param   integer           $accountManagerId     Initialization value for the property $this->accountManagerId  
     * @param   EntitiesAddressEntity   $address              Initialization value for the property $this->address           
     * @param   string            $businessName         Initialization value for the property $this->businessName      
     * @param   bool              $disabled             Initialization value for the property $this->disabled          
     * @param   string            $email                Initialization value for the property $this->email             
     * @param   string            $externalUrl          Initialization value for the property $this->externalUrl       
     * @param   string            $firstName            Initialization value for the property $this->firstName         
     * @param   integer           $id                   Initialization value for the property $this->id                
     * @param   string            $lastName             Initialization value for the property $this->lastName          
     * @param   string            $permalink            Initialization value for the property $this->permalink         
     * @param   string            $phone                Initialization value for the property $this->phone             
     * @param   integer           $resourceId           Initialization value for the property $this->resourceId        
     * @param   string            $role                 Initialization value for the property $this->role              
     * @param   string            $timezone             Initialization value for the property $this->timezone          
     */
    public function __construct()
    {
        if(14 == func_num_args())
        {
            $this->accountManagerId   = func_get_arg(0);
            $this->address            = func_get_arg(1);
            $this->businessName       = func_get_arg(2);
            $this->disabled           = func_get_arg(3);
            $this->email              = func_get_arg(4);
            $this->externalUrl        = func_get_arg(5);
            $this->firstName          = func_get_arg(6);
            $this->id                 = func_get_arg(7);
            $this->lastName           = func_get_arg(8);
            $this->permalink          = func_get_arg(9);
            $this->phone              = func_get_arg(10);
            $this->resourceId         = func_get_arg(11);
            $this->role               = func_get_arg(12);
            $this->timezone           = func_get_arg(13);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['account_manager_id'] = $this->accountManagerId;
        $json['address']            = $this->address;
        $json['business_name']      = $this->businessName;
        $json['disabled']           = $this->disabled;
        $json['email']              = $this->email;
        $json['external_url']       = $this->externalUrl;
        $json['first_name']         = $this->firstName;
        $json['id']                 = $this->id;
        $json['last_name']          = $this->lastName;
        $json['permalink']          = $this->permalink;
        $json['phone']              = $this->phone;
        $json['resource_id']        = $this->resourceId;
        $json['role']               = $this->role;
        $json['timezone']           = $this->timezone;

        return $json;
    }
}