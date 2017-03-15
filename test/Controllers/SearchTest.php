<?php
/*
 * Search SDK Controller Test Case
 */

namespace GonebusyTest\Controllers;

use PHPUnit\Framework\TestCase;

use GonebusyLib\Configuration;
use GonebusyLib\GonebusyClient;

class SearchTest extends TestCase
{
    /**
     * To contain the GonebusyLib\GonebusyClient
     */
    protected $client;

    /**
     * To contain the GonebusyLib\Controllers\SearchController
     */
    protected $search;


    /**
     * Create the GonebusyClient and SearchController for each test.
     */
    public function setUp() {
        $this->client = new GonebusyClient();
        $this->search = $this->client->getSearch();
    }


    /**
     * Test GET /search
     * Assumes there's at least 3 search in the API's database.
     * GonebusyLib\Controllers\SearchController::searchQuery()
     */
    public function testSearchQuery() {
        $query = "testing@gonebusy.com"; // XXX Is this working?
        $response = $this->search->searchQuery(
            Configuration::$authorization,
            $query);

        $this->assertInstanceOf('GonebusyLib\Models\SearchQueryResponse', $response);

        // Did it return valid search results?
        $this->assertInstanceOf('GonebusyLib\Models\EntitiesSearchResponse', $response->results);
    }

}
