<?php
use PHPUnit\Framework\TestCase;
use GonebusyLib\GonebusyClient;

class SearchTest extends TestCase
{
    private $authorization;
    /**
     * To contain the GonebusyLib\GonebusyClient
     */
    protected $client;

    /**
     * TODO doc
     */
    protected $search;

    /**
     * Create the GoneBusy SDK client for each test.
     */
    public function setUp() {
        // TODO Use mock objects instead
        // (which will use and intercept SDK HTTP requests, returning fixture files)
        $this->authorization = "Token ac98ed08b5b0a9e7c43a233aeba841ce"; //
        $this->client = new GonebusyClient($this->authorization);
        $this->search = $this->client->getSearch();
    }


    /**
     * TODO doc
     */
    public function testSearchQueries() {
        $collect['query'] = 'query';
        $collect['authorization'] = $this->authorization;
        $result = $this->search->searchQuery($collect);
        $data = json_decode(json_encode($result), true);
        $this->assertArrayHasKey('results', $data);
    }
}
