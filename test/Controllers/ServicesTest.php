<?php
/*
 * Services SDK Controller Test Case
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
                    NULL, // price_model_id XXX defaults to inexistent id
                    NULL, // services defaults to self Service
                    "short_name",
                    NULL // user_id defaults to self User
                );
            case 'update':
                return new UpdateServiceByIdBody(
                    NULL, // categories
                    "another description",
                    30, // duration
                    "another name",
                    NULL, // price_model_id XXX defaults to inexistent id
                    NULL, // services
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
                    NULL, // $response->service->services,
                    $response->service->shortName,
                    NULL // $response->service->userId
                );
            case 'update':
                return new UpdateServiceByIdBody(
                    NULL, // $response->service->categories,
                    $response->service->description,
                    $response->service->duration,
                    $response->service->name,
                    NULL, // $response->service->priceModelId,
                    NULL, // $response->service->services,
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

    /**
     * Test PUT /rervices/{id}
     * GonebusyLib\Controllers\ServicesController::updateServiceById()
     */
    public function testUpdateServiceById() {
        $createServiceBody = $this->serviceBody('create');
        $createResponse = $this->services->createService(Configuration::$authorization, $createServiceBody);

        $anotherServiceBody = $this->serviceBody('update');

        // Update the same user:
        $response = $this->services->updateServiceById(
            Configuration::$authorization,
            $createResponse->service->id,
            $anotherServiceBody);

        // Was it fetched?
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

    // /**
    //  * @param string $authorization A valid API key, in the format 'Token API_KEY'
    //  * @param string $id            TODO: type description here
    //  * @param string $date          (optional) Date to check for availability.  Either this field or a date range
    //  *                              employing start_date and end_date must be supplied.  If date is provided,
    //  *                              start_date/end_date are ignored.  Several formats are supported: '2014-10-31',
    //  *                              'October 31, 2014'.
    //  * @param string $endDate       (optional) End Date of a range to check for availability.  If supplied, date must
    //  *                              not be supplied and start_date must be supplied.  Several formats are supported:
    //  *                              '2014-10-31', 'October 31, 2014'.
    //  * @param string $startDate     (optional) Start Date of a range to check for availability.  If supplied, date must
    //  *                              not be supplied and end_date must be supplied.  Several formats are supported:
    //  *                              '2014-10-31', 'October 31, 2014'.
    //  */
    // public function testGetServiceAvailableSlotsById() {
    //     //
    // }

    /**
     * Test DELETE /services/{id}
     * GonebusyLib\Controllers\ServicesController::deleteServiceById()
     */
    public function testDeleteServiceById() {
        $createServiceBody = $this->serviceBody('create');
        $responseService = $this->services->createService(Configuration::$authorization, $createServiceBody);

        $response = $this->services->deleteServiceById(Configuration::$authorization, $responseService->service->id);

        // Was it fetched?
        $this->assertInstanceOf('GonebusyLib\Models\DeleteServiceByIdResponse', $response);

        // The record to be deleted is the same as the record that was deleted
        $responseBody = $this->bodyFromResponse($response, 'create');
        $this->assertEquals($responseBody, $createServiceBody);
    }

}
