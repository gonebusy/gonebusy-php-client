<?php

namespace GonebusyLib\Controllers;

class CategoriesControllerTest extends \PHPUnit_Framework_TestCase
{
    protected $baseUrl = 'http://localhost/en';

    public function testPOST()
    {
        // HTTP client (Guzzle)
        $client = new CategoriesController();

        $this->baseUrl;

        $this->headers['Accept'] = 'application/json';
        $this->headers['Authorization'] = 'Bearer '.$token;

        $nickname = 'ObjectOrienter'.rand(0, 999);
        $data = array(
        "categories" => array(
            "id" => 0,
            "name" => "string",
            "short_name" => "string",
            "long_name" => "string",
            "description" => "string",
            "parent_category_id" => 0,
            "is_active" => true,
            "subcategories" => array(0)
            )
        );

        $request = $client->post('/categories', null, json_encode($data));
        $response = $request->send();

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertTrue($response->hasHeader('Location'));
        $data = json_decode($response->getBody(true), true);
        $this->assertArrayHasKey('nickname', $data);
    }

}
