<?php
/*
 * Gonebusy
 *
 * This file was automatically generated by APIMATIC v2.0 ( https://apimatic.io ).
 */

namespace GonebusyLib\Exceptions;

use GonebusyLib\APIException;
use GonebusyLib\APIHelper;

/**
 * @todo Write general description for this model
 */
class EntitiesErrorErrorException extends APIException
{
    /**
 * description of error
     * @var string|null $message public property
     */
    public $message;

    /**
     * Constructor to set initial or default values of member properties
     */
    public function __construct($reason, $context)
    {
        parent::__construct($reason, $context);
    }

    /**
     * Unbox response into this exception class
     */
    public function unbox()
    {
        APIHelper::deserialize(self::getResponseBody(), $this, false, false);
    }
}
