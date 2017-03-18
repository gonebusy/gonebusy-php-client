<?php
/*
 * Categories SDK Controller Test Case
 */

use PHPUnit\Framework\TestCase;

use GonebusyLib\Configuration;
use GonebusyLib\GonebusyClient;
use GonebusyLib\Models\CreateCategoryBody;
use GonebusyLib\Models\UpdateCategoryByIdBody;

class CategoriesTest extends TestCase
{
    /**
     * To contain the GonebusyLib\GonebusyClient
     */
    protected $client;

    /**
     * To contain the GonebusyLib\Controllers\CategoriesController
     */
    protected $categories;


    /**
     * Create the GonebusyClient and CategoriesController for each test.
     */
    public function setUp() {
        $this->client = new GonebusyClient();
        $this->categories = $this->client->getCategories();
    }


    /**
     * Generate arbitrary category data.
     * @return  CreateCategoryBody object with unique data to send to API
     */
    private function uniqueCategoryBody() {
        $rand = rand(); // There's a minuscule chance this will already exist on the API.
        return new CreateCategoryBody(
            "description",
            "name-{$rand}",
            "long_name",
            NULL, // parent_category_id
            "short_name"
        );
    }

    /**
     * Generate data from pricing model response.
     * @param  GonebusyLib\Models\EntitiesCategoryResponse $response
     * @return  CreateCategoryBody object with data from $response
     */
    private function bodyFromResponse($response) {
        return new CreateCategoryBody(
            $response->category->description,
            $response->category->name,
            $response->category->longName,
            $response->category->parentCategoryId,
            $response->category->shortName
        );
    }


    /**
     * Test POST /categories/new
     * GonebusyLib\Controllers\CategoriesController::createCategory()
     */
    public function testCreateCategory() {
        $createCategoryBody = $this->uniqueCategoryBody('create');

        // Create GonebusyLib\Models\EntitiesCategoryResponse:
        $response = $this->categories->createCategory(Configuration::$authorization, $createCategoryBody);

        // Was it created?
        $this->assertInstanceOf('GonebusyLib\Models\CreateCategoryResponse', $response);

        // Does it have all the original data we sent?
        $responseBody = $this->bodyFromResponse($response, 'create');
        $this->assertEquals($responseBody, $createCategoryBody);

        // Delete test category:
        // Can't delete categories at the moment.
    }

    /**
     * Test GET /categories/{id}
     * GonebusyLib\Controllers\CategoriesController::getCategoryById()
     */
    public function testGetCategoryById() {
        // Create category:
        $createCategoryBody = $this->uniqueCategoryBody('create');
        $createResponse = $this->categories->createCategory(Configuration::$authorization, $createCategoryBody);

        // Get category by it's id
        $response = $this->categories->getCategoryById(Configuration::$authorization, $createResponse->category->id);

        // Was it fetched?
        $this->assertInstanceOf('GonebusyLib\Models\GetCategoryByIdResponse', $response);

        // Does it have all the original data we sent?
        $responseBody = $this->bodyFromResponse($response, 'create');
        $this->assertEquals($responseBody, $createCategoryBody);
    }

    /**
     * Test GET /categories
     * GonebusyLib\Controllers\CategoriesController::getCategories()
     */
    public function testGetCategories() {
        $perPage = 3;
        $response = $this->categories->getCategories(
            Configuration::$authorization,
            $page = 1,
            $perPage);

        $this->assertInstanceOf('GonebusyLib\Models\GetCategoriesResponse', $response);

        // Did it return an array of 3 categories?
        $this->assertCount($perPage, $response->categories); // Slightly hardcoded to assume $categories exists in $response.
        foreach($response->categories as $category) {
            $this->assertInstanceOf('GonebusyLib\Models\EntitiesCategoryResponse', $category);
        }
    }

}
