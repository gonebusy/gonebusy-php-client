<?php
/*
 * Resources SDK Controller Test Case
 */

namespace GonebusyTest\Controllers;

use PHPUnit\Framework\TestCase;

use GonebusyLib\Configuration;
use GonebusyLib\GonebusyClient;
use GonebusyLib\Models\CreateResourceBody;
use GonebusyLib\Models\UpdateResourceByIdBody;
// use GonebusyLib\Controllers\ResourceController;
// ^ Not needed since we can use GonebusyClient::getResources()

class ResourcesTest extends TestCase
{
    /**
     * To contain the GonebusyLib\GonebusyClient
     */
    protected $client;

    /**
     * To contain the GonebusyLib\Controllers\ResourceController
     */
    protected $resources;

    /**
     * Create the GonebusyClient and ResourceController for each test.
     */
    public function setUp() {
        $this->client = new GonebusyClient();
        $this->resources = $this->client->getResources();
    }

    /**
     * Returns arbitrary resource data.
     * @param  string $type Should be 'create' or 'update'.
     * @return  CreateResourceBody or UpdateResourceByIdBody object with unique data to send to API
     */
    private function resourceData($type) {
        $rand = rand();
        switch($type) {
            case 'create':
                return new CreateResourceBody(
                    "name",
                    "Staff", // Hardcoded. Way to get from API or SDK in the future?
                    NULL, // capacity
                    "description",
                    NULL, // gender
                    NULL, // thing_type_id
                    NULL // user_id detauls to self
                );
            case 'update':
                return new UpdateResourceByIdBody(
                    NULL, // capacity
                    "description",
                    NULL, // gender
                    "name",
                    NULL // thing_type_id
                );
        }
    }

    /**
     * Generate data from Resource response.
     * @param  GonebusyLib\Models\EntitiesResourceResponse $response
     * @param  string $type Should be 'create' or 'update'.
     * @return  CreateResourceBody or UpdateResourceByIdBody object with data from $response
     */
    private function dataFromResponse($response, $type) {
        switch($type) {
            case 'create':
                return new CreateResourceBody(
                    $response->resource->name,
                    $response->resource->resourceType,
                    $response->resource->capacity,
                    $response->resource->description,
                    $response->resource->gender,
                    $response->resource->thingTypeId,
                    NULL // $response->resource->ownerId
                );
            case 'update':
                return new UpdateResourceByIdBody(
                    $response->resource->capacity,
                    $response->resource->description,
                    $response->resource->gender,
                    $response->resource->name,
                    $response->resource->thingTypeId
                );
        }
    }


    /**
     * Test POST /resources/new
     * GonebusyLib\Controllers\ResourceController::createResource()
     */
    public function testCreateResource() {
        $createResourceBody = $this->resourceData('create', $createResponse->user->id);
        // /* DEBUG */ print_r($createResourceBody);

        // Create GonebusyLib\Models\EntitiesResourceResponse:
        $response = $this->resources->createResource(Configuration::$authorization, $createResourceBody);
        // /* DEBUG */ print_r($response);

        // Was it created?
        $this->assertInstanceOf('GonebusyLib\Models\CreateResourceResponse', $response);

        // Does it have all the original data we sent?
        $responseBody = $this->dataFromResponse($response, 'create');
        // /* DEBUG */ print_r($responseBody);
        $this->assertEquals($responseBody, $createResourceBody);

        // Delete test resource:
        $delResponse = $this->resources->deleteResourceById(Configuration::$authorization, $response->resource->id);

        // Delete test user:
        // Can't delete users at the moment.
    }

    // /**
    //  * TODO Test GET /resources/{id}
    //  * GonebusyLib\Controllers\ResourcesController::getResourceById()
    //  */
    // public function testGetResourceById() {
    //     $result = $this->resources->getResourceById(
    //         Configuration::$authorization,
    //         5052498976
    //     );
    //     $data = json_decode(json_encode($result), true);
    //     $this->assertArrayHasKey('resource', $data);
    //     $keys = array(
    //         'capacity',
    //         'description',
    //         'gender',
    //         'id',
    //         'name',
    //         'owner_id',
    //         'resource_type',
    //         'thing_type_id'
    //     );
    //     foreach ($keys as $k) {
    //         $this->assertArrayHasKey($k, $data['resource']);
    //     }
    // }
    //
    // // /**
    // //  * TODO Test PUT /resources/{id}}
    // //  * GonebusyLib\Controllers\ResourceController::updateResourceById()
    // //  */
    // // public function testUpdateResourceById() {
    // //     //
    // // }
    //
    // /**
    //  * TODO Test GET /resources
    //  * GonebusyLib\Controllers\ResourcesController::getResources()
    //  */
    // public function testGetResources() {
    //     $result = $this->resources->getResources( Configuration::$authorization );
    //     $data = json_decode(json_encode($result), true);
    //     $keys = array(
    //         'capacity',
    //         'description',
    //         'gender',
    //         'id',
    //         'name',
    //         'owner_id',
    //         'resource_type',
    //         'thing_type_id'
    //     );
    //     foreach ($data['resources'] as $ck) {
    //         foreach ($keys as $k) {
    //                 $this->assertArrayHasKey($k, $ck);
    //         }
    //     }
    // }
    //
    // /**
    //  * TODO Test GET /resources/things
    //  * Test GonebusyLib\Controllers\ResourcesController::getResourceThings()
    //  */
    // public function testGetResourceThings() {
    //     $result = $this->resources->getResourceThings( Configuration::$authorization );
    //     $data = json_decode(json_encode($result), true);
    //     $this->assertArrayHasKey('things', $data);
    // }
    //
    // /**
    //  * TODO Test PUT /resources/{id}}
    //  * GonebusyLib\Controllers\ResourceController::deleteResourceById()
    //  */
    // public function testDeleteResourceById() {
    //     //
    // }
    //
    //
    // /**
    //  * XXX Tear down tests.
    //  */
    // public function tearDown() {
    //
    // }

}
