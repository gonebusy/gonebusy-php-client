<?php
use PHPUnit\Framework\TestCase;
use GonebusyLib\GonebusyClient;

class ServicesTest extends TestCase
{
    private $authorization;
    /**
     * To contain the GonebusyLib\GonebusyClient
     */
    protected $client;

    /**
     * TODO doc
     */
    protected $services;

    /**
     * Create the GoneBusy SDK client for each test.
     */
    public function setUp() {
        // TODO Use mock objects instead
        // (which will use and intercept SDK HTTP requests, returning fixture files)
        $this->authorization = "Token ac98ed08b5b0a9e7c43a233aeba841ce"; //
        $this->client = new GonebusyClient($this->authorization);
        $this->services = $this->client->getServices();
    }

    /**
     * TODO doc
     */
    public function testGetServices() {
        $collect['page'] = 1;
        $collect['perPage'] = 10;
        $collect['user_id'] = 172;
        $collect['authorization'] = $this->authorization;
        $result = $this->services->getServices($collect);
        $data = json_decode(json_encode($result), true);
        $keys = array('categories',
                         'description',
                         'duration',
                         'max_duration',
                         'id',
                         'is_active',
                         'name',
                         'owner_id',
                         'price_model_id',
                         'resources',
                         'short_name',);
        foreach ($data['services'] as $ck) {
            foreach ($keys as $k) {
                    $this->assertArrayHasKey($k, $ck);
            }
        }
    }
    /**
     * TODO doc
     */
    public function testGetServiceById() {
        $collect['id'] = 2671089445;
        $collect['page'] = 1;
        $collect['perPage'] = 10;
        $collect['user_id'] = 172;
        $collect['page'] = 1;
        $collect['authorization'] = $this->authorization;
        $result = $this->services->getServiceById($collect);
        $data = json_decode(json_encode($result), true);
        $this->assertArrayHasKey('service', $data);
        $keys = array('categories',
                         'description',
                         'duration',
                         'max_duration',
                         'id',
                         'is_active',
                         'name',
                         'owner_id',
                         'price_model_id',
                         'resources',
                         'short_name',);
        foreach ($keys as $k) {
            $this->assertArrayHasKey($k, $data['service']);
        }
    }
    /**
     * TODO doc
     * @todo
     */
    public function testGetServiceAvailableSlotsById() {
        $collect['id'] = 2671089445;
        $collect['date'] = "test";
        $collect['endDate'] = "test";
        $collect['startDate'] = "test";
        // $collect['authorization'] = $this->authorization;
        // $result = $this->services->getServiceAvailableSlotsById($collect);
        // $data = json_decode(json_encode($result), true);
        // $this->assertArrayHasKey('service', $data);
        // $keys = array('categories',
        //                  'description',
        //                  'duration',
        //                  'max_duration',
        //                  'id',
        //                  'is_active',
        //                  'name',
        //                  'owner_id',
        //                  'price_model_id',
        //                  'resources',
        //                  'short_name',);
        // foreach ($keys as $k) {
        //     $this->assertArrayHasKey($k, $data['service']);
        // }
    }

    /**
     * @todo
     */
    public function deleteServiceById() {
        //
    }

    /**
     * @todo
     */
    public function updateServiceById() {
        //
    }

    /**
     * @todo
     */
    public function createService() {
        //
    }

}
