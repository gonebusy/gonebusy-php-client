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
        $createResourceBody = $this->resourceData('create');

        // Create GonebusyLib\Models\EntitiesResourceResponse:
        $response = $this->resources->createResource(Configuration::$authorization, $createResourceBody);

        // Was it created?
        $this->assertInstanceOf('GonebusyLib\Models\CreateResourceResponse', $response);

        // Does it have all the original data we sent?
        $responseBody = $this->dataFromResponse($response, 'create');
        $this->assertEquals($responseBody, $createResourceBody);

        // Delete test resource:
        $delResponse = $this->resources->deleteResourceById(Configuration::$authorization, $response->resource->id);
    }

    /**
     * Test GET /resources/{id}
     * GonebusyLib\Controllers\ResourcesController::getResourceById()
     */
    public function testGetResourceById() {
        $createResourceBody = $this->resourceData('create');

        // Create GonebusyLib\Models\EntitiesResourceResponse:
        $responseResource = $this->resources->createResource(Configuration::$authorization, $createResourceBody);

        $response = $this->resources->getResourceById(
            Configuration::$authorization,
            $responseResource->resource->id
        );

        // Was it created?
        $this->assertInstanceOf('GonebusyLib\Models\GetResourceByIdResponse', $response);

         // Does it have all the original data we sent?
        $responseBody = $this->dataFromResponse($response, 'create');
        $this->assertEquals($responseBody, $createResourceBody);

        // Delete test resource:
        $delResponse = $this->resources->deleteResourceById(Configuration::$authorization, $responseResource->resource->id);
    }

    /**
     * Test PUT /resources/{id}}
     * GonebusyLib\Controllers\ResourceController::updateResourceById()
     */
    public function testUpdateResourceById() {
        $createResourceBody = $this->resourceData('create');
        $createResponse = $this->resources->createResource(Configuration::$authorization, $createResourceBody);

        $anotherResourceBody = $this->resourceData('update');

        // Update the same user:
        $response = $this->resources->updateResourceById(
            Configuration::$authorization,
            $createResponse->resource->id,
            $anotherResourceBody);

        // Was it fetched?
        $this->assertInstanceOf('GonebusyLib\Models\UpdateResourceByIdResponse', $response);

        // Does it have all the new data we sent?
        $responseBody = $this->dataFromResponse($response, 'update');
        $this->assertEquals($responseBody, $anotherResourceBody);
    }

    /**
     * Test GET /resources
     * Assumes there's at least 3 Resources in the API's database.
     * GonebusyLib\Controllers\ResourcesController::getResources()
     */
    public function testGetResources() {
        $perPage = 3;
        $response = $this->resources->getResources(
            Configuration::$authorization,
            $page = 1,
            $perPage);

        // Was it fetched?
        $this->assertInstanceOf('GonebusyLib\Models\GetResourcesResponse', $response);

        // Did it return an array of 3 resources?
        $this->assertCount($perPage, $response->resources); // Slightly hardcoded to assume $resources exists in $response.
        foreach($response->resources as $resource) {
            $this->assertInstanceOf('GonebusyLib\Models\GetResourcesResponse', $response);
        }
    }

    /**
     * Test GET /resources/things
     * XXX Assumes there's 0 Things in the API's database.
     * Test GonebusyLib\Controllers\ResourcesController::getResourceThings()
     */
    public function testGetResourceThings() {
        $perPage = 3;
        $response = $this->resources->getResourceThings(
            Configuration::$authorization,
            $page = 1,
            $perPage);

        // Was it fetched?
        $this->assertInstanceOf('GonebusyLib\Models\GetResourceThingsResponse', $response);

        // Did it return an array of 0 things?
        $perPage = 0;
        $this->assertCount($perPage, $response->things); // Slightly hardcoded to assume $things exists in $response.
        foreach($response->things as $thing) {
            $this->assertInstanceOf('GonebusyLib\Models\GetResourceThingsResponse', $response);
        }
    }

    /**
     * Test PUT /resources/{id}}
     * GonebusyLib\Controllers\ResourceController::deleteResourceById()
     */
    public function testDeleteResourceById() {
        $createResourceBody = $this->resourceData('create');
        $responseResource = $this->resources->createResource(Configuration::$authorization, $createResourceBody);

        $response = $this->resources->deleteResourceById(Configuration::$authorization, $responseResource->resource->id);

        // Was it fetched?
        $this->assertInstanceOf('GonebusyLib\Models\DeleteResourceByIdResponse', $response);

        // The record to be deleted is the same as the record that was deleted
        $responseBody = $this->dataFromResponse($response, 'create');
        $this->assertEquals($responseBody, $createResourceBody);
    }

}
