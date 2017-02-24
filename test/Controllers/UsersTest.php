<?php
/**
 * Users SDK Controller Test Case
 */

use PHPUnit\Framework\TestCase;

use GonebusyLib\GonebusyClient;
use GonebusyLib\Models\UpdateUserByIdBody;
use GonebusyLib\Models\CreateUserBody;
// use GonebusyLib\Controllers\UsersController;
use GonebusyLib\Exceptions\EntitiesErrorException;

class UsersTest extends TestCase
{
    private $authorization;

    /**
     * To conatin the GonebusyLib\GonebusyClient
     */
    protected $client;

    /**
     * To contain the GonebusyLib\Controllers\UsersController
     */
    protected $users;


    /**
     * Create the GoneBusy SDK client for each test.
     */
    public function setUp() {
        // TODO Use mock objects instead
        // (which will use and intercept SDK HTTP requests, returning fixture files)
        $this->authorization = "Token ac98ed08b5b0a9e7c43a233aeba841ce"; // <testing@gonebusy.com>
        $this->client = new GonebusyClient($authorization);

        $this->users = $this->client->getUsers();
    }

    // public function tearDown() {
    //
    // }


    /**
     * Test GonebusyLib\Controllers\UsersController::getUsers()
     * @todo guarantee successful listing every time (via fixture given to prism)
     */
    public function testGetUsers() {

        $response = $this->users->getUsers(
            $this->authorization,
            $page = 1,
            $perPage = 10);
        // print_r($response);

        // Just checks the response array has 'users' key
        $data = json_decode(json_encode($response), true);
        $this->assertArrayHasKey('users', $data);

        // Checks all the user fields are there // TODO compare to a fixture file
        $keys = array('account_manager_id', 'address', 'business_name', 'disabled', 'email', 'external_url', 'first_name', 'id', 'last_name', 'permalink', 'phone', 'resource_id', 'role', 'timezone');
        foreach($data['users'] as $ck) {
            foreach($keys as $k) {
                $this->assertArrayHasKey($k, $ck);
            }
        }

    }

    /**
     * Test GonebusyLib\Controllers\UsersController::updateUserById()
     * @todo change to successful update response (via fixture given to prism)
     */
    public function testCantUpdateUserById() {

        // UsersController.php:354 throws error due to inexistent user id
        $this->expectException(InvalidArgumentException::class);

        $id = 'id';
        $updateUserByIdBody = new UpdateUserByIdBody();
        // TODO: Below doesn't work with current SDK version (on PHP5.6):
        $response = $this->users->updateUserById(
                $this->authorization,
                $id,
                $updateUserByIdBody);
        print_r($response);

        // $this->assertObjectHasAttribute('user', $response);
        // $this->assertEquals($id, $response->user->accountManagerId);
    }

    /**
     * Test GonebusyLib\Controllers\UsersController::getUserById()
     * @todo implement successful get response (via fixture given to prism)
     */
    public function testGetUserById() {

        // $collect['authorization' ] = $this->authorization;
        // $id = 'id';
        // $response = $this->users->getUserById(
        //     $this->authorization,
        //     $id);
        // // print_r($response);
        //
        // $this->assertObjectHasAttribute('user', $response);
        // $this->assertEquals($id, $response->user->accountManagerId);
    }

    /**
     * Test GonebusyLib\Controllers\UsersController::createUser()
     * @todo change to successful update response (via fixture given to prism)
     */
    public function testCantCreateUserExcept() {

        // UsersController.php:183 throws error since prism can't create users...
        $this->expectException(InvalidArgumentException::class);

        $createUserBody = new CreateUserBody(
            'jorge@orpinel.com',
            'Orpinel',
            'http://jorge.orpinel.com/',
            'Jorge',
            'Orpinel',
            'jorgeorpinel',
            'GMT-05:00'
        );
        $response = $this->users->createUser(
            $this->authorization,
            $createUserBody);
        print_r($response);

        // $this->assert... // XXX What would we look for?
    }

}
