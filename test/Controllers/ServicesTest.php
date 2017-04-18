<?php
/*
 * Services SDK Controller Test Case
 */

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
     * Generate arbitrary service data.
     * @param  string $type Should be 'create' or 'update'.
     * @return  mixed object with unique data to send to API
     */
    private function serviceBody($type) {
        $rand = rand();
        switch($type) {
            case 'create':
                return new CreateServiceBody(
                    "description", // REQUIRED
                    15, // duration REQUIRED
                    15, // max_duration optional but will default to duration
                    "name", // REQUIRED
                    NULL, // categories default to empty list
                    NULL, // price_model_id
                    NULL, // resources defaults to list with self Resource
                    "short_name",
                    NULL // user_id defaults to self User
                );
            case 'update':
                return new UpdateServiceByIdBody(
                    NULL, // categories
                    "another description",
                    30, // duration
                    30, // max_duration
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
     * @return  mixed object with data from $response
     */
    private function bodyFromResponse($response, $type) {
        switch($type) {
            case 'create':
                return new CreateServiceBody(
                    $response->service->description,
                    $response->service->duration,
                    $response->service->maxDuration,
                    $response->service->name,
                    NULL, // $response->service->categories,
                    NULL, // $response->service->priceModelId,
                    NULL, // $response->service->resources,
                    $response->service->shortName,
                    NULL // $response->service->ownerId
                );
            case 'update':
                return new UpdateServiceByIdBody(
                    NULL, // $response->service->categories,
                    $response->service->description,
                    $response->service->duration,
                    $response->service->maxDuration,
                    $response->service->name,
                    NULL, // $response->service->priceModelId,
                    NULL, // $response->service->resources,
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
        // Create a Service:
        $createServiceBody = $this->serviceBody('create');
        $responseService = $this->services->createService(Configuration::$authorization, $createServiceBody);

        // Fetch same Service we just created:
        $response = $this->services->getServiceById(
            Configuration::$authorization,
            $responseService->service->id
        );

        // Was it fetched?
        $this->assertInstanceOf('GonebusyLib\Models\GetServiceByIdResponse', $response);

        // Does it have all the original data we sent?
        $responseBody = $this->bodyFromResponse($response, 'create');
        $this->assertEquals($responseBody, $createServiceBody);

        // Delete test service:
        $delResponse = $this->services->deleteServiceById(Configuration::$authorization, $responseService->service->id);
    }

    /**
     * Test PUT /rervices/{id}
     * GonebusyLib\Controllers\ServicesController::updateServiceById()
     */
    public function testUpdateServiceById() {
        $createServiceBody = $this->serviceBody('create');
        $createResponse = $this->services->createService(Configuration::$authorization, $createServiceBody);

        // Update the same user:
        $anotherServiceBody = $this->serviceBody('update');
        $response = $this->services->updateServiceById(
            Configuration::$authorization,
            $createResponse->service->id,
            $anotherServiceBody);

        // Was it updated?
        $this->assertInstanceOf('GonebusyLib\Models\UpdateServiceByIdResponse', $response);

        // Does it have all the new data we sent?
        $responseBody = $this->bodyFromResponse($response, 'update');
        $this->assertEquals($responseBody, $anotherServiceBody);

        // Delete test service:
        $delResponse = $this->services->deleteServiceById(Configuration::$authorization, $createResponse->service->id);
    }

    /**
     * Test GET /services
     * Assumes there's at least 3 Services in the API's database.
     * GonebusyLib\Controllers\ServicesController::getServices()
     */
    public function testGetServices() {
        $perPage = 3;
        $response = $this->services->getServices(
            Configuration::$authorization,
            $page = 1,
            $perPage);

        // Was it fetched?
        $this->assertInstanceOf('GonebusyLib\Models\GetServicesResponse', $response);

        // Did it return an array of 3 services?
        $this->assertCount($perPage, $response->services);
        foreach($response->services as $service) {
            $this->assertInstanceOf('GonebusyLib\Models\GetServicesResponse', $response);
        }
    }

    /**
     * Test GET /services/{id}/available_slots
     * GonebusyLib\Controllers\ServicesController::getServices()
     */
    public function testGetServiceAvailableSlotsById() {
        $createServiceBody = $this->serviceBody('create');
        $responseService = $this->services->createService(Configuration::$authorization, $createServiceBody);

        $date = date('Y-m-d'); // Now
        $response = $this->services->getServiceAvailableSlotsById(
            Configuration::$authorization,
            $responseService->service->id,
            $date//,
            // $endDate,
            // $startDate
        );

        // Was it fetched?
        $this->assertInstanceOf('GonebusyLib\Models\GetServiceAvailableSlotsByIdResponse', $response);

        // Delete test service:
        $delResponse = $this->services->deleteServiceById(Configuration::$authorization, $responseService->service->id);
    }

    /**
     * Test DELETE /services/{id}
     * GonebusyLib\Controllers\ServicesController::deleteServiceById()
     */
    public function testDeleteServiceById() {
        $createServiceBody = $this->serviceBody('create');
        $responseService = $this->services->createService(Configuration::$authorization, $createServiceBody);

        $response = $this->services->deleteServiceById(Configuration::$authorization, $responseService->service->id);

        // Was it deleted?
        $this->assertInstanceOf('GonebusyLib\Models\DeleteServiceByIdResponse', $response);

        $responseBody = $this->bodyFromResponse($response, 'create');
        $this->assertEquals($responseBody, $createServiceBody);
        // The record previously created is the same as the one deleted.
    }

}
