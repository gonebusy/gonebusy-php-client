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
        $this->authorization = "Token ac98ed08b5b0a9e7c43a233aeba841ce"; //
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
        $result = $this->users->getUsers($collect);

        $this->assertEquals(200, $result['code'] );

        //$decodedResponse = $request->getBody()->getContents();
        $data = json_decode( json_encode( $result ), true );

        //
        $this->assertArrayHasKey('users', $data);

        // TODO mocking... fixtures!
        // $keys = array('id', 'name' ,'short_name' ,'long_name' ,'description' ,'parent_category_id' ,'is_active' ,'subcategories');
        $keys = array('account_manager_id','address','business_name','disabled','email','external_url','first_name','id','last_name','permalink','phone','resource_id','role','timezone');
        foreach ($data['users'] as $ck) {
            foreach ($keys as $k) {
                    $this->assertArrayHasKey($k, $ck);
            }
        }

    }

    public function testUpdateUserById() {

        // $collect['authorization'] = $this->authorization;
        // $collect['id'] = '1';
        // $updateUserByIdBody = new GonebusyLib\Models\UpdateUserByIdBody();
        // $collect['updateUserByIdBody'] = $updateUserByIdBody;
        // // Gets a 400
        // $result = $this->users->updateUserById($collect);

    }

    public function testGetUserById() {

        // $collect['authorization'] = $this->authorization;
        // $collect['id'] = '5062958417';
        // $result = $this->users->getUserById($collect);
        // var_dump($result);
    }

    public function testCreateUser() {

        // $collect['authorization'] = $this->authorization;
        // $createUserBody = new GonebusyLib\Models\CreateUserBody();
        // $collect['createUserBody'] = $createUserBody;
        // $result = $this->users->createUser($collect);
        // var_dump($result);
    }

}
