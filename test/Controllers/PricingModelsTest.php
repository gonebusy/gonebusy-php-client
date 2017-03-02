<?php
use PHPUnit\Framework\TestCase;
use GonebusyLib\GonebusyClient;

class PricingModelsTest extends TestCase
{
    private $authorization;
    /**
     * To contain the GonebusyLib\GonebusyClient
     */
    protected $client;

    /**
     * TODO doc
     */
    protected $pricing;

    /**
     * Create the GoneBusy SDK client for each test.
     */
    public function setUp() {
        // TODO Use mock objects instead
        // (which will use and intercept SDK HTTP requests, returning fixture files)
        $this->authorization = "Token ac98ed08b5b0a9e7c43a233aeba841ce"; //
        $this->client = new GonebusyClient($this->authorization);
        $this->pricing = $this->client->getPricingModels();
    }

    /**
     * Test GonebusyLib\Controllers\PricingModelsController::getPricingModels()
     */
    public function testGetPricingModels() {
        $collect['page'] = 1;
        $collect['perPage'] = 10;
        $collect['user_id'] = '130';
        $collect['authorization'] = $this->authorization;
        $result = $this->pricing->getPricingModels($collect);
        $data = json_decode(json_encode($result), true);
        $this->assertArrayHasKey('pricing_models', $data);
        $keys = array('currency',
                      'id',
                      'name',
                      'notes',
                      'owner_id',
                      'price',
                      'pricing_model_type');
        foreach ($data['pricing_models'] as $ck) {
            foreach ($keys as $k) {
                    $this->assertArrayHasKey($k, $ck);
            }
        }
    }

    /**
     * Test GonebusyLib\Controllers\PricingModelsController::getPricingModelById()
     */
    public function testGetPricingModelById() {
        $collect['id'] = 13;
        $collect['page'] = 1;
        $collect['perPage'] = 10;
        $collect['user_id'] = '172';
        $collect['page'] = 1;
        $collect['authorization'] = $this->authorization;
        $result = $this->pricing->getPricingModelById($collect);
        $data = json_decode(json_encode($result), true);
        $this->assertArrayHasKey('pricing_model', $data);
        $keys = array('currency',
                      'id',
                      'name',
                      'notes',
                      'owner_id',
                      'price',
                      'pricing_model_type');
        foreach ($keys as $k) {
            $this->assertArrayHasKey($k, $data['pricing_model']);
        }
    }

    /**
     * @todo
     */
    public function testUpdatePricingModelById() {
        //revision
    }

    /**
     * @todo
     */
    public function testCreatePricingModel() {
        //revision
    }
}
