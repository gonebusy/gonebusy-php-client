<?php
/**
 * Users SDK Controller Test Case
 */

use PHPUnit\Framework\TestCase;

use GonebusyLib\GonebusyClient;
use GonebusyLib\Models\UpdateUserByIdBody;
use GonebusyLib\Models\CreateUserBody;
// use GonebusyLib\Controllers\UsersController;

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
     */
    public function testGetUsers() {

        $collect['page'] = 1;
        $collect['perPage'] = 10;
        $collect['authorization'] = $this->authorization;
        $request = $this->users->getUsers($collect);
        // print_r($request);

        // Just checks the response array has 'users' key
        $data = json_decode(json_encode($request), true);
        $this->assertArrayHasKey('users', $data);

        // TODO mocking... fixtures!
        // Checks all the user fields are there
        $keys = array('account_manager_id', 'address', 'business_name', 'disabled', 'email', 'external_url', 'first_name', 'id', 'last_name', 'permalink', 'phone', 'resource_id', 'role', 'timezone');
        foreach($data[ 'users' ] as $ck) {
            foreach($keys as $k) {
                $this->assertArrayHasKey($k, $ck);
            }
        }

    }

    /**
     * Test GonebusyLib\Controllers\UsersController::updateUserById()
     */
    public function testUpdateUserById() {
        //
        // // Sandbox returns Unprocessable Entity
        // $this->expectException(GonebusyLib\Exceptions\EntitiesErrorException::class);
        //
        // $collect['authorization'] = $this->authorization;
        // $collect['id'] = '8552697701'; // <testing@gonebusy.com>
        // $updateUserByIdBody = new UpdateUserByIdBody();
        // $collect['updateUserByIdBody'] = $updateUserByIdBody;
        // // TODO: Below doesn't work with current SDK version (on PHP5.6):
        // $response = json_decode(json_encode($this->users->updateUserById($collect)), true);
        //
        // $this->assertArrayHasKey('user', $response);
        // $this->assertEquals($collect['id'], $response['user']['account_manager_id']);
    }

    /**
     * Test GonebusyLib\Controllers\UsersController::getUserById()
     */
    public function testGetUserById() {

        $collect['authorization' ] = $this->authorization;
        $collect['id' ] = '8552697701'; // <testing@gonebusy.com>
        $response = json_decode(json_encode($this->users->getUserById($collect)), true);

        $this->assertArrayHasKey('user', $response);
        $this->assertEquals($collect['id'], $response['user']['account_manager_id']);
    }

    /**
     * Test GonebusyLib\Controllers\UsersController::createUser()
     */
    public function testCreateUserExcept() {

        // Sandbox returns Bad Request
        $this->expectException(GonebusyLib\Exceptions\EntitiesErrorException::class);

        $collect['authorization'] = $this->authorization;
        $createUserBody = new CreateUserBody(
            'jorge@orpinel.com',
            'Orpinel',
            'http://jorge.orpinel.com/',
            'Jorge',
            'Orpinel',
            'jorgeorpinel',
            'GMT-05:00'
        );
        $collect['createUserBody'] = $createUserBody;
        $response = json_decode(json_encode($this->users->createUser($collect)), true);
    }

}
