<?php
/*
 * Schedule SDK Controller Test Case
 */

use PHPUnit\Framework\TestCase;

use GonebusyLib\Configuration;
use GonebusyLib\GonebusyClient;
use GonebusyLib\Models\CreateServiceBody;
use GonebusyLib\Models\CreateResourceBody;
use GonebusyLib\Models\CreateScheduleBody;
use GonebusyLib\Models\UpdateScheduleByIdBody;
use GonebusyLib\Models\CreateScheduleTimeWindowBody;
use GonebusyLib\Models\UpdateScheduleTimeWindowByIdBody;

class SchedulesTest extends TestCase
{
    /**
     * To contain the GonebusyLib\GonebusyClient
     */
    protected $client;

    /**
     * To contain the GonebusyLib\Controllers\SchedulesController
     */
    protected $schedules;

    // To contain the GonebusyLib\Controllers\ServicesController
    private $services;

    // To contain the GonebusyLib\Controllers\ResourcesController
    private $resources;


    /**
     * Create the GonebusyClient and ScheduleController, etc for each test.
     */
    public function setUp() {
        $this->client = new GonebusyClient();
        $this->schedules = $this->client->getSchedules();

        $this->services = $this->client->getServices();
        $this->resources = $this->client->getResources();
    }


    /**
     * Generate arbitrary service or resource data.
     * @param  string $action 'Service' or 'Resource'
     * @return  mixed object for sending to API
     */
    private function createBody($action) {
        switch($action) {
            case 'Service':
                return new CreateServiceBody(
                    "description", // REQUIRED
                    15, // duration REQUIRED
                    "name", // REQUIRED
                    NULL, // categories
                    NULL, // price_model_id
                    NULL, // services defaults to self Service
                    "short_name",
                    NULL // user_id defaults to self User
                );
            case 'Resource':
                return new CreateResourceBody(
                    "name", // REQUIRED
                    "Staff", // type REQUIRED
                    NULL, // capacity
                    "description",
                    NULL, // gender
                    NULL, // thing_type_id
                    NULL // user_id detauls to self
                );
        }
    }

    /**
     * Generate arbitrary schedule data.
     * @param  int $serviceId for new schedule
     * @param  int $resourceId for new schedule
     * @return  CreateScheduleBody object for sending to API
     */
    private function scheduleBody($serviceId, $resourceId) {
        return new CreateScheduleBody(
            $serviceId, // REQUIRED
            NULL, // date_recurs_by
            "sunday, monday, tuesday, wednesday, thursday, friday, saturday", // days
            date('Y-m-d', strtotime('tomorrow')), // end_date XXX can be infinite
            "18:00", // end_time
            NULL, // frequency defaults to 'every'
            NULL, // occurrence defaults to 'every'
            "daily", // recurs_by
            $resourceId, // XXX should default to self?
            date('Y-m-d', strtotime('tomorrow')), // start_date
            "12:00", // start_time
            NULL, // total_minutes can be deduced
            NULL // user_id defaults to self
        );
    }

    /**
     * Generate arbitrary schedule data.
     * @param  string $action 'create' or 'update'
     * @return  mixed object with for sending to API
     */
    private function timeWindowBody($action) {
        switch($action) {
            case 'create':
                return new CreateScheduleTimeWindowBody(
                    "sunday, monday, tuesday, wednesday, thursday, friday, saturday", // days
                    "18:00", // end_time
                    "daily", // recurs_by
                    date('Y-m-d', strtotime('tomorrow')), // start_date
                    "12:00", // start_time
                    NULL, // date_recurs_by
                    date('Y-m-d', strtotime('tomorrow')), // end_date
                    NULL, // frequency defaults to 'every'
                    NULL, // occurrence defaults to 'every'
                    NULL // total_minutes
                );
            case 'update':
                return new UpdateScheduleTimeWindowByIdBody(
                    NULL, // date_recurs_by
                    strtolower(date('l', strtotime('today'))), // other days
                    date('Y-m-d', strtotime('today')), // another end_date
                    "19:00", // antoher end_time
                    'single', // frequency should default to 'every'
                    NULL, // occurrence should default to 'every'
                    "once", // recurs_by
                    date('Y-m-d', strtotime('today')), // another start_date
                    "13:00", // anther start_time
                    NULL // total_minutes
                );
        }
    }

