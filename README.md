#Getting started

## Sandbox

We have a Sandbox environment to play with!

Just use [sandbox.gonebusy.com](http://sandbox.gonebusy.com) instead of where you see beta.gonebusy.com referenced, including where to create an account to retrieve your API Key.

The Sandbox environment is completely separate from the Live site - that includes meaning your Sandbox API Key will not work in the Live environment.

## How to Build

The generated code has dependencies over external libraries like UniRest. These dependencies are defined in the ```composer.json``` file that comes with the SDK.
To resolve these dependencies, we use the Composer package manager which requires PHP greater than 5.3.2 installed in your system.
Visit [https://getcomposer.org/download/](https://getcomposer.org/download/) to download the installer file for Composer and run it in your system.
Open command prompt and type ```composer --version```. This should display the current version of the Composer installed if the installation was successful.

* Using command line, navigate to the directory containing the generated files (including ```composer.json```) for the SDK.
* Run the command ```composer install```. This should install all the required dependencies and create the ```vendor``` directory in your project directory.

![Building SDK - Step 1](http://apidocs.io/illustration/php?step=installDependencies&workspaceFolder=Gonebusy-PHP)

### [For Windows Users Only] Configuring CURL Certificate Path in php.ini

CURL used to include a list of accepted CAs, but no longer bundles ANY CA certs. So by default it will reject all SSL certificates as unverifiable. You will have to get your CA's cert and point curl at it. The steps are as follows:

1. Download the certificate bundle (.pem file) from [https://curl.haxx.se/docs/caextract.html](https://curl.haxx.se/docs/caextract.html) on to your system.
2. Add curl.cainfo = "PATH_TO/cacert.pem" to your php.ini file located in your php installation. “PATH_TO” must be an absolute path containing the .pem file.

```ini
[curl]
; A default value for the CURLOPT_CAINFO option. This is required to be an
; absolute path.
;curl.cainfo =
```

## How to Use

The following section explains how to use the Gonebusy library in a new project.

### 1. Open Project in an IDE

Open an IDE for PHP like PhpStorm. The basic workflow presented here is also applicable if you prefer using a different editor or IDE.

![Open project in PHPStorm - Step 1](http://apidocs.io/illustration/php?step=openIDE&workspaceFolder=Gonebusy-PHP)

Click on ```Open``` in PhpStorm to browse to your generated SDK directory and then click ```OK```.

![Open project in PHPStorm - Step 2](http://apidocs.io/illustration/php?step=openProject0&workspaceFolder=Gonebusy-PHP)

### 2. Add a new Test Project

Create a new directory by right clicking on the solution name as shown below:

![Add a new project in PHPStorm - Step 1](http://apidocs.io/illustration/php?step=createDirectory&workspaceFolder=Gonebusy-PHP)

Name the directory as "test"

![Add a new project in PHPStorm - Step 2](http://apidocs.io/illustration/php?step=nameDirectory&workspaceFolder=Gonebusy-PHP)

Add a PHP file to this project

![Add a new project in PHPStorm - Step 3](http://apidocs.io/illustration/php?step=createFile&workspaceFolder=Gonebusy-PHP)

Name it "testSDK"

![Add a new project in PHPStorm - Step 4](http://apidocs.io/illustration/php?step=nameFile&workspaceFolder=Gonebusy-PHP)

Depending on your project setup, you might need to include composer's autoloader in your PHP code to enable auto loading of classes.

```PHP
require_once "../vendor/autoload.php";
```

It is important that the path inside require_once correctly points to the file ```autoload.php``` inside the vendor directory created during dependency installations.

![Add a new project in PHPStorm - Step 4](http://apidocs.io/illustration/php?step=projectFiles&workspaceFolder=Gonebusy-PHP)

After this you can add code to initialize the client library and acquire the instance of a Controller class. Sample code to initialize the client library and using controller methods is given in the subsequent sections.

### 3. Run the Test Project

To run your project you must set the Interpreter for your project. Interpreter is the PHP engine installed on your computer.

Open ```Settings``` from ```File``` menu.

![Run Test Project - Step 1](http://apidocs.io/illustration/php?step=openSettings&workspaceFolder=Gonebusy-PHP)

Select ```PHP``` from within ```Languages & Frameworks```

![Run Test Project - Step 2](http://apidocs.io/illustration/php?step=setInterpreter0&workspaceFolder=Gonebusy-PHP)

Browse for Interpreters near the ```Interpreter``` option and choose your interpreter.

![Run Test Project - Step 3](http://apidocs.io/illustration/php?step=setInterpreter1&workspaceFolder=Gonebusy-PHP)

Once the interpreter is selected, click ```OK```

![Run Test Project - Step 4](http://apidocs.io/illustration/php?step=setInterpreter2&workspaceFolder=Gonebusy-PHP)

To run your project, right click on your PHP file inside your Test project and click on ```Run```

![Run Test Project - Step 5](http://apidocs.io/illustration/php?step=runProject&workspaceFolder=Gonebusy-PHP)

## How to Test

Unit tests in this SDK can be run using PHPUnit.

1. First install the dependencies using composer including the `require-dev` dependencies.
2. Run `vendor\bin\phpunit --verbose` from command line to execute tests. If you have
   installed PHPUnit globally, run tests using `phpunit --verbose` instead.

> TODO: You can change the PHPUnit test configuration in the `phpunit.xml` file.

## Initialization

### Authentication
In order to setup authentication and initialization of the API client, you need the following information.

| Parameter | Description |
|-----------|-------------|
| authorization | Set Authorization to "Token _your API key_" |



API client can be initialized as following.

```php
// Configuration parameters and credentials
$authorization = "Token <your API key>"; // Set Authorization to "Token <your API key>"

$client = new GonebusyLib\GonebusyClient($authorization);
```

## Class Reference

### <a name="list_of_controllers"></a>List of Controllers

* [BookingsController](#bookings_controller)
* [UsersController](#users_controller)
* [ServicesController](#services_controller)
* [SearchController](#search_controller)
* [SchedulesController](#schedules_controller)
* [ResourcesController](#resources_controller)
* [PricingModelsController](#pricing_models_controller)
* [CategoriesController](#categories_controller)

### <a name="bookings_controller"></a>![Class: ](http://apidocs.io/img/class.png ".BookingsController") BookingsController

#### Get singleton instance

The singleton instance of the ``` BookingsController ``` class can be accessed from the API Client.

```php
$bookings = $client->getBookings();
```

#### <a name="create_booking"></a>![Method: ](http://apidocs.io/img/method.png ".BookingsController.createBooking") createBooking

> Create a Booking with params


```php
function createBooking($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| createBookingBody |  ``` Required ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$createBookingBody = new CreateBookingBody();
$collect['createBookingBody'] = $createBookingBody;


$result = $bookings->createBooking($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 422 | Unprocessable Entity |
| 500 | Unexpected error |



#### <a name="get_bookings"></a>![Method: ](http://apidocs.io/img/method.png ".BookingsController.getBookings") getBookings

> Return list of Bookings.


```php
function getBookings($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| page |  ``` Optional ```  ``` DefaultValue ```  | Page offset to fetch. |
| perPage |  ``` Optional ```  ``` DefaultValue ```  | Number of results to return per page. |
| states |  ``` Optional ```  | Comma-separated list of Booking states to retrieve only Bookings in those states.  Leave blank to retrieve all Bookings. |
| userId |  ``` Optional ```  | Retrieve Bookings owned only by this User Id.  You must be authorized to manage this User Id. |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$page = 1;
$collect['page'] = $page;

$perPage = 10;
$collect['perPage'] = $perPage;

$states = 'states';
$collect['states'] = $states;

$userId = 172;
$collect['userId'] = $userId;


$result = $bookings->getBookings($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 500 | Unexpected error |



#### <a name="cancel_booking_by_id"></a>![Method: ](http://apidocs.io/img/method.png ".BookingsController.cancelBookingById") cancelBookingById

> Cancel a Booking by id


```php
function cancelBookingById($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$id = 'id';
$collect['id'] = $id;


$result = $bookings->cancelBookingById($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 500 | Unexpected error |



#### <a name="update_booking_by_id"></a>![Method: ](http://apidocs.io/img/method.png ".BookingsController.updateBookingById") updateBookingById

> Update a Booking by id


```php
function updateBookingById($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$id = 'id';
$collect['id'] = $id;


$result = $bookings->updateBookingById($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Unprocessable Entity |
| 500 | Unexpected error |



#### <a name="get_booking_by_id"></a>![Method: ](http://apidocs.io/img/method.png ".BookingsController.getBookingById") getBookingById

> Return a Booking by id.


```php
function getBookingById($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$id = 'id';
$collect['id'] = $id;


$result = $bookings->getBookingById($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 500 | Unexpected error |



[Back to List of Controllers](#list_of_controllers)

### <a name="users_controller"></a>![Class: ](http://apidocs.io/img/class.png ".UsersController") UsersController

#### Get singleton instance

The singleton instance of the ``` UsersController ``` class can be accessed from the API Client.

```php
$users = $client->getUsers();
```

#### <a name="update_user_by_id"></a>![Method: ](http://apidocs.io/img/method.png ".UsersController.updateUserById") updateUserById

> Update a User by id, with params.


```php
function updateUserById($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |
| updateUserByIdBody |  ``` Required ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$id = 'id';
$collect['id'] = $id;

$updateUserByIdBody = new UpdateUserByIdBody();
$collect['updateUserByIdBody'] = $updateUserByIdBody;


$result = $users->updateUserById($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Unprocessable Entity |
| 500 | Unexpected error |



#### <a name="get_user_by_id"></a>![Method: ](http://apidocs.io/img/method.png ".UsersController.getUserById") getUserById

> Return a User by id.


```php
function getUserById($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$id = 'id';
$collect['id'] = $id;


$result = $users->getUserById($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 500 | Unexpected error |



#### <a name="create_user"></a>![Method: ](http://apidocs.io/img/method.png ".UsersController.createUser") createUser

> Create a User


```php
function createUser($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| createUserBody |  ``` Required ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$createUserBody = new CreateUserBody();
$collect['createUserBody'] = $createUserBody;


$result = $users->createUser($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 422 | Unprocessable Entity |
| 500 | Unexpected error |



#### <a name="get_users"></a>![Method: ](http://apidocs.io/img/method.png ".UsersController.getUsers") getUsers

> Return all Users that your account has access to.  Includes your own User as well as any Users for which you are the Account Manager.


```php
function getUsers($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| page |  ``` Optional ```  ``` DefaultValue ```  | Page offset to fetch. |
| perPage |  ``` Optional ```  ``` DefaultValue ```  | Number of results to return per page. |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$page = 1;
$collect['page'] = $page;

$perPage = 10;
$collect['perPage'] = $perPage;


$result = $users->getUsers($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 500 | Unexpected error |



[Back to List of Controllers](#list_of_controllers)

### <a name="services_controller"></a>![Class: ](http://apidocs.io/img/class.png ".ServicesController") ServicesController

#### Get singleton instance

The singleton instance of the ``` ServicesController ``` class can be accessed from the API Client.

```php
$services = $client->getServices();
```

#### <a name="delete_service_by_id"></a>![Method: ](http://apidocs.io/img/method.png ".ServicesController.deleteServiceById") deleteServiceById

> Delete a Service by id


```php
function deleteServiceById($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$id = 'id';
$collect['id'] = $id;


$result = $services->deleteServiceById($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 500 | Unexpected error |



#### <a name="update_service_by_id"></a>![Method: ](http://apidocs.io/img/method.png ".ServicesController.updateServiceById") updateServiceById

> Update a Service with params.


```php
function updateServiceById($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |
| updateServiceByIdBody |  ``` Required ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$id = 'id';
$collect['id'] = $id;

$updateServiceByIdBody = new UpdateServiceByIdBody();
$collect['updateServiceByIdBody'] = $updateServiceByIdBody;


$result = $services->updateServiceById($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Unprocessable Entity |
| 500 | Unexpected error |



#### <a name="get_service_by_id"></a>![Method: ](http://apidocs.io/img/method.png ".ServicesController.getServiceById") getServiceById

> Return a Service by id.


```php
function getServiceById($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$id = 'id';
$collect['id'] = $id;


$result = $services->getServiceById($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 500 | Unexpected error |



#### <a name="create_service"></a>![Method: ](http://apidocs.io/img/method.png ".ServicesController.createService") createService

> Create a Service with params.


```php
function createService($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| createServiceBody |  ``` Required ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$createServiceBody = new CreateServiceBody();
$collect['createServiceBody'] = $createServiceBody;


$result = $services->createService($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Unprocessable Entity |
| 500 | Unexpected error |



#### <a name="get_services"></a>![Method: ](http://apidocs.io/img/method.png ".ServicesController.getServices") getServices

> Return list of Services.


```php
function getServices($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| page |  ``` Optional ```  ``` DefaultValue ```  | Page offset to fetch. |
| perPage |  ``` Optional ```  ``` DefaultValue ```  | Number of results to return per page. |
| userId |  ``` Optional ```  | Retrieve Services provided by the User specified by Id.  You must be authorized to manage this User Id. |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$page = 1;
$collect['page'] = $page;

$perPage = 10;
$collect['perPage'] = $perPage;

$userId = 172;
$collect['userId'] = $userId;


$result = $services->getServices($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 500 | Unexpected error |



#### <a name="get_service_available_slots_by_id"></a>![Method: ](http://apidocs.io/img/method.png ".ServicesController.getServiceAvailableSlotsById") getServiceAvailableSlotsById

> Return available times for a Service.


```php
function getServiceAvailableSlotsById($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |
| date |  ``` Optional ```  | Date to check for availability.  Either this field or a date range employing start_date and end_date must be supplied.  If date is provided, start_date/end_date are ignored.  Several formats are supported: '2014-10-31', 'October 31, 2014'. |
| endDate |  ``` Optional ```  | End Date of a range to check for availability.  If supplied, date must not be supplied and start_date must be supplied.  Several formats are supported: '2014-10-31', 'October 31, 2014'. |
| startDate |  ``` Optional ```  | Start Date of a range to check for availability.  If supplied, date must not be supplied and end_date must be supplied.  Several formats are supported: '2014-10-31', 'October 31, 2014'. |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$id = 'id';
$collect['id'] = $id;

$date = date("D M d, Y G:i");
$collect['date'] = $date;

$endDate = date("D M d, Y G:i");
$collect['endDate'] = $endDate;

$startDate = date("D M d, Y G:i");
$collect['startDate'] = $startDate;


$result = $services->getServiceAvailableSlotsById($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 500 | Unexpected error |



[Back to List of Controllers](#list_of_controllers)

### <a name="search_controller"></a>![Class: ](http://apidocs.io/img/class.png ".SearchController") SearchController

#### Get singleton instance

The singleton instance of the ``` SearchController ``` class can be accessed from the API Client.

```php
$search = $client->getSearch();
```

#### <a name="search_query"></a>![Method: ](http://apidocs.io/img/method.png ".SearchController.searchQuery") searchQuery

> Search for Providers and Provided Services.


```php
function searchQuery($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| query |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$query = 'query';
$collect['query'] = $query;


$result = $search->searchQuery($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 500 | Unexpected error |



[Back to List of Controllers](#list_of_controllers)

### <a name="schedules_controller"></a>![Class: ](http://apidocs.io/img/class.png ".SchedulesController") SchedulesController

#### Get singleton instance

The singleton instance of the ``` SchedulesController ``` class can be accessed from the API Client.

```php
$schedules = $client->getSchedules();
```

#### <a name="delete_schedule_time_window_by_id"></a>![Method: ](http://apidocs.io/img/method.png ".SchedulesController.deleteScheduleTimeWindowById") deleteScheduleTimeWindowById

> Delete a TimeWindow from a Schedule


```php
function deleteScheduleTimeWindowById($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |
| timeWindowId |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$id = 'id';
$collect['id'] = $id;

$timeWindowId = 'time_window_id';
$collect['timeWindowId'] = $timeWindowId;


$result = $schedules->deleteScheduleTimeWindowById($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 500 | Unexpected error |



#### <a name="create_schedule_time_window"></a>![Method: ](http://apidocs.io/img/method.png ".SchedulesController.createScheduleTimeWindow") createScheduleTimeWindow

> Add a TimeWindow to a Schedule.


```php
function createScheduleTimeWindow($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| createScheduleTimeWindowBody |  ``` Required ```  | the content of the request |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$createScheduleTimeWindowBody = new CreateScheduleTimeWindowBody();
$collect['createScheduleTimeWindowBody'] = $createScheduleTimeWindowBody;

$id = 'id';
$collect['id'] = $id;


$result = $schedules->createScheduleTimeWindow($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Unprocessable Entity |
| 500 | Unexpected error |



#### <a name="delete_schedule_by_id"></a>![Method: ](http://apidocs.io/img/method.png ".SchedulesController.deleteScheduleById") deleteScheduleById

> Delete a Schedule


```php
function deleteScheduleById($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$id = 'id';
$collect['id'] = $id;


$result = $schedules->deleteScheduleById($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 500 | Unexpected error |



#### <a name="get_schedule_by_id"></a>![Method: ](http://apidocs.io/img/method.png ".SchedulesController.getScheduleById") getScheduleById

> Return a Schedule by id.


```php
function getScheduleById($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$id = 'id';
$collect['id'] = $id;


$result = $schedules->getScheduleById($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 410 | Gone |
| 500 | Unexpected error |



#### <a name="create_schedule"></a>![Method: ](http://apidocs.io/img/method.png ".SchedulesController.createSchedule") createSchedule

> Create a Schedule with params.


```php
function createSchedule($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| createScheduleBody |  ``` Required ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$createScheduleBody = new CreateScheduleBody();
$collect['createScheduleBody'] = $createScheduleBody;


$result = $schedules->createSchedule($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Unprocessable Entity |
| 500 | Unexpected error |



#### <a name="update_schedule_time_window_by_id"></a>![Method: ](http://apidocs.io/img/method.png ".SchedulesController.updateScheduleTimeWindowById") updateScheduleTimeWindowById

> Update a TimeWindow for a Schedule.


```php
function updateScheduleTimeWindowById($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |
| timeWindowId |  ``` Required ```  | TODO: Add a parameter description |
| updateScheduleTimeWindowByIdBody |  ``` Required ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$id = 'id';
$collect['id'] = $id;

$timeWindowId = 'time_window_id';
$collect['timeWindowId'] = $timeWindowId;

$updateScheduleTimeWindowByIdBody = new UpdateScheduleTimeWindowByIdBody();
$collect['updateScheduleTimeWindowByIdBody'] = $updateScheduleTimeWindowByIdBody;


$result = $schedules->updateScheduleTimeWindowById($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Unprocessable Entity |
| 500 | Unexpected error |



#### <a name="get_schedules"></a>![Method: ](http://apidocs.io/img/method.png ".SchedulesController.getSchedules") getSchedules

> Return all Schedules that your account has access to.  Includes Schedules for your own User as well as any Users for which you are the Account Manager.


```php
function getSchedules($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| page |  ``` Optional ```  ``` DefaultValue ```  | Page offset to fetch. |
| perPage |  ``` Optional ```  ``` DefaultValue ```  | Number of results to return per page. |
| userId |  ``` Optional ```  | Retrieve Schedules owned only by this User Id.  You must be authorized to manage this User Id. |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$page = 1;
$collect['page'] = $page;

$perPage = 10;
$collect['perPage'] = $perPage;

$userId = 130;
$collect['userId'] = $userId;


$result = $schedules->getSchedules($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 500 | Unexpected error |



[Back to List of Controllers](#list_of_controllers)

### <a name="resources_controller"></a>![Class: ](http://apidocs.io/img/class.png ".ResourcesController") ResourcesController

#### Get singleton instance

The singleton instance of the ``` ResourcesController ``` class can be accessed from the API Client.

```php
$resources = $client->getResources();
```

#### <a name="delete_resource_by_id"></a>![Method: ](http://apidocs.io/img/method.png ".ResourcesController.deleteResourceById") deleteResourceById

> Delete a Resource by id


```php
function deleteResourceById($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$id = 'id';
$collect['id'] = $id;


$result = $resources->deleteResourceById($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 500 | Unexpected error |



#### <a name="update_resource_by_id"></a>![Method: ](http://apidocs.io/img/method.png ".ResourcesController.updateResourceById") updateResourceById

> Update a Resource by id, with params


```php
function updateResourceById($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |
| updateResourceByIdBody |  ``` Required ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$id = 'id';
$collect['id'] = $id;

$updateResourceByIdBody = new UpdateResourceByIdBody();
$collect['updateResourceByIdBody'] = $updateResourceByIdBody;


$result = $resources->updateResourceById($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Unprocessable Entity |
| 500 | Unexpected error |



#### <a name="get_resource_by_id"></a>![Method: ](http://apidocs.io/img/method.png ".ResourcesController.getResourceById") getResourceById

> Return a Resource by id.


```php
function getResourceById($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$id = 'id';
$collect['id'] = $id;


$result = $resources->getResourceById($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 500 | Unexpected error |



#### <a name="get_resource_things"></a>![Method: ](http://apidocs.io/img/method.png ".ResourcesController.getResourceThings") getResourceThings

> Return all Resource Things.


```php
function getResourceThings($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| page |  ``` Optional ```  ``` DefaultValue ```  | Page offset to fetch. |
| perPage |  ``` Optional ```  ``` DefaultValue ```  | Number of results to return per page. |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$page = 1;
$collect['page'] = $page;

$perPage = 10;
$collect['perPage'] = $perPage;


$result = $resources->getResourceThings($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 500 | Unexpected error |



#### <a name="create_resource"></a>![Method: ](http://apidocs.io/img/method.png ".ResourcesController.createResource") createResource

> Create a Resource with params


```php
function createResource($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| createResourceBody |  ``` Required ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$createResourceBody = new CreateResourceBody();
$collect['createResourceBody'] = $createResourceBody;


$result = $resources->createResource($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 422 | Unprocessable Entity |
| 500 | Unexpected error |



#### <a name="get_resources"></a>![Method: ](http://apidocs.io/img/method.png ".ResourcesController.getResources") getResources

> Return list of Resources.


```php
function getResources($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| page |  ``` Optional ```  ``` DefaultValue ```  | Page offset to fetch. |
| perPage |  ``` Optional ```  ``` DefaultValue ```  | Number of results to return per page. |
| userId |  ``` Optional ```  | Retrieve Resources owned only by this User Id.  You must be authorized to manage this User Id. |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$page = 1;
$collect['page'] = $page;

$perPage = 10;
$collect['perPage'] = $perPage;

$userId = 130;
$collect['userId'] = $userId;


$result = $resources->getResources($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 500 | Unexpected error |



[Back to List of Controllers](#list_of_controllers)

### <a name="pricing_models_controller"></a>![Class: ](http://apidocs.io/img/class.png ".PricingModelsController") PricingModelsController

#### Get singleton instance

The singleton instance of the ``` PricingModelsController ``` class can be accessed from the API Client.

```php
$pricingModels = $client->getPricingModels();
```

#### <a name="update_pricing_model_by_id"></a>![Method: ](http://apidocs.io/img/method.png ".PricingModelsController.updatePricingModelById") updatePricingModelById

> Update a PricingModel by id, with params


```php
function updatePricingModelById($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |
| updatePricingModelByIdBody |  ``` Required ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$id = 'id';
$collect['id'] = $id;

$updatePricingModelByIdBody = new UpdatePricingModelByIdBody();
$collect['updatePricingModelByIdBody'] = $updatePricingModelByIdBody;


$result = $pricingModels->updatePricingModelById($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Unprocessable Entity |
| 500 | Unexpected error |



#### <a name="get_pricing_model_by_id"></a>![Method: ](http://apidocs.io/img/method.png ".PricingModelsController.getPricingModelById") getPricingModelById

> Return a PricingModel by id.


```php
function getPricingModelById($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$id = 'id';
$collect['id'] = $id;


$result = $pricingModels->getPricingModelById($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 500 | Unexpected error |



#### <a name="create_pricing_model"></a>![Method: ](http://apidocs.io/img/method.png ".PricingModelsController.createPricingModel") createPricingModel

> Create a PricingModel with params


```php
function createPricingModel($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| createPricingModelBody |  ``` Required ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$createPricingModelBody = new CreatePricingModelBody();
$collect['createPricingModelBody'] = $createPricingModelBody;


$result = $pricingModels->createPricingModel($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 422 | Unprocessable Entity |
| 500 | Unexpected error |



#### <a name="get_pricing_models"></a>![Method: ](http://apidocs.io/img/method.png ".PricingModelsController.getPricingModels") getPricingModels

> Return list of PricingModels.


```php
function getPricingModels($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| page |  ``` Optional ```  ``` DefaultValue ```  | Page offset to fetch. |
| perPage |  ``` Optional ```  ``` DefaultValue ```  | Number of results to return per page. |
| userId |  ``` Optional ```  | Retrieve PricingModels owned only by this User Id.  You must be authorized to manage this User Id. |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$page = 1;
$collect['page'] = $page;

$perPage = 10;
$collect['perPage'] = $perPage;

$userId = 130;
$collect['userId'] = $userId;


$result = $pricingModels->getPricingModels($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 500 | Unexpected error |



[Back to List of Controllers](#list_of_controllers)

### <a name="categories_controller"></a>![Class: ](http://apidocs.io/img/class.png ".CategoriesController") CategoriesController

#### Get singleton instance

The singleton instance of the ``` CategoriesController ``` class can be accessed from the API Client.

```php
$categories = $client->getCategories();
```

#### <a name="get_category_by_id"></a>![Method: ](http://apidocs.io/img/method.png ".CategoriesController.getCategoryById") getCategoryById

> Return a Category by id.


```php
function getCategoryById($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$id = 'id';
$collect['id'] = $id;


$result = $categories->getCategoryById($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 500 | Unexpected error |



#### <a name="create_category"></a>![Method: ](http://apidocs.io/img/method.png ".CategoriesController.createCategory") createCategory

> Create a Category


```php
function createCategory($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| createCategoryBody |  ``` Required ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$createCategoryBody = new CreateCategoryBody();
$collect['createCategoryBody'] = $createCategoryBody;


$result = $categories->createCategory($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 422 | Unprocessable Entity |
| 500 | Unexpected error |



#### <a name="get_categories"></a>![Method: ](http://apidocs.io/img/method.png ".CategoriesController.getCategories") getCategories

> Return list of Categories.


```php
function getCategories($options)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| page |  ``` Optional ```  ``` DefaultValue ```  | Page offset to fetch. |
| perPage |  ``` Optional ```  ``` DefaultValue ```  | Number of results to return per page. |
| userId |  ``` Optional ```  | Retrieve Categories of all services provided by this User Id.  You must be authorized to manage this User Id. |



#### Example Usage

```php
$authorization = 'Authorization';
$collect['authorization'] = $authorization;

$page = 1;
$collect['page'] = $page;

$perPage = 10;
$collect['perPage'] = $perPage;

$userId = 222;
$collect['userId'] = $userId;


$result = $categories->getCategories($collect);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 500 | Unexpected error |



[Back to List of Controllers](#list_of_controllers)
