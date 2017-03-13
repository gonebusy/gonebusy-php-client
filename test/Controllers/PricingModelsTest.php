<?php
/*
 * PricingModels SDK Controller Test Case
 */

namespace GonebusyTest\Controllers;

use PHPUnit\Framework\TestCase;

use GonebusyLib\Configuration;
use GonebusyLib\GonebusyClient;
use GonebusyLib\Models\CreatePricingModelBody;
use GonebusyLib\Models\UpdatePricingModelByIdBody;

class PricingModelsTest extends TestCase
{
    /**
     * To contain the GonebusyLib\GonebusyClient
     */
    protected $client;

    /**
     * To contain the GonebusyLib\Controllers\PricingModelsController
     */
    protected $pricingModels;


    /**
     * Create the GonebusyClient and PricingModelsController for each test.
     */
    public function setUp() {
        $this->client = new GonebusyClient();
        $this->pricingModels = $this->client->getPricingModels();
    }


    /**
     * Generate unique pricing model data.
     * @param  string $type Should be 'create' or 'update'.
     * @return  CreatePricingModelBody or UpdatePricingModelByIdBody object with unique data to send to API
     */
    private function pricingModelBody($type) {
        switch($type) {
            case 'create':
                return new CreatePricingModelBody(
                    "name",
                    "Activity", // type
                    "USD", // currency XXX This isn't having effect.
                    "notes",
                    NULL, // price
                    NULL // user_id defaults to self
                );
            case 'update':
                return new UpdatePricingModelByIdBody(
                    "MXN", // another currency XXX This isn't having effect.
                    "another name",
                    "other notes",
                    NULL // price
                );
        }
    }

    /**
     * Generate data from pricing model response.
     * @param  GonebusyLib\Models\EntitiesPricingModelResponse $response
     * @param  string $type Should be 'create' or 'update'.
     * @return  CreatePricingModelBody or UpdatePricingModelByIdBody object with data from $response
     */
    private function bodyFromResponse($response, $type) {
        switch($type) {
            case 'create':
                return new CreatePricingModelBody(
                    $response->pricingModel->name,
                    $response->pricingModel->pricingModelType,
                    "USD", // $response->pricingModel->currency, // Hardcoded
                    $response->pricingModel->notes,
                    $response->pricingModel->price,
                    NULL // $response->pricingModel->userId
                );
            case 'update':
                return new UpdatePricingModelByIdBody(
                    "MXN", // $response->pricingModel->currency, // Hardcoded
                    $response->pricingModel->name,
                    $response->pricingModel->notes,
                    $response->pricingModel->price
                );
        }
    }


    /**
     * Test POST /pricing_models/new
     * GonebusyLib\Controllers\PricingModelsController::createPricingModel()
     */
    public function testCreatePricingModel() {
        $createPricingModelBody = $this->pricingModelBody('create');

        // Create GonebusyLib\Models\EntitiesPricingModelResponse:
        $response = $this->pricingModels->createPricingModel(Configuration::$authorization, $createPricingModelBody);

        // Was it created?
        $this->assertInstanceOf('GonebusyLib\Models\CreatePricingModelResponse', $response);

        // Does it have all the original data we sent?
        $responseBody = $this->bodyFromResponse($response, 'create');
        $this->assertEquals($responseBody, $createPricingModelBody);

        // Delete test pricing model:
        // Can't delete pricing models at the moment.
    }

    /**
     * Test GET /pricing_models/{id}
     * GonebusyLib\Controllers\PricingModelsController::getPricingModelById()
     */
    public function testGetPricingModelById() {
        // Create pricing model:
        $createPricingModelBody = $this->pricingModelBody('create');
        $createResponse = $this->pricingModels->createPricingModel(Configuration::$authorization, $createPricingModelBody);

        // Get pricing model by it's id
        $response = $this->pricingModels->getPricingModelById(Configuration::$authorization, $createResponse->pricingModel->id);

        // Was it fetched?
        $this->assertInstanceOf('GonebusyLib\Models\GetPricingModelByIdResponse', $response);

        // Does it have all the original data we sent?
        $responseBody = $this->bodyFromResponse($response, 'create');
        $this->assertEquals($responseBody, $createPricingModelBody);
    }

    /**
     * Test PUT /pricing_models/{id}
     * GonebusyLib\Controllers\PricingModelsController::updatePricingModelById()
     */
    public function testUpdatePricingModelById() {
        // Create a pricing model:
        $createPricingModelBody = $this->pricingModelBody('create');
        $createResponse = $this->pricingModels->createPricingModel(Configuration::$authorization, $createPricingModelBody);

        $anotherPricingModelBody = $this->pricingModelBody('update');

        // Update the same pricing model:
        $response = $this->pricingModels->updatePricingModelById(
            Configuration::$authorization,
            $createResponse->pricingModel->id,
            $anotherPricingModelBody);

        // Was it fetched?
        $this->assertInstanceOf('GonebusyLib\Models\UpdatePricingModelByIdResponse', $response);

        // Does it have all the new data we sent?
        $responseBody = $this->bodyFromResponse($response, 'update');
        $this->assertEquals($responseBody, $anotherPricingModelBody);

        // Delete test pricing model:
        // Can't delete pricing model at the moment.
    }

    /**
     * Test GET /pricing_models
     * Assumes there's at least 3 PricingModels in the API's database.
     * GonebusyLib\Controllers\PricingModelsController::getPricingModels()
     */
    public function testGetPricingModels() {
        $perPage = 3;
        $response = $this->pricingModels->getPricingModels(
            Configuration::$authorization,
            $page = 1,
            $perPage);

        $this->assertInstanceOf('GonebusyLib\Models\GetPricingModelsResponse', $response);

        // Did it return an array of 3 pricing models?
        $this->assertCount($perPage, $response->pricingModels);
        foreach($response->pricingModels as $pricingModels) {
            $this->assertInstanceOf('GonebusyLib\Models\EntitiesPricingModelResponse', $pricingModels);
        }
    }

}