    /**
     * Generate data from Schedule response.
     * @param  GonebusyLib\Models\EntitiesScheduleResponse $response
     * @param  string $type 'CreateSchedule', 'createSTW', or 'updateSTW' (ScheduleTimeWindow)
     * @return  mixed object with data from $response
     */
    private function bodyFromResponse($response, $type) {
        switch($type) {
            case 'CreateSchedule':
                return new CreateScheduleBody(
                    $response->schedule->serviceId,
                    NULL, // $response->schedule->dateRecursBy,
                    isset($response->schedule->timeWindows[0]) ?
                        join($response->schedule->timeWindows[0]->days, ', ')
                        : NULL
                    , // days
                    $response->schedule->timeWindows[0]->endDate,
                    $response->schedule->timeWindows[0]->endTime,
                    NULL, // $response->schedule->timeWindows[0]->frequency,
                    NULL, // $response->schedule->timeWindows[0]->occurrence,
                    $response->schedule->timeWindows[0]->recursBy,
                    $response->schedule->resourceId,
                    $response->schedule->timeWindows[0]->startDate,
                    $response->schedule->timeWindows[0]->startTime,
                    NULL, // $response->schedule->timeWindows[0]->totalMinutes,
                    NULL // $response->schedule->ownerId
                );
            case 'createSTW':
                return new CreateScheduleTimeWindowBody(
                    join($response->schedule->timeWindows[1]->days, ', '),
                    $response->schedule->timeWindows[1]->endTime,
                    $response->schedule->timeWindows[1]->recursBy,
                    $response->schedule->timeWindows[1]->startDate,
                    $response->schedule->timeWindows[1]->startTime,
                    $response->schedule->timeWindows[1]->dateRecursBy ?
                        $response->schedule->timeWindows[1]->dateRecursBy
                        : NULL
                    ,
                    $response->schedule->timeWindows[1]->endDate,
                    NULL, // $response->schedule->timeWindows[1]->frequency,
                    NULL, // $response->schedule->timeWindows[1]->occurrence,
                    NULL // $response->schedule->timeWindows[1]->totalMinutes
                );
            case 'updateSTW':
                return new UpdateScheduleTimeWindowByIdBody(
                    $response->schedule->timeWindows[1]->dateRecursBy ?
                        $response->schedule->timeWindows[1]->dateRecursBy
                        : NULL
                    ,
                    join($response->schedule->timeWindows[1]->days, ', '),
                    $response->schedule->timeWindows[1]->endDate,
                    $response->schedule->timeWindows[1]->endTime,
                    $response->schedule->timeWindows[1]->frequency,
                    NULL, // $response->schedule->timeWindows[1]->occurrence,
                    $response->schedule->timeWindows[1]->recursBy,
                    $response->schedule->timeWindows[1]->startDate,
                    $response->schedule->timeWindows[1]->startTime,
                    NULL // $response->schedule->timeWindows[1]->totalMinutes
                );
        }
    }


    /*
     * Schedules
     */

    /**
     * Test POST /schedules/new
     * GonebusyLib\Controllers\SchedulesController::createSchedule()
     */
    public function testCreateSchedule() {
        // Create Service:
        $createServiceBody = $this->createBody('Service');
        $serviceResponse = $this->services->createService(Configuration::$authorization, $createServiceBody);
        // Create Resource:
        $createResourceBody = $this->createBody('Resource');
        $resourceResponse = $this->resources->createResource(Configuration::$authorization, $createResourceBody);

        // Create Schedule:
        $createScheduleBody = $this->scheduleBody(
            $serviceResponse->service->id,
            $resourceResponse->resource->id);
        $response = $this->schedules->createSchedule(Configuration::$authorization, $createScheduleBody);

        // Was it created?
        $this->assertInstanceOf('GonebusyLib\Models\CreateScheduleResponse', $response);
        // $response->schedule is a GonebusyLib\Models\EntitiesScheduleResponse

        // Does it have all the original data sent?
        $responseBody = $this->bodyFromResponse($response, 'CreateSchedule');
        $this->assertEquals($createScheduleBody, $responseBody);

        // Delete test schedule:
        $delResponse = $this->schedules->deleteScheduleById(Configuration::$authorization, $response->schedule->id);
        // Delete test resource:
        $delResponseResource = $this->resources->deleteResourceById(Configuration::$authorization, $resourceResponse->resource->id);
        // Delete test service:
        $delResponseService = $this->services->deleteServiceById(Configuration::$authorization, $serviceResponse->service->id);
    }

