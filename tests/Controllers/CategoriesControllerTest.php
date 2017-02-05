<?php

class CategoriesControllerTest extends PHPUnit_Framework_TestCase
{
    protected $client;

    public function testGET()
    {
        // TODO Mock objects instead (fixture file)
        $client = new GuzzleHttp\Client(['base_uri' => 'http://sandbox.gonebusy.com']);
        $request = $client->request('GET', 'api/v1/categories', [
            'headers' => [
            'Accept'     => 'application/json',
            'Authorization' => 'Token 2ae673263145c48185f945880f185b2a'
            ]
        ]);

        $this->assertEquals(200, $request->getStatusCode());
        $decodedResponse = $request->getBody()->getContents();
        $data = json_decode($request->getBody(), true);

        $this->assertArrayHasKey('categories', $data);

        // TODO fixture file
        $keys = array('id', 'name' ,'short_name' ,'long_name' ,'description' ,'parent_category_id' ,'is_active' ,'subcategories');
        foreach ($data['categories'] as $ck) {
            foreach ($keys as $k) {
                    $this->assertArrayHasKey($k, $ck);
            }
        }

    }
}
