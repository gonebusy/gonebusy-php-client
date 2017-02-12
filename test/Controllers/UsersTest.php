<?php
/**
 * Users SDK Controller Test Case
 */

use PHPUnit\Framework\TestCase;

use GonebusyLib\GonebusyClient;
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
        // (which will use and inercept SDK HTTP requests, returning fixture files)
        //$this->authorization = "Token ac98ed08b5b0a9e7c43a233aeba841ce"; //
        $this->authorization    = "Token 2ae673263145c48185f945880f185b2a";
        $this->client                    = new GonebusyClient( $this->authorization );
        $this->users                    = $this->client->getUsers();
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

    public function testUpdateUserById() {

        $collect['authorization'] = $this->authorization;
        $collect['id'] = '5062958417'; // ID existente
        $updateUserByIdBody = new GonebusyLib\Models\UpdateUserByIdBody();
        $collect['updateUserByIdBody'] = $updateUserByIdBody;

        // Should get a 400
        $response = json_decode(json_encode($this->users->updateUserById($collect)), true);

        $this->assertArrayHasKey('user', $response);

        $this->assertEquals($collect['id'], $response['user']['account_manager_id']);

        // $keys = array( 'account_manager_id', 'address', 'business_name', 'disabled', 'email', 'external_url', 'first_name', 'id', 'last_name', 'permalink', 'phone', 'resource_id', 'role', 'timezone' );
        // foreach ( $keys as $k )
        // {
        //   $this->assertArrayHasKey( $k, $response[ 'user' ] );
        // }
    }

    public function testGetUserById() {

        $collect['authorization' ] = $this->authorization;
        $collect['id' ] = '5062958417'; // ID existente
        $response = json_decode(json_encode($this->users->getUserById($collect)), true);

        $this->assertArrayHasKey('user', $response);

        $this->assertEquals($collect[ 'id' ], $response['user']['account_manager_id']);

        // $keys = array( 'account_manager_id', 'address', 'business_name', 'disabled', 'email', 'external_url', 'first_name', 'id', 'last_name', 'permalink', 'phone', 'resource_id', 'role', 'timezone' );
        // foreach ( $keys as $k )
        // {
        //   $this->assertArrayHasKey( $k, $response[ 'user' ] );
        // }
    }

    public function testCreateUser() {

        $this->expectException(GonebusyLib\Exceptions\EntitiesErrorException::class);

        $collect['authorization'] = $this->authorization;
        $createUserBody = new GonebusyLib\Models\CreateUserBody();
        $collect['createUserBody'] = $createUserBody;
        $response = json_decode(json_encode($this->users->createUser($collect)), true);
    }

}
