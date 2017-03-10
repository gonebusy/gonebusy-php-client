<?php
/**
 * Users SDK Controller Test Case
 */

use PHPUnit\Framework\TestCase;

use GonebusyLib\Configuration;
use GonebusyLib\GonebusyClient;
use GonebusyLib\Models\CreateUserBody;
use GonebusyLib\Models\UpdateUserByIdBody;
// use GonebusyLib\Controllers\UsersController;
// ^ Not needed since we can use GonebusyClient::getUsers()

class UsersTest extends TestCase
{
    /**
     * To contain the GonebusyLib\GonebusyClient
     */
    protected $client;

    /**
     * To contain the GonebusyLib\Controllers\UsersController
     */
    protected $users;


    /**
     * Create the GonebusyClient and UsersController for each test.
     */
    public function setUp() {
        $this->client = new GonebusyClient();
        // Uses Configuration::$authorization by default: (See bootstrap.php)
        $this->users = $this->client->getUsers();
    }


    /**
     * Generate unique user data.
     * @param  string $type Should be 'create' or 'update'.
     * @return  CreateUserBody or UpdateUserByIdBody object with unique data to send to API
     */
    private function uniqueUserData($type) {
        $rand = rand(); // There's a minuscule chance this will already exist on the API.
        switch($type) {
            case 'create':
                return new CreateUserBody(
                    "e-{$rand}@mail-{$rand}.com",
                    "business_name",
                    "www.externalurl.com", // external_url
                    "first_name",
                    "last_name",
                    "permalink-{$rand}",
                    "timezone"
                );
            case 'update':
                return new UpdateUserByIdBody(
                    "business_name",
                    "e-{$rand}@mail-{$rand}.com",
                    "www.externalurl.com", // external_url
                    "first_name",
                    "last_name",
                    "permalink-{$rand}",
                    "timezone"
                );
        }
    }

    /**
     * Generate data from user response.
     * @param  GonebusyLib\Models\EntitiesUserResponse $response
     * @param  string $type Should be 'create' or 'update'.
     * @return  CreateUserBody or UpdateUserByIdBody object with data from $response
     */
    private function dataFromResponse($response, $type) {
        switch($type) {
            case 'create':
                return new CreateUserBody(
                    $response->user->email,
                    $response->user->businessName,
                    $response->user->externalUrl,
                    $response->user->firstName,
                    $response->user->lastName,
                    $response->user->permalink,
                    $response->user->timezone
                );
            case 'update':
                return new UpdateUserByIdBody(
                    $response->user->businessName,
                    $response->user->email,
                    $response->user->externalUrl,
                    $response->user->firstName,
                    $response->user->lastName,
                    $response->user->permalink,
                    $response->user->timezone
                );
        }
    }


    /**
     * Test POST /users/new
     * GonebusyLib\Controllers\UsersController::createUser()
     */
    public function testCreateUser() {
        $createUserBody = $this->uniqueUserData('create');

        // Create GonebusyLib\Models\EntitiesUserResponse:
        $response = $this->users->createUser(Configuration::$authorization, $createUserBody);

        // Was it created?
        $this->assertInstanceOf('GonebusyLib\Models\CreateUserResponse', $response);

        // Does it have all the original data we sent?
        $responseBody = $this->dataFromResponse($response, 'create');
        $this->assertEquals($responseBody, $createUserBody);

        // Can't delete test users at the moment.
    }

    /**
     * Test GET /users/{id}
     * GonebusyLib\Controllers\UsersController::getUserById()
     */
    public function testGetUserById() {
        // Create user:
        $createUserBody = $this->uniqueUserData('create');
        $createResponse = $this->users->createUser(Configuration::$authorization, $createUserBody);

        // Get user by it's id
        $response = $this->users->getUserById(Configuration::$authorization, $createResponse->user->id);

        // Was it fetched?
        $this->assertInstanceOf('GonebusyLib\Models\GetUserByIdResponse', $response);

        // Does it have all the original data we sent?
        $responseBody = $this->dataFromResponse($response, 'create');
        $this->assertEquals($responseBody, $createUserBody);
    }

    /**
     * Test PUT /users/{id}
     * GonebusyLib\Controllers\UsersController::updateUserById()
     */
    public function testUpdateUserById() {
        // Create a user:
        $createUserBody = $this->uniqueUserData('create');
        $createResponse = $this->users->createUser(Configuration::$authorization, $createUserBody);

        $anotherUserBody = $this->uniqueUserData('update');

        // Update the same user:
        $response = $this->users->updateUserById(
            Configuration::$authorization,
            $createResponse->user->id,
            $anotherUserBody);

        // Was it fetched?
        $this->assertInstanceOf('GonebusyLib\Models\UpdateUserByIdResponse', $response);

        // Does it have all the new data we sent?
        $responseBody = $this->dataFromResponse($response, 'update');
        $this->assertEquals($responseBody, $anotherUserBody);
    }

    /**
     * Test GET /users
     * GonebusyLib\Controllers\UsersController::getUsers()
     */
    public function testGetUsers() {
        $perPage = 3;
        $response = $this->users->getUsers(
            Configuration::$authorization,
            $page = 1,
            $perPage);

        $this->assertInstanceOf('GonebusyLib\Models\GetUsersResponse', $response);

        // Did it return an arrayof 3 users?
        $this->assertCount($perPage, $response->users); // Slightly hardcoded to assume $users exists in $response.
        foreach($response->users as $user) {
            $this->assertInstanceOf('GonebusyLib\Models\EntitiesUserResponse', $user);
        }
    }

}
