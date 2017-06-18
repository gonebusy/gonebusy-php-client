<?php
/*
 * Bookings SDK Controller Test Case
 */

namespace GonebusyLib\Tests;

use PHPUnit\Framework\TestCase;

use GonebusyLib\Configuration;
use GonebusyLib\GonebusyClient;
use GonebusyLib\Models\CreateServiceBody;
use GonebusyLib\Models\CreateResourceBody;
use GonebusyLib\Models\CreateScheduleBody;
use GonebusyLib\Models\CreateBookingBody;

use GonebusyLib\Models\UpdateBookingByIdBody;

class BookingsTest extends TestCase
{
    /** To contain the GonebusyLib\GonebusyClient
     */
    protected $client;

    /** To contain the GonebusyLib\Controllers\BookingsController
     */
    protected $bookings;

    /** To contain a GonebusyLib\Controllers\ServicesController
     */
    protected $services;

    /** To contain a GonebusyLib\Controllers\ResourcesController
     */
    private $resources;

    /** To contain a GonebusyLib\Controllers\SchedulesController
     */
    private $schedules;


    /**
     * Create the GonebusyClient and BookingsController,
     * as well as other controllers (for every test).
     */
    public function setUp() {
        $this->client = new GonebusyClient();
        $this->bookings = $this->client->getBookings();

        $this->services = $this->client->getServices();
        $this->resources = $this->client->getResources();
        $this->schedules = $this->client->getSchedules();
    }

