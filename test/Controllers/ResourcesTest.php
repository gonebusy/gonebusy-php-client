<?php
use PHPUnit\Framework\TestCase;
use GonebusyLib\GonebusyClient;

class ResourcesTest extends TestCase
{
    private $authorization;
    /**
     * To contain the GonebusyLib\GonebusyClient
     */
    protected $client;

    /**
     * TODO doc
     */
    protected $resources;

    /**
     * Create the GoneBusy SDK client for each test.
     */
    public function setUp() {
        // TODO Use mock objects instead
        // (which will use and intercept SDK HTTP requests, returning fixture files)
        $this->authorization = "Token ac98ed08b5b0a9e7c43a233aeba841ce"; //
        $this->client = new GonebusyClient($this->authorization);
        $this->resources = $this->client->getResources();
    }

    /**
     * Test GonebusyLib\Controllers\ResourcesController::getResourceThings()
     */
    public function testGetResourceThings() {
        $collect['page'] = 1;
        $collect['perPage'] = 10;
        $collect['authorization'] = $this->authorization;
        $result = $this->resources->getResourceThings($collect);
        $data = json_decode(json_encode($result), true);
        $this->assertArrayHasKey('things', $data);
    }

    /**
     * Test GonebusyLib\Controllers\ResourcesController::getResources()
     */
    public function testGetResources() {
        $collect['page'] = 1;
        $collect['perPage'] = 10;
        $collect['user_id'] = 130;
        $collect['authorization'] = $this->authorization;
        $result = $this->resources->getResources($collect);
        $data = json_decode(json_encode($result), true);
        $keys = array('capacity',
                      'description',
                      'gender',
                      'id',
                      'name',
                      'owner_id',
                      'resource_type',
                      'thing_type_id');
        foreach ($data['resources'] as $ck) {
            foreach ($keys as $k) {
                    $this->assertArrayHasKey($k, $ck);
            }
        }
    }

    /**
     * TODO doc
     */
    public function testGetResourceById() {
        $collect['id'] = 6815786092;
        $collect['page'] = 1;
        $collect['perPage'] = 10;
        $collect['user_id'] = 130;
        $collect['page'] = 1;
        $collect['authorization'] = $this->authorization;
        $result = $this->resources->getResourceById($collect);
        $data = json_decode(json_encode($result), true);
        $this->assertArrayHasKey('resource', $data);
        $keys = array('capacity',
                      'description',
                      'gender',
                      'id',
                      'name',
                      'owner_id',
                      'resource_type',
                      'thing_type_id');
        foreach ($keys as $k) {
            $this->assertArrayHasKey($k, $data['resource']);
        }
    }

    /**
     * @todo
     */
    public function testCreateResource() {
        //
    }

}
