<?php

// To have the SDK namespaces available for the test cases
require_once "vendor/autoload.php";

use GonebusyLib\Environments;
use GonebusyLib\Configuration;

Configuration::$environment = Environments::SANDBOX;
Configuration::$authorization = "Token ac98ed08b5b0a9e7c43a233aeba841ce"; // <testing@gonebusy.com>