    /**
     * Generate arbitrary service or resource data.
     * @param  string $type 'Service' or 'Resource'
     * @return  mixed object for sending to API
     */
    private function createBody($type) {
        switch($type) {
            case 'Service':
                return new CreateServiceBody(
                    "description", // REQUIRED
                    15, // duration REQUIRED
                    "name", // REQUIRED
                    NULL, // categories
                    30, // max_duration optional but will default to duration
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
            date('Y-m-d', strtotime('tomorrow')), // end_date
            "17:00", // end_time
            NULL, // frequency defaults to 'every'
            NULL, // occurrence defaults to 'every'
            "daily", // recurs_by
            $resourceId,
            date('Y-m-d', strtotime('tomorrow')), // start_date
            "09:00", // start_time
            NULL, // total_minutes can be deduced
            NULL // user_id defaults to self
        );
    }

    /**
     * Generate unique user data.
     * @param  string $action Should be 'create' or 'update'.
     * @param  int $serviceId for new booking
     * @param  int $resourceId for new booking
     * @return  mixed object with unique data to send to API
     */
    private function bookingBody($action, $sId=NULL, $rId=NULL) {
        switch($action) {
            case 'create':
                return new CreateBookingBody(
                    $sId, // service_id
                    date('Y-m-d', strtotime('tomorrow')), // date (within schedule start_date and end_date)
                    "13:00", // time (within schedule start_time and end_date)
                    8552697701, // sample user_id
                    $rId, // resource_id
                    30, // duration (>= service durations)
                    NULL, // end_date
                    NULL, // recurs_by
                    NULL, // frequency
                    strtolower(date('l', strtotime('tomorrow'))), // days
                    NULL, // occurrence
                    NULL, // date_recurs_by
                    "my booking", // name
                    "my description" // description
                );
            case 'update':
                return new CreateBookingBody(
                    $sId, // service_id
                    date('Y-m-d', strtotime('tomorrow')), // date (within schedule start_date and end_date)
                    "13:45", // another time (within schedule start_time and end_date)
                    8552697701, // sample user_id
                    $rId, // resource_id
                    15, // another duration (>= service durations)
                    NULL, // end_date
                    NULL, // recurs_by
                    NULL, // frequency
                    strtolower(date('l', strtotime('tomorrow'))), // days
                    NULL, // occurrence
                    NULL, // date_recurs_by
                    "another name", // name
                    "another description" // description
                );
        }
    }

    /**
     * Generate data from Booking response.
     * @param  GonebusyLib\Models\EntitiesBookingsResponse $response
     * @param  int $sId service ID (not in response)
     * @param  int $rId resource ID (not in response)
     * @return CreateBookingBody object with data from $response
     */
    private function bodyFromResponse($response, $sId, $rId) {
        return new CreateBookingBody(
            $response->booking->serviceId, // service
            $response->booking->timeWindow->startDate, // date
            $response->booking->timeWindow->startTime, // time
            $response->booking->ownerId, // booking owner is CreateBookingBody userId
            $response->booking->resourceId, // resource
            $response->booking->timeWindow->totalMinutes, // duration
            NULL, // end_date
            NULL, // recurs_by
            NULL, // frequency
            strtolower(date('l', strtotime($response->booking->timeWindow->startDate))), // days
            NULL, // occurrence
            NULL, // date_recurs_by
            $response->booking->name, // name
            $response->booking->description // description
        );
    }


    /**
     * Test POST /bookings/new
     * GonebusyLib\Controllers\UsersController::createBooking()
     */
    public function testCreateBooking() {
        $serviceResponse = $this->services->createService(Configuration::$authorization, $this->createBody('Service'));
        $resourceResponse = $this->resources->createResource(Configuration::$authorization, $this->createBody('Resource'));
        // Give open Schedule for seervice/resource combination:
        $createScheduleBody = $this->scheduleBody($serviceResponse->service->id, $resourceResponse->resource->id);
        $scheduleResponse = $this->schedules->createSchedule(Configuration::$authorization, $createScheduleBody);


        // Create Booking:
        $createBookingBody = $this->bookingBody('create', $serviceResponse->service->id, $resourceResponse->resource->id);
        $response = $this->bookings->createBooking(
            Configuration::$authorization,
            $createBookingBody
        );

        // Was it created?
        $this->assertInstanceOf('GonebusyLib\Models\CreateBookingResponse', $response);

        // Does it have all the original data we sent?
        $responseBody = $this->bodyFromResponse($response, $serviceResponse->service->id, $resourceResponse->resource->id);
        $this->assertEquals($createBookingBody, $responseBody);

        // // Delete test booking after a few seconds:
        // sleep(3); // (when the booking status is :awaiting_review)
        // $this->bookings->cancelBookingById(Configuration::$authorization, $response->booking->id);


        // Delete test schedule:
        $this->schedules->deleteScheduleById(Configuration::$authorization, $scheduleResponse->schedule->id);
        // Delete test resource:
        $this->resources->deleteResourceById(Configuration::$authorization, $resourceResponse->resource->id);
        // Delete test service:
        $this->services->deleteServiceById(Configuration::$authorization, $serviceResponse->service->id);
    }

    /**
     * Test PUT /bookings/{id}
     * GonebusyLib\Controllers\BookingsController::updateBookingById()
     */
    public function testUpdateBookingById() {
        $serviceResponse = $this->services->createService(Configuration::$authorization, $this->createBody('Service'));
        $resourceResponse = $this->resources->createResource(Configuration::$authorization, $this->createBody('Resource'));
        $createScheduleBody = $this->scheduleBody($serviceResponse->service->id, $resourceResponse->resource->id);
        $scheduleResponse = $this->schedules->createSchedule(Configuration::$authorization, $createScheduleBody);
        // Create Booking:
        $bookingResponse = $this->bookings->createBooking(
            Configuration::$authorization,
            $this->bookingBody('create', $serviceResponse->service->id, $resourceResponse->resource->id)
        );


        // Update Booking:
        $updateBookingBody = $this->bookingBody('update', $serviceResponse->service->id, $resourceResponse->resource->id);
        $response = $this->bookings->updateBookingById(
            Configuration::$authorization,
            $bookingResponse->booking->id,
            $updateBookingBody
        );

        // Was it updated?
        $this->assertInstanceOf('GonebusyLib\Models\UpdateBookingByIdResponse', $response);

        // Does it have all the new data we sent? XXX Skip for now. API doesn't update bookings yet.
        $responseBody = $this->bodyFromResponse($response, $serviceResponse->service->id, $resourceResponse->resource->id);
        // $this->assertEquals($updateBookingBody, $responseBody);

        // // Delete test booking after a few seconds:
        // sleep(3); // (when the booking status is :awaiting_review)
        // $this->bookings->cancelBookingById(Configuration::$authorization, $response->booking->id);


        // Delete test schedule:
        $this->schedules->deleteScheduleById(Configuration::$authorization, $scheduleResponse->schedule->id);
        // Delete test resource:
        $this->resources->deleteResourceById(Configuration::$authorization, $resourceResponse->resource->id);
        // Delete test service:
        $this->services->deleteServiceById(Configuration::$authorization, $serviceResponse->service->id);
    }

    /**
     * Test GET /bookings/{id}
     * GonebusyLib\Controllers\BookingsController::getBookingById()
     */
    public function testGetBookingById() {
        $serviceResponse = $this->services->createService(Configuration::$authorization, $this->createBody('Service'));
        $resourceResponse = $this->resources->createResource(Configuration::$authorization, $this->createBody('Resource'));
        $createScheduleBody = $this->scheduleBody($serviceResponse->service->id, $resourceResponse->resource->id);
        $scheduleResponse = $this->schedules->createSchedule(Configuration::$authorization, $createScheduleBody);
        // Create Booking:
        $createBookingBody = $this->bookingBody('create', $serviceResponse->service->id, $resourceResponse->resource->id);
        $bookingResponse = $this->bookings->createBooking(
            Configuration::$authorization,
            $createBookingBody
        );


        // Get back the Booking:
        $response = $bookingResponse = $this->bookings->getBookingById(
            Configuration::$authorization,
            $bookingResponse->booking->id
        );

        // Was it fetched?
        $this->assertInstanceOf('GonebusyLib\Models\GetBookingByIdResponse', $response);

        // Does it have all the original data we sent?
        $responseBody = $this->bodyFromResponse($response, $serviceResponse->service->id, $resourceResponse->resource->id);
        $this->assertEquals($createBookingBody, $responseBody);

        // // Delete test booking after a few seconds:
        // sleep(3); // (when the booking status is :awaiting_review)
        // $this->bookings->cancelBookingById(Configuration::$authorization, $response->booking->id);


        // Delete test schedule:
        $this->schedules->deleteScheduleById(Configuration::$authorization, $scheduleResponse->schedule->id);
        // Delete test resource:
        $this->resources->deleteResourceById(Configuration::$authorization, $resourceResponse->resource->id);
        // Delete test service:
        $this->services->deleteServiceById(Configuration::$authorization, $serviceResponse->service->id);
    }

    /**
     * Test DELETE /bookings/{id}
     * GonebusyLib\Controllers\BookingsController::cancelBookingById()
     */
    public function testCancelBookingById() {
        $serviceResponse = $this->services->createService(Configuration::$authorization, $this->createBody('Service'));
        $resourceResponse = $this->resources->createResource(Configuration::$authorization, $this->createBody('Resource'));
        $createScheduleBody = $this->scheduleBody($serviceResponse->service->id, $resourceResponse->resource->id);
        $scheduleResponse = $this->schedules->createSchedule(Configuration::$authorization, $createScheduleBody);
        // Create Booking:
        $createBookingBody = $this->bookingBody('create', $serviceResponse->service->id, $resourceResponse->resource->id);
        $bookingResponse = $this->bookings->createBooking(
            Configuration::$authorization,
            $createBookingBody
        );


        // Delete the booking after a few seconds:
        sleep(3); // (when the booking status is :awaiting_review)
        $response = $this->bookings->cancelBookingById(
            Configuration::$authorization,
            $bookingResponse->booking->id,
            NULL, // date to cancel, if recurring
            NULL, // endDate to cancel, if recurring
            NULL // which instance(s) to cancel, if recurring
        );

        // Was it cancelled?
        $this->assertInstanceOf('GonebusyLib\Models\CancelBookingByIdResponse', $response);
        $this->assertEquals($response->booking->workflowState, 'canceled');

        // Extra: Does the deleted record seem to = the one previously created?
        $responseBody = $this->bodyFromResponse($response, $serviceResponse->service->id, $resourceResponse->resource->id);
        $this->assertEquals($createBookingBody, $responseBody);


        // Delete test schedule:
        $this->schedules->deleteScheduleById(Configuration::$authorization, $scheduleResponse->schedule->id);
        // Delete test resource:
        $this->resources->deleteResourceById(Configuration::$authorization, $resourceResponse->resource->id);
        // Delete test service:
        $this->services->deleteServiceById(Configuration::$authorization, $serviceResponse->service->id);
    }

    /**
     * Test GET /bookings
     * GonebusyLib\Controllers\BookingsController::getBookings()
     */
    public function testGetBookings() {
        $perPage = 3;
        $response = $this->bookings->getBookings(
            Configuration::$authorization,
            NULL, // userId to filter by, if desired
            NULL, // booking states to filter by, if desired
            NULL, // bookerId to filter by, if desired
            $page = 1,
            $perPage);

        // Was it fetched?
        $this->assertInstanceOf('GonebusyLib\Models\GetBookingsResponse', $response);

        // Did it return an array of 3 schedules?
        $this->assertCount($perPage, $response->bookings);
        foreach($response->bookings as $booking) {
            $this->assertInstanceOf('GonebusyLib\Models\EntitiesBookingResponse', $booking);
        }
    }

}
