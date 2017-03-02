<?php
use PHPUnit\Framework\TestCase;
use GonebusyLib\GonebusyClient;


class CategoriesTest extends TestCase
{
    private $authorization;
    /**
     * To contain the GonebusyLib\GonebusyClient
     */
    protected $client;

    /**
     * TODO doc
     */
    protected $categories;

    /**
     * Create the GoneBusy SDK client for each test.
     */
    public function setUp() {
        // TODO Use mock objects instead
        // (which will use and intercept SDK HTTP requests, returning fixture files)
        $this->authorization = "Token ac98ed08b5b0a9e7c43a233aeba841ce"; //
        $this->client = new GonebusyClient($this->authorization);
        $this->categories = $this->client->getCategories();
    }


    /**
     * TODO doc
     */
    public function testGetCategories() {
        $collect['page'] = 1;
        $collect['perPage'] = 10;
        $collect['user_id'] = '172';
        $collect['authorization'] = $this->authorization;
        $result = $this->categories->getCategories($collect);
        $data = json_decode(json_encode($result), true);
        $this->assertArrayHasKey('categories', $data);
        $keys = array('description',
                      'id',
                      'is_active',
                      'long_name',
                      'name',
                      'parent_category_id',
                      'short_name',
                      'subcategories');
        foreach ($data['categories'] as $ck) {
            foreach ($keys as $k) {
                    $this->assertArrayHasKey($k, $ck);
            }
        }
    }

    /**
     * TODO doc
     */
    public function testGetCategoryById() {
        $collect['id'] = 6;
        $collect['page'] = 1;
        $collect['perPage'] = 10;
        $collect['user_id'] = '172';
        $collect['page'] = 1;
        $collect['authorization'] = $this->authorization;
        $result = $this->categories->getCategoryById($collect);
        $data = json_decode(json_encode($result), true);
        $this->assertArrayHasKey('category', $data);
        $keys = array('description',
                      'id',
                      'is_active',
                      'long_name',
                      'name',
                      'parent_category_id',
                      'short_name',
                      'subcategories');
        foreach ($keys as $k) {
            $this->assertArrayHasKey($k, $data['category']);
        }
    }

    /**
     * @todo
     */
    public function testCreateCategory() {
        //
    }
}
