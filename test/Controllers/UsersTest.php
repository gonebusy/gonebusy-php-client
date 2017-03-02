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
     * To contain the GonebusyLib\GonebusyClient
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
        $this->authorization = "Token ac98ed08b5b0a9e7c43a233aeba841ce"; // <testing@gonebusy.com>
        $this->client = new GonebusyClient($this->authorization);

        $this->users = $this->client->getUsers();
    }

    /**
     * Test POST /users/new
     * GonebusyLib\Controllers\UsersController::createUser()
     */
    public function testCreateUser() {
        $rand = rand();
        $createUserBody = new CreateUserBody(
            "e-{$rand}@mail-{$rand}.com",
            "business_name",
            "www.externalurl.com", # external_url
            "first_name",
            "last_name",
            "permalink-{$rand}",
            "timezone"
        );
        // print_r($createUserBody);

        $response = $this->users->createUser(
            $this->authorization,
            $createUserBody);
        // print_r($response);

        $this->assertObjectHasAttribute('user', $response);

        $responseBody = new CreateUserBody(
            $response->user->email,
            $response->user->businessName,
            $response->user->externalUrl,
            $response->user->firstName,
            $response->user->lastName,
            $response->user->permalink,
            $response->user->timezone
        );
        // print_r($responseBody);

        $this->assertEquals($createUserBody, $responseBody);

        // Can't delete created user ATM.
    }

    /**
     * Test GET /users/{id}
     * GonebusyLib\Controllers\UsersController::getUserById()
     */
    public function testGetUserById() {
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
     * Test PUT /users/{id}
     * GonebusyLib\Controllers\UsersController::updateUserById()
     */
    public function testUpdateUserById() {
        // // $this->expectException(EntitiesErrorException::class);
        //
        // $id = 'id';
        // $updateUserByIdBody = new UpdateUserByIdBody();
        // $response = $this->users->updateUserById(
        //         $this->authorization,
        //         $id,
        //         $updateUserByIdBody);
        // print_r($response);

        // $this->assertObjectHasAttribute('user', $response);
        // $this->assertEquals($id, $response->user->accountManagerId);
    }

    /**
     * Test GET /users
     * GonebusyLib\Controllers\UsersController::getUsers()
     */
    public function testGetUsers() {

        $response = $this->users->getUsers(
            $this->authorization,
            $page = 1,
            $perPage = 3);
        // print_r($response);

        $this->assertObjectHasAttribute('users', $response);

        // $testingUserBody = new CreateUserBody(
        //     "8552697701",
        //     "testing@gonebusy.com",
        //     "8552697701",
        //     "6815786092",
        //     "pro"
        // );
        // print_r($testingUserBody);
        //
        // $responseBody = new CreateUserBody(
        //     $response->users[0]->accountManagerId,
        //     $response->users[0]->email,
        //     $response->users[0]->id,
        //     $response->users[0]->resourceId,
        //     $response->users[0]->role
        // );
        // print_r($responseBody);
        //
        // $this->assertEquals($testingUserBody, $responseBody);
    }

    // /**
    //  * Tear down tests.
    //  */
    // public function tearDown() {
    //
    // }

}
