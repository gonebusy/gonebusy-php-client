<?php
/*
 * Gonebusy
 *
 * This file was automatically generated for GoneBusy Inc. by APIMATIC v2.0 ( https://apimatic.io ) on 11/18/2016
 */

namespace GonebusyLib\Exceptions;

use GonebusyLib\APIException;
use GonebusyLib\APIHelper;
/**
 * @todo Write general description for this model
 */
class EntitiesErrorException extends APIException{
    /**
     * description of error
     * @var string $message public property
     */
    public $message;


    /**
    * Constructor to set initial or default values of member properties 
    */
    public function __construct($reason,$context)
    {
        parent::__construct($reason,$context);
    }

    public function unbox()
    {
        $data = APIHelper::deserialize(self::getResponseBody());
        $message = $data['message'];
    }
}