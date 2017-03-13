<?php
/*
 * Resources SDK Controller Test Case
 */

namespace GonebusyTest\Controllers;

use PHPUnit\Framework\TestCase;

use GonebusyLib\Configuration;
use GonebusyLib\GonebusyClient;
use GonebusyLib\Models\CreateServiceBody;
use GonebusyLib\Models\UpdateServiceByIdBody;

class ServicesTest extends TestCase
{
    /**
     * To contain the GonebusyLib\GonebusyClient
     */
    protected $client;

    /**
     * To contain the GonebusyLib\Controllers\ServicesController
     */
    protected $services;

    /**
     * Create the GoneBusy SDK client for each test.
     */
    public function setUp() {
        $this->client = new GonebusyClient();
        $this->services = $this->client->getServices();
    }


    /**
     * Returns arbitrary service data.
     * @param  string $type Should be 'create' or 'update'.
     * @return  CreateServiceBody or UpdateServiceByIdBody object with unique data to send to API
     */
    private function serviceBody($type) {
        $rand = rand();
        switch($type) {
            case 'create':
                return new CreateServiceBody(
                    "description", // REQUIRED
                    15, // duration REQUIRED XXX 0 not accepted but NULL turns into 0
                    "name", // REQUIRED
                    NULL, // categories
                    NULL, // price_model_id XXX defaults to 28
                    NULL, // resources defaults to self Resource
                    "short_name",
                    NULL // user_id defaults to self User
                );
            case 'update':
                return new UpdateServiceByIdBody(
                    NULL, // categories
                    "another description",
                    30, // duration
                    "another name",
                    NULL, // price_model_id
                    NULL, // resources
                    "another short_name"
                );
        }
    }

    /**
     * Generate data from Service response.
     * @param  GonebusyLib\Models\EntitiesServiceResponse $response
     * @param  string $type Should be 'create' or 'update'.
     * @return  CreateServiceBody or UpdateServiceByIdBody object with data from $response
     */
    private function bodyFromResponse($response, $type) {
        switch($type) {
            case 'create':
                return new CreateServiceBody(
                    $response->service->description,
                    $response->service->duration,
                    $response->service->name,
                    NULL, // $response->service->categories,
                    NULL, // $response->service->priceModelId,
                    NULL, // $response->service->resources,
                    $response->service->shortName,
                    NULL // $response->service->userId
                );
            case 'update':
                return new UpdateServiceByIdBody(
                    $response->service->categories,
                    $response->service->description,
                    $response->service->duration,
                    $response->service->name,
                    $response->service->priceModelId,
                    $response->service->resources,
                    $response->service->shortName
                );
        }
    }


    /**
     * Test POST /services/new
     * GonebusyLib\Controllers\ServicesController::createService()
     */
    public function testCreateService() {
        $createServiceBody = $this->serviceBody('create');

        // Create GonebusyLib\Models\EntitiesServiceResponse:
        $response = $this->services->createService(Configuration::$authorization, $createServiceBody);

        // Was it created?
        $this->assertInstanceOf('GonebusyLib\Models\CreateServiceResponse', $response);

        // Does it have all the original data we sent?
        $responseBody = $this->bodyFromResponse($response, 'create');
        $this->assertEquals($responseBody, $createServiceBody);

        // Delete test service:
        $delResponse = $this->services->deleteServiceById(Configuration::$authorization, $response->service->id);
    }

    /**
     * Test GET /services/{id}
     * GonebusyLib\Controllers\ServicesController::getServiceById()
     */
    public function testGetServiceById() {
        $createServiceBody = $this->serviceBody('create');

        // Create GonebusyLib\Models\EntitiesServiceResponse:
        $responseService = $this->services->createService(Configuration::$authorization, $createServiceBody);

        $response = $this->services->getServiceById(
            Configuration::$authorization,
            $responseService->service->id
        );

        // Was it created?
        $this->assertInstanceOf('GonebusyLib\Models\GetServiceByIdResponse', $response);

         // Does it have all the original data we sent?
        $responseBody = $this->bodyFromResponse($response, 'create');
        $this->assertEquals($responseBody, $createServiceBody);

        // Delete test service:
        $delResponse = $this->services->deleteServiceById(Configuration::$authorization, $responseService->service->id);
    }

    // /**
    //  * @todo
    //  */
    // public function testUpdateServiceById() {
    //     //
    // }
    //
    // /**
    //  * @todo
    //  */
    // public function testGetServiceAvailableSlotsById() {
    //     //
    // }
    //
    // /**
    //  * @todo
    //  */
    // public function testGetServices() {
    //     //
    // }
    //
    // /**
    //  * @todo
    //  */
    // public function testDeleteServiceById() {
    //     //
    // }

}
