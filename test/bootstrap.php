
<?php

// To have the SDK namespaces available for the test cases
require_once "vendor/autoload.php";

use GonebusyLib\Servers;
use GonebusyLib\Environments;
use GonebusyLib\Configuration;

Configuration::$environment = 'prism';

// XXX the below should be private, mock Configuration::getBaseUri instead?
Configuration::$environmentsMap['prism'] = array(Servers::DEFAULT_ => 'http://localhost:4010');
// print_r(Configuration::$environmentsMap);
