<?php
/*
 * Gonebusy
 *
 */

namespace GonebusyLib;

/**
 * All configuration including auth info and base URI for the API access
 * are configured in this class. 
 */
class Configuration {
    /**
     * The base Uri for API calls
     * @var string
     */
    public static $BASEURI = 'http://beta.gonebusy.com/api/v1';

    /**
     * Set Authorization to "Token <your API key>"
     * @var string
     */
    /**
     * @todo Replace the $authorization with an appropriate value
     */
    public static $authorization = 'Token <your API key>';

}
