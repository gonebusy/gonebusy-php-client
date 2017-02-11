<?php
use PHPUnit\Framework\TestCase;

class ServicesTest extends TestCase
{
    protected $client;

    public function testGetServices()
    {
        // TODO Mock objects instead (fixture file)
        $authorization = "Token ac98ed08b5b0a9e7c43a233aeba841ce";
        $client = new GonebusyLib\GonebusyClient($authorization);

    }


}
