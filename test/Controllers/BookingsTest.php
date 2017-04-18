<?php
/*
 * Bookings SDK Controller Test Case
 */

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
                    15, // max_duration optional but will default to duration
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
    private function bookingBody($action, $serviceId=NULL, $resourceId=NULL) {
        switch($action) {
            case 'create':
                return new CreateBookingBody(
                    date('Y-m-d', strtotime('tomorrow')), // date (within schedule start_date and end_date)
                    $serviceId, // service_id
                    "13:00", // time (within schedule start_time and end_date)
                    30, // duration (>= service durations)
                    $resourceId, // resource_id
                    NULL // user_id defaults to self
                );
            case 'update':
                return new CreateBookingBody(
                    date('Y-m-d', strtotime('tomorrow')), // date (within schedule start_date and end_date)
                    $serviceId, // service_id
                    "13:45", // another time (within schedule start_time and end_date)
                    15, // another duration (>= service durations)
                    $resourceId, // resource_id
                    NULL // user_id defaults to self
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
            $response->booking->timeWindow->startDate, // date
            $sId, // service_id
            $response->booking->timeWindow->startTime, // time
            $response->booking->timeWindow->totalMinutes, // duration
            $rId, // resource_id
            NULL // user_id defaults to self
        );
    }


    /**
     * Test POST /bookings/new
     * GonebusyLib\Controllers\UsersController::createBooking()
     */
    public function testCreateBooking() {
        // echo("\n");
        // Create Service:
        $createServiceBody = $this->createBody('Service');
        $serviceResponse = $this->services->createService(Configuration::$authorization, $createServiceBody);
        // Create Resource:
        $createResourceBody = $this->createBody('Resource');
        $resourceResponse = $this->resources->createResource(Configuration::$authorization, $createResourceBody);
        // Give open Schedule for seervice/resource combination:
        $createScheduleBody = $this->scheduleBody($serviceResponse->service->id, $resourceResponse->resource->id);
        $scheduleResponse = $this->schedules->createSchedule(Configuration::$authorization, $createScheduleBody);
        // echo("Created a Schedule with this Time Window: "); print_r($scheduleResponse->schedule->timeWindows[0]);


        // Create Booking:
        $createBookingBody = $this->bookingBody('create', $serviceResponse->service->id, $resourceResponse->resource->id);
        $response = $this->bookings->createBooking(
            Configuration::$authorization,
            $createBookingBody
        );
        // echo("Created a Booking: "); print_r($response);

        // Was it created?
        $this->assertInstanceOf('GonebusyLib\Models\CreateBookingResponse', $response);

        // Does it have all the original data we sent?
        $responseBody = $this->bodyFromResponse($response, $serviceResponse->service->id, $resourceResponse->resource->id);
        $this->assertEquals($responseBody, $createBookingBody);

        // XXX Delete test booking:
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
     * GonebusyLib\Controllers\BookingsController::getBookingById()
     */
    public function testUpdateBookingById() {
        //  * @param string $authorization A valid API key, in the format 'Token API_KEY'
        //  * @param string $id            TODO: type description here
        //  * @return mixed response from the API call
        //  * @throws APIException Thrown if API call fails
        // public function updateBookingById(
        //     $authorization,
        //     $id
    }

    /**
     * Test GET /bookings/{id}
     * GonebusyLib\Controllers\BookingsController::getBookingById()
     */
    public function testGetBookingById() {
        //  * @param string $authorization A valid API key, in the format 'Token API_KEY'
        //  * @param string $id            TODO: type description here
        //  * @return mixed response from the API call
        //  * @throws APIException Thrown if API call fails
        // public function getBookingById(
        //     $authorization,
        //     $id
    }

    /**
     * Test DELETE /bookings/{id}
     * GonebusyLib\Controllers\BookingsController::getBookingById()
     */
    public function testCancelBookingById() {
        //  * @param string $authorization A valid API key, in the format 'Token API_KEY'
        //  * @param string $id            TODO: type description here
        //  * @return mixed response from the API call
        //  * @throws APIException Thrown if API call fails
        // public function cancelBookingById(
        //     $authorization,
        //     $id
    }

    /**
     * Test GET /bookings
     * GonebusyLib\Controllers\BookingsController::getBookings()
     */
    public function testGetBookings() {
        //  * @param string  $authorization A valid API key, in the format 'Token API_KEY'
        //  * @param integer $page          (optional) Page offset to fetch.
        //  * @param integer $perPage       (optional) Number of results to return per page.
        //  * @param string  $states        (optional) Comma-separated list of Booking states to retrieve only Bookings in
        //  *                               those states.  Leave blank to retrieve all Bookings.
        //  * @param integer $userId        (optional) Retrieve Bookings owned only by this User Id.  You must be authorized
        // public function getBookings(
        //     $authorization,
        //     $page = 1,
        //     $perPage = 10,
        //     $states = null,
        //     $userId = null
    }

}
