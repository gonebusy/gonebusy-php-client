<?php
use PHPUnit\Framework\TestCase;
use GonebusyLib\GonebusyClient;

class BookingsTest extends TestCase
{
    private $authorization;
    /**
     * To contain the GonebusyLib\GonebusyClient
     */
    protected $client;

    /**
     * To contain the GonebusyLib\Controllers\UsersController
     */
    protected $bookings;


    /**
     * Create the GoneBusy SDK client for each test.
     */
    public function setUp() {
        // TODO Use mock objects instead
        // (which will use and intercept SDK HTTP requests, returning fixture files)
        $this->authorization = "Token ac98ed08b5b0a9e7c43a233aeba841ce"; //
        $this->client = new GonebusyClient($this->authorization);
        $this->bookings = $this->client->getBookings();
    }


    /**
     * Test GonebusyLib\Controllers\BookingsController::getBookings()
     * @todo assertions
     */
    public function testGetBookings() {

        $collect['page'] = 1;
        $collect['perPage'] = 10;
        // $collect['states'] = 'states';
        $collect['user_id'] = '172';
        $collect['authorization'] = $this->authorization;
        $result = $this->bookings->getBookings($collect);
        // var_dump($result);

        // $data = json_decode( json_encode( $result ), true );
    }

}