    /**
     * Test GET /schedules/{id}
     * GonebusyLib\Controllers\SchedulesController::getScheduleById()
     */
    public function testGetScheduleById() {
        $serviceResponse = $this->services->createService(Configuration::$authorization, $this->createBody('Service'));
        $resourceResponse = $this->resources->createResource(Configuration::$authorization, $this->createBody('Resource'));
        // Create Schedule:
        $createScheduleBody = $this->scheduleBody($serviceResponse->service->id, $resourceResponse->resource->id);
        $responseSchedule = $this->schedules->createSchedule(Configuration::$authorization, $createScheduleBody);

        // Fetch same Schedule we just created:
        $response = $this->schedules->getScheduleById(
            Configuration::$authorization,
            $responseSchedule->schedule->id
        );

        // Was it fetched?
        $this->assertInstanceOf('GonebusyLib\Models\GetScheduleByIdResponse', $response);

        // Does it have all the original data we sent?
        $responseBody = $this->bodyFromResponse($response, 'CreateSchedule');
        $this->assertEquals($responseBody, $createScheduleBody);

        // Delete test entities:
        $delResponse = $this->schedules->deleteScheduleById(Configuration::$authorization, $response->schedule->id);
        $delResponseResource = $this->resources->deleteResourceById(Configuration::$authorization, $resourceResponse->resource->id);
        $delResponseService = $this->services->deleteServiceById(Configuration::$authorization, $serviceResponse->service->id);
    }

    /**
     * Test GET /schedules
     * Assumes there's at least 3 Schedules in the API's database.
     * GonebusyLib\Controllers\SchedulesController::getSchedules()
     */
    public function testGetSchedules() {
        $perPage = 3;
        $response = $this->schedules->getSchedules(
            Configuration::$authorization,
            $page = 1,
            $perPage);

        // Was it fetched?
        $this->assertInstanceOf('GonebusyLib\Models\GetSchedulesResponse', $response);

        // Did it return an array of 3 schedules?
        $this->assertCount($perPage, $response->schedules);
        foreach($response->schedules as $schedule) {
            $this->assertInstanceOf('GonebusyLib\Models\GetSchedulesResponse', $response);
        }
    }

    /**
     * Test DELETE /schedules/{id}
     * GonebusyLib\Controllers\SchedulesController::deleteScheduleById()
     */
    public function testDeleteScheduleById() {
        $serviceResponse = $this->services->createService(Configuration::$authorization, $this->createBody('Service'));
        $resourceResponse = $this->resources->createResource(Configuration::$authorization, $this->createBody('Resource'));
        // Create Schedule:
        $createScheduleBody = $this->scheduleBody($serviceResponse->service->id, $resourceResponse->resource->id);
        $responseSchedule = $this->schedules->createSchedule(Configuration::$authorization, $createScheduleBody);

        // Delete Schedule:
        $response = $this->schedules->deleteScheduleById(Configuration::$authorization, $responseSchedule->schedule->id);
        // XXX Returns a limited set compared to create and update

        // Was it deleted?
        $this->assertInstanceOf('GonebusyLib\Models\DeleteScheduleByIdResponse', $response);

        // Does the deleted record seem to = the one previously created?
        $this->assertEquals($response->schedule->id, $responseSchedule->schedule->id);
        $this->assertEquals($response->schedule->resourceId, $responseSchedule->schedule->resourceId);
        $this->assertEquals($response->schedule->serviceId, $responseSchedule->schedule->serviceId);

        // Delete remaining test entities:
        $delResponseResource = $this->resources->deleteResourceById(Configuration::$authorization, $resourceResponse->resource->id);
        $delResponseService = $this->services->deleteServiceById(Configuration::$authorization, $serviceResponse->service->id);
    }


    /*
     * Time windows
     */

    /**
     * Test POST /schedules/{id}/time_windows/new
     * GonebusyLib\Controllers\SchedulesController::createScheduleTimeWindow()
     */
    public function testCreateScheduleTimeWindow() {
        $serviceResponse = $this->services->createService(Configuration::$authorization, $this->createBody('Service'));
        $resourceResponse = $this->resources->createResource(Configuration::$authorization, $this->createBody('Resource'));
        // Create Schedule:
        $createScheduleBody = $this->scheduleBody($serviceResponse->service->id, $resourceResponse->resource->id);
        $responseSchedule = $this->schedules->createSchedule(Configuration::$authorization, $createScheduleBody);


        // Create ScheduleTimeWindow:
        $createSTWBody = $this->timeWindowBody('create');
        $response = $this->schedules->createScheduleTimeWindow(
            Configuration::$authorization,
            $responseSchedule->schedule->id,
            $createSTWBody
        );

        // Was it created?
        $this->assertInstanceOf('GonebusyLib\Models\CreateScheduleTimeWindowResponse', $response);
        // $response->schedule is a GonebusyLib\Models\EntitiesScheduleResponse

        // Does it have all the original data we sent?
        $responseBody = $this->bodyFromResponse($response, 'createSTW');
        $this->assertEquals($responseBody, $createSTWBody);


        // Delete test entities:
        $delResponse = $this->schedules->deleteScheduleTimeWindowById(Configuration::$authorization, $responseSchedule->schedule->id, $response->schedule->timeWindows[1]->id);
        $delScheduleResponse = $this->schedules->deleteScheduleById(Configuration::$authorization, $responseSchedule->schedule->id);
        $delResponseResource = $this->resources->deleteResourceById(Configuration::$authorization, $resourceResponse->resource->id);
        $delResponseService = $this->services->deleteServiceById(Configuration::$authorization, $serviceResponse->service->id);
    }

