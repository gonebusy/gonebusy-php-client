<?php

namespace GonebusyLib\Controllers;


 class CategoriesControllerTest  extends \PHPUnit_Framework_TestCase
{
    public function testErrorReported()
    {
        // Create a mock for the Observer class, mocking the
        // reportError() method
        $observer = $this->getMockBuilder('GonebusyLib\Controllers\CategoriesController')
                         ->setMethods(array('getCategories'))
                         ->getMock();

	$observer->expects($this->once())
            ->method('callExit');

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

	$request = $observer->post('/categories', null, json_encode($data));
	    $response = $request->send();

	    $this->assertEquals(200, $response->getStatusCode());
	    $this->assertTrue($response->hasHeader('Location'));
	    $data = json_decode($response->getBody(true), true);
	    $this->assertArrayHasKey('categories', $data);


    }
}
