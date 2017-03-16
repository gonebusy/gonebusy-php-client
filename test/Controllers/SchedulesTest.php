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
     * Create the GonebusyClient and ScheduleController for each test.
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
     * @return  CreateServiceBody or CreateResourceBody object for sending to API
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
                    "name",
                    "Staff",
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
     * @param  int $service_id for new schedule
     * @param  int $resource_id for new schedule
     * @return  CreateScheduleBody object for sending to API
     */
    private function scheduleBody($service_id, $resource_id) {
        return new CreateScheduleBody(
            $service_id, // REQUIRED
            NULL, // date_recurs_by
            "sunday, monday, tuesday, wednesday, thursday, friday, saturday", // days
            date('Y-m-d', strtotime('tomorrow')), // end_date XXX can be infinite
            "18:00", // end_time
            NULL, // frequency defaults to 'every'
            NULL, // occurrence defaults to 'every'
            "daily", // recurs_by
            $resource_id, // XXX should default to self?
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
                    "sunday", // days
                    "09:30", // end_time
                    "once", // recurs_by
                    "2017-03-12", // start_date
                    "09:00", // start_time
                    NULL, // date_recurs_by
                    NULL, // end_date
                    "single", // frequency
                    NULL, // occurrence
                    NULL // total_minutes
                );
            case 'update':
                return new UpdateScheduleTimeWindowByIdBody(
                    NULL, // date_recurs_by
                    "sunday", // days
                    NULL, // end_date
                    "09:30", // end_time
                    "single", // frequency
                    NULL, // occurrence
                    "once", // recurs_by
                    "2017-03-12", // start_date
                    "09:00", // start_time
                    NULL // total_minutes
                );
        }
    }

    /**
     * Generate data from Schedule response.
     * @param  GonebusyLib\Models\EntitiesScheduleResponse $response
     * @param  string $type 'Schedule', 'create', or 'update' (ScheduleTimeWindow)
     * @return  mixed object with data from $response
     */
    private function bodyFromResponse($response, $type) {
        switch($type) {
            case 'Schedule':
                return new CreateScheduleBody(
                    $response->schedule->serviceId,
                    NULL, // $response->schedule->dateRecursBy,
                    "sunday, monday, tuesday, wednesday, thursday, friday, saturday", // days,
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
            case 'create':
                return new CreateScheduleTimeWindowBody(
                    $response->schedule->days,
                    $response->schedule->endTime,
                    $response->schedule->recursBy,
                    $response->schedule->startDate,
                    $response->schedule->startTime,
                    $response->schedule->dateRecursBy,
                    $response->schedule->endDate,
                    $response->schedule->frequency,
                    $response->schedule->occurrence,
                    $response->schedule->totalMinutes
                );
            case 'update':
                return new UpdateScheduleTimeWindowByIdBody(
                    $response->schedule->dateRecursBy,
                    $response->schedule->days,
                    $response->schedule->endDate,
                    $response->schedule->endTime,
                    $response->schedule->frequency,
                    $response->schedule->occurrence,
                    $response->schedule->recursBy,
                    $response->schedule->startDate,
                    $response->schedule->startTime,
                    $response->schedule->totalMinutes
                );
        }
    }


    /**
     * Test POST /schedules/new
     * GonebusyLib\Controllers\SchedulesController::createSchedule()
     */
    public function testCreateSchedule() {
        // Create Service
        $createServiceBody = $this->createBody('Service');
        $serviceResponse = $this->services->createService(Configuration::$authorization, $createServiceBody);
        // Create Resource
        $createResourceBody = $this->createBody('Resource');
        $resourceResponse = $this->resources->createResource(Configuration::$authorization, $createResourceBody);

        // Create Schedule Body
        $createSheduleBody = $this->scheduleBody(
            $serviceResponse->service->id,
            $resourceResponse->resource->id);

        // Create GonebusyLib\Models\EntitiesScheduleResponse:
        $response = $this->schedules->createSchedule(Configuration::$authorization, $createSheduleBody);

        // Was it created?
        $this->assertInstanceOf('GonebusyLib\Models\CreateScheduleResponse', $response);

        // Does it have all the original data we sent?
        $responseBody = $this->bodyFromResponse($response, 'Schedule');
        $this->assertEquals($createSheduleBody, $responseBody);

        // Delete test schedule:
        $delResponse = $this->schedules->deleteScheduleById(Configuration::$authorization, $response->schedule->id);
        // Delete test resource:
        $delResponseResource = $this->resources->deleteResourceById(Configuration::$authorization, $resourceResponse->resource->id);
        // Delete test service:
        $delResponseService = $this->services->deleteServiceById(Configuration::$authorization, $serviceResponse->service->id);
    }

    /**
     * Test GET /schedules
     * GonebusyLib\Controllers\SchedulesController::getSchedules()
     */
    public function testGetSchedules() {
        //
    }

    /**
     * Test GonebusyLib\Controllers\SchedulesController::getScheduleById()
     */
    public function testGetScheduleById() {
        //
    }

    /**
     * @todo
     */
    public function testDeleteScheduleTimeWindowById() {
        //
    }

    /**
     * @todo
     */
    public function testCreateScheduleTimeWindow() {
        //
    }

    /**
     * @todo
     */
    public function testDeleteScheduleById() {
        //
    }

    /**
     * @todo
     */
    public function testUpdateScheduleTimeWindowById() {
        //
    }
}