    /**
     * Test PUT /schedules/{id}/time_windows/{time_window_id}
     * GonebusyLib\Controllers\SchedulesController::updateScheduleTimeWindowById()
     */
    public function testUpdateScheduleTimeWindowById() {
        $serviceResponse = $this->services->createService(Configuration::$authorization, $this->createBody('Service'));
        $resourceResponse = $this->resources->createResource(Configuration::$authorization, $this->createBody('Resource'));
        // Create Schedule:
        $createScheduleBody = $this->scheduleBody($serviceResponse->service->id, $resourceResponse->resource->id);
        $responseSchedule = $this->schedules->createSchedule(Configuration::$authorization, $createScheduleBody);

        // Create ScheduleTimeWindow:
        $createSTWBody = $this->timeWindowBody('create');
        $responseSTW = $this->schedules->createScheduleTimeWindow(Configuration::$authorization, $responseSchedule->schedule->id, $createSTWBody);


        // Update the same time window:
        $anotherSTWBody = $this->timeWindowBody('update');
        $response = $this->schedules->updateScheduleTimeWindowById(
            Configuration::$authorization,
            $responseSchedule->schedule->id,
            $responseSTW->schedule->timeWindows[1]->id,
            $anotherSTWBody);

        // Was it updated?
        $this->assertInstanceOf('GonebusyLib\Models\UpdateScheduleTimeWindowByIdResponse', $response);

        // Does it have all the original data we sent?
        $responseBody = $this->bodyFromResponse($response, 'updateSTW');
        $this->assertInstanceOf('GonebusyLib\Models\UpdateScheduleTimeWindowByIdBody', $responseBody);
        $this->assertEquals($anotherSTWBody, $responseBody);


        // Delete test entities:
        // $delResponse = $this->schedules->deleteScheduleTimeWindowById(Configuration::$authorization, $responseSchedule->schedule->id, $response->schedule->timeWindows[1]->id);
        $delScheduleResponse = $this->schedules->deleteScheduleById(Configuration::$authorization, $responseSchedule->schedule->id);
        $delResponseResource = $this->resources->deleteResourceById(Configuration::$authorization, $resourceResponse->resource->id);
        $delResponseService = $this->services->deleteServiceById(Configuration::$authorization, $serviceResponse->service->id);
    }

    /**
     * Test DELETE /schedules/{id}/time_windows/{time_window_id}
     * GonebusyLib\Controllers\SchedulesController::deleteScheduleTimeWindowById()
     */
    public function testDeleteScheduleTimeWindowById() {
        $serviceResponse = $this->services->createService(Configuration::$authorization, $this->createBody('Service'));
        $resourceResponse = $this->resources->createResource(Configuration::$authorization, $this->createBody('Resource'));
        // Create Schedule:
        $createScheduleBody = $this->scheduleBody($serviceResponse->service->id, $resourceResponse->resource->id);
        $responseSchedule = $this->schedules->createSchedule(Configuration::$authorization, $createScheduleBody);

        // Create ScheduleTimeWindow:
        $createSTWBody = $this->timeWindowBody('create');
        $responseSTW = $this->schedules->createScheduleTimeWindow(Configuration::$authorization, $responseSchedule->schedule->id, $createSTWBody);


        // Delete ScheduleTimeWindow:
        $response = $this->schedules->deleteScheduleTimeWindowById(
            Configuration::$authorization,
            $responseSchedule->schedule->id,
            $responseSTW->schedule->timeWindows[1]->id);

        // Was it deleted?
        $this->assertInstanceOf('GonebusyLib\Models\DeleteScheduleTimeWindowByIdResponse', $response);

        $response->schedule->timeWindows[1] = $response->schedule->timeWindows[0];
        // ^ XXX Hack for bodyFromResponse($response, 'createSTW')
        $responseBody = $this->bodyFromResponse($response, 'createSTW');
        $this->assertEquals($responseBody, $createSTWBody);
        // The record previously created is the same as the one deleted.


        // Delete remaining test entities:
        $delScheduleResponse = $this->schedules->deleteScheduleById(Configuration::$authorization, $responseSchedule->schedule->id);
        $delResponseResource = $this->resources->deleteResourceById(Configuration::$authorization, $resourceResponse->resource->id);
        $delResponseService = $this->services->deleteServiceById(Configuration::$authorization, $serviceResponse->service->id);
    }

}
