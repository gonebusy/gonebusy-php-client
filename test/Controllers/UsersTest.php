<?php
/**
 * Users SDK Controller Test Case
 */

use PHPUnit\Framework\TestCase;

use GonebusyLib\Configuration;
use GonebusyLib\GonebusyClient;
use GonebusyLib\Models\CreateUserBody;
// use GonebusyLib\Controllers\UsersController; # Not needed since we can use GonebusyClient::getUsers()

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
        $this->client = new GonebusyClient();
        # Uses Configuration::$authorization by default: (See bootstrap.php)
        $this->users = $this->client->getUsers();
    }


    /**
     * Generate unique user data.
     * @return  GonebusyLib\Models\CreateUserBody
     */
    private function uniqueUserData() {
        $rand = rand();
        return new CreateUserBody(
            "e-{$rand}@mail-{$rand}.com",
            "business_name",
            "www.externalurl.com", # external_url
            "first_name",
            "last_name",
            "permalink-{$rand}",
            "timezone"
        );
    }

    /**
     * Generate data from user response.
     * @param  GonebusyLib\Models\EntitiesUserResponse $response
     * @return  GonebusyLib\Models\CreateUserBody
     */
    private function dataFromResponse($response) {
        return new CreateUserBody(
            $response->user->email,
            $response->user->businessName,
            $response->user->externalUrl,
            $response->user->firstName,
            $response->user->lastName,
            $response->user->permalink,
            $response->user->timezone
        );
    }


    /**
     * Test POST /users/new
     * GonebusyLib\Controllers\UsersController::createUser()
     */
    public function testCreateUser() {
        $createUserBody = $this->uniqueUserData();

        // Create GonebusyLib\Models\EntitiesUserResponse:
        $response = $this->users->createUser(Configuration::$authorization, $createUserBody);

        // Was it created?
        $this->assertObjectHasAttribute('user', $response);

        // Does it have all the original data we sent?
        $responseBody = $this->dataFromResponse($response);
        $this->assertEquals($responseBody, $createUserBody);

        // Can't delete test users at the moment.
    }

    /**
     * Test GET /users/{id}
     * GonebusyLib\Controllers\UsersController::getUserById()
     */
    public function testGetUserById() {
        // Create user:
        $createUserBody = $this->uniqueUserData();
        $createResponse = $this->users->createUser(Configuration::$authorization, $createUserBody);

        // Get user by it's id
        $response = $this->users->getUserById(Configuration::$authorization, $createResponse->user->id);

        // Was it fetched?
        $this->assertObjectHasAttribute('user', $response);

        // Does it have all the original data we sent?
        $responseBody = $this->dataFromResponse($response);
        $this->assertEquals($responseBody, $createUserBody);
    }

    /**
     * Test PUT /users/{id}
     * GonebusyLib\Controllers\UsersController::updateUserById()
     */
    public function testUpdateUserById() {
        // Create user:
        $createUserBody = $this->uniqueUserData();
        $createResponse = $this->users->createUser(Configuration::$authorization, $createUserBody);

        $anotherUserBody = $this->uniqueUserData();

        // Update user by it's id
        $response = $this->users->updateUserById(
            Configuration::$authorization,
            $createResponse->user->id,
            $anotherUserBody);

        // Was it fetched?
        $this->assertObjectHasAttribute('user', $response);

        // Does it have all the new data we sent?
        $responseBody = $this->dataFromResponse($response);
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

        // Did it return an arrayof 3 users?
        $this->assertObjectHasAttribute('users', $response);
        $this->assertCount($perPage, $response->users);
        foreach($response->users as $user) {
            $this->assertInstanceOf('GonebusyLib\Models\EntitiesUserResponse', $user);
        }
    }

}
