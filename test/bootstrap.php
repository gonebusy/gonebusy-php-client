<?php

// To have the SDK namespaces available for the test cases
require_once "vendor/autoload.php";

use GonebusyLib\Environments;
use GonebusyLib\Configuration;

Configuration::$environment = Environments::SANDBOX;
