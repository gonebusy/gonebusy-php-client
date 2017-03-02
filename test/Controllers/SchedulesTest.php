<?php
use PHPUnit\Framework\TestCase;
use GonebusyLib\GonebusyClient;

class SchedulesTest extends TestCase
{
    private $authorization;
    /**
     * To contain the GonebusyLib\GonebusyClient
     */
    protected $client;

    /**
     * TODO doc
     */
    protected $schedules;

    /**
     * Create the GoneBusy SDK client for each test.
     */
    public function setUp() {
        // TODO Use mock objects instead
        // (which will use and intercept SDK HTTP requests, returning fixture files)
        $this->authorization = "Token ac98ed08b5b0a9e7c43a233aeba841ce"; //
        $this->client = new GonebusyClient($this->authorization);
        $this->schedules = $this->client->getSchedules();
    }

    /**
     * Test GonebusyLib\Controllers\SchedulesController::getSchedules()
     */
    public function testGetSchedules() {
        $collect['page'] = 1;
        $collect['perPage'] = 10;
        $collect['user_id'] = 130;
        $collect['authorization'] = $this->authorization;
        $result = $this->schedules->getSchedules($collect);
        $data = json_decode(json_encode($result), true);
        $keys = array('id',
                      'owner_id',
                      'resource_id',
                      'service_id',
                      'time_windows',);
        foreach ($data['schedules'] as $ck) {
            foreach ($keys as $k) {
                    $this->assertArrayHasKey($k, $ck);
            }
        }
    }

    /**
     * Test GonebusyLib\Controllers\SchedulesController::getScheduleById()
     */
    public function testGetScheduleById() {
        $collect['id'] = 9035620341;
        $collect['page'] = 1;
        $collect['perPage'] = 10;
        $collect['user_id'] = 130;
        $collect['page'] = 1;
        $collect['authorization'] = $this->authorization;
        $result = $this->schedules->getScheduleById($collect);
        $data = json_decode(json_encode($result), true);
        $this->assertArrayHasKey('schedule', $data);
        $keys = array('id',
                      'owner_id',
                      'resource_id',
                      'service_id',
                      'time_windows',);
        foreach ($keys as $k) {
            $this->assertArrayHasKey($k, $data['schedule']);
        }
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
    public function testCreateSchedule() {
        //
    }

    /**
     * @todo
     */
    public function testUpdateScheduleTimeWindowById() {
        //
    }
}
