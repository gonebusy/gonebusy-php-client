[![Build Status](https://travis-ci.org/gonebusy/gonebusy-php-client.svg?branch=master)](https://travis-ci.org/gonebusy/gonebusy-php-client)

# PHP SDK for the GoneBusy REST API

## Sandbox

We have a Sandbox environment to play with!

Just use [sandbox.gonebusy.com](https://sandbox.gonebusy.com) instead of where you see beta.gonebusy.com referenced, including where to create an account to retrieve your API Key.

The Sandbox environment is completely separate from the Live site - that includes meaning your Sandbox API Key will not work in the Live environment.

## How to Build

The generated code has dependencies over external libraries like UniRest. These dependencies are defined in the ```composer.json``` file that comes with the SDK.
To resolve these dependencies, we use the Composer package manager which requires PHP greater than 5.3.2 installed in your system.
Visit [https://getcomposer.org/download/](https://getcomposer.org/download/) to download the installer file for Composer and run it in your system.
Open command prompt and type ```composer --version```. This should display the current version of the Composer installed if the installation was successful.

* From this folder, run the command ```composer install```. This should install all of the required dependencies and create the ```vendor``` directory in your project directory.

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

### 1. Open project in an IDE

Open an IDE for PHP.

Open this folder as a PHP project.

### 2. Add a new project folder

Create a new directory. Name the directory as "my-project".

Add a PHP file to this project. For exampe name it "trySDK.php".

Depending on your project setup, you might need to include composer's autoloader in your PHP code to enable auto loading of classes"

```php
require_once "../vendor/autoload.php";
```

> Note: the `../` path assumes you'll run trySDK.php directly from my-project/ .

After this you can add code to initialize the client library and acquire the instance of a Controller class. Sample code to initialize the client library and using controller methods is given in the subsequent sections.

Summary of GoneBusy objects (more info on the [Developer Portal](https://gonebusy.github.io/api/)):  
A **User** is required to perform operations.  
A **Resource** (WHO) performs Services and is needed for all scheduling operations.
_Each User is assigned a default Resource (her/himself) automatically._  
A **Service** (WHAT) is performed by Resources according to a Schedule.
_Services are assigned a **Pricing Model**._
_Services can be assigned a **Category** as well._  
A **Schedule** (WHEN) defines when a Service is performed by a Resource.  Pieces of a Schedule are called **Time Windows**.  
Finally, a **Booking** is placed (at a particular Time Window) in a Schedule, linking it to a Resource-Service combo.  
_A **Search** of users and services can be performed._  

### 3. Run your project

```sh
php my-project/trySDK.php
```

## How to Test
Unit tests in this SDK can be run using PHPUnit. The test cases are located in the test/Controllers/ dir.

1. Make sure you've installed the dependencies using composer including the `require-dev` dependencies (you may have already done this with `composer install` or `composer update`).
1. Run `vendor/bin/phpunit --verbose` from command line to execute the test suite.

## Initialization/Authentication

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
* [CategoriesController](#categories_controller)
* [PricingModelsController](#pricing_models_controller)
* [ResourcesController](#resources_controller)
* [SchedulesController](#schedules_controller)
* [SearchController](#search_controller)
* [ServicesController](#services_controller)
* [UsersController](#users_controller)

### <a name="bookings_controller"></a>![Class: ](https://apidocs.io/img/class.png ".BookingsController") BookingsController

#### Get singleton instance

The singleton instance of the ``` BookingsController ``` class can be accessed from the API Client.

```php
$bookings = $client->getBookings();
```

#### <a name="get_bookings"></a>![Method: ](https://apidocs.io/img/method.png ".BookingsController.getBookings") getBookings

> Return list of Bookings.


```php
function getBookings(
        $authorization,
        $page = 1,
        $perPage = 10,
        $states = null,
        $userId = null)
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
$page = 1;
$perPage = 10;
$states = 'states';
$userId = 131;

$result = $bookings->getBookings($authorization, $page, $perPage, $states, $userId);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 0 | Unexpected error |



#### <a name="create_booking"></a>![Method: ](https://apidocs.io/img/method.png ".BookingsController.createBooking") createBooking

> Create a Booking with params


```php
function createBooking(
        $authorization,
        $createBookingBody = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| createBookingBody |  ``` Optional ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$createBookingBody = new CreateBookingBody();

$result = $bookings->createBooking($authorization, $createBookingBody);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 422 | Unprocessable Entity |
| 0 | Unexpected error |



#### <a name="get_booking_by_id"></a>![Method: ](https://apidocs.io/img/method.png ".BookingsController.getBookingById") getBookingById

> Return a Booking by id.


```php
function getBookingById(
        $authorization,
        $id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$id = 'id';

$result = $bookings->getBookingById($authorization, $id);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 0 | Unexpected error |



#### <a name="update_booking_by_id"></a>![Method: ](https://apidocs.io/img/method.png ".BookingsController.updateBookingById") updateBookingById

> Update a Booking by id


```php
function updateBookingById(
        $authorization,
        $id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$id = 'id';

$result = $bookings->updateBookingById($authorization, $id);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Unprocessable Entity |
| 0 | Unexpected error |



#### <a name="cancel_booking_by_id"></a>![Method: ](https://apidocs.io/img/method.png ".BookingsController.cancelBookingById") cancelBookingById

> Cancel a Booking by id


```php
function cancelBookingById(
        $authorization,
        $id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$id = 'id';

$result = $bookings->cancelBookingById($authorization, $id);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 0 | Unexpected error |



[Back to List of Controllers](#list_of_controllers)

### <a name="categories_controller"></a>![Class: ](https://apidocs.io/img/class.png ".CategoriesController") CategoriesController

#### Get singleton instance

The singleton instance of the ``` CategoriesController ``` class can be accessed from the API Client.

```php
$categories = $client->getCategories();
```

#### <a name="get_categories"></a>![Method: ](https://apidocs.io/img/method.png ".CategoriesController.getCategories") getCategories

> Return list of Categories.


```php
function getCategories(
        $authorization,
        $page = 1,
        $perPage = 10,
        $userId = null)
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
$page = 1;
$perPage = 10;
$userId = 131;

$result = $categories->getCategories($authorization, $page, $perPage, $userId);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 0 | Unexpected error |



#### <a name="create_category"></a>![Method: ](https://apidocs.io/img/method.png ".CategoriesController.createCategory") createCategory

> Create a Category


```php
function createCategory(
        $authorization,
        $createCategoryBody = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| createCategoryBody |  ``` Optional ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$createCategoryBody = new CreateCategoryBody();

$result = $categories->createCategory($authorization, $createCategoryBody);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 422 | Unprocessable Entity |
| 0 | Unexpected error |



#### <a name="get_category_by_id"></a>![Method: ](https://apidocs.io/img/method.png ".CategoriesController.getCategoryById") getCategoryById

> Return a Category by id.


```php
function getCategoryById(
        $authorization,
        $id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$id = 'id';

$result = $categories->getCategoryById($authorization, $id);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 0 | Unexpected error |



[Back to List of Controllers](#list_of_controllers)

### <a name="pricing_models_controller"></a>![Class: ](https://apidocs.io/img/class.png ".PricingModelsController") PricingModelsController

#### Get singleton instance

The singleton instance of the ``` PricingModelsController ``` class can be accessed from the API Client.

```php
$pricingModels = $client->getPricingModels();
```

#### <a name="get_pricing_models"></a>![Method: ](https://apidocs.io/img/method.png ".PricingModelsController.getPricingModels") getPricingModels

> Return list of PricingModels.


```php
function getPricingModels(
        $authorization,
        $page = 1,
        $perPage = 10,
        $userId = null)
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
$page = 1;
$perPage = 10;
$userId = 131;

$result = $pricingModels->getPricingModels($authorization, $page, $perPage, $userId);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 0 | Unexpected error |



#### <a name="create_pricing_model"></a>![Method: ](https://apidocs.io/img/method.png ".PricingModelsController.createPricingModel") createPricingModel

> Create a PricingModel with params


```php
function createPricingModel(
        $authorization,
        $createPricingModelBody = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| createPricingModelBody |  ``` Optional ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$createPricingModelBody = new CreatePricingModelBody();

$result = $pricingModels->createPricingModel($authorization, $createPricingModelBody);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 422 | Unprocessable Entity |
| 0 | Unexpected error |



#### <a name="get_pricing_model_by_id"></a>![Method: ](https://apidocs.io/img/method.png ".PricingModelsController.getPricingModelById") getPricingModelById

> Return a PricingModel by id.


```php
function getPricingModelById(
        $authorization,
        $id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$id = 'id';

$result = $pricingModels->getPricingModelById($authorization, $id);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 0 | Unexpected error |



#### <a name="update_pricing_model_by_id"></a>![Method: ](https://apidocs.io/img/method.png ".PricingModelsController.updatePricingModelById") updatePricingModelById

> Update a PricingModel by id, with params


```php
function updatePricingModelById(
        $authorization,
        $id,
        $updatePricingModelByIdBody = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |
| updatePricingModelByIdBody |  ``` Optional ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$id = 'id';
$updatePricingModelByIdBody = new UpdatePricingModelByIdBody();

$result = $pricingModels->updatePricingModelById($authorization, $id, $updatePricingModelByIdBody);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Unprocessable Entity |
| 0 | Unexpected error |



[Back to List of Controllers](#list_of_controllers)

### <a name="resources_controller"></a>![Class: ](https://apidocs.io/img/class.png ".ResourcesController") ResourcesController

#### Get singleton instance

The singleton instance of the ``` ResourcesController ``` class can be accessed from the API Client.

```php
$resources = $client->getResources();
```

#### <a name="get_resources"></a>![Method: ](https://apidocs.io/img/method.png ".ResourcesController.getResources") getResources

> Return list of Resources.


```php
function getResources(
        $authorization,
        $page = 1,
        $perPage = 10,
        $userId = null)
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
$page = 1;
$perPage = 10;
$userId = 89;

$result = $resources->getResources($authorization, $page, $perPage, $userId);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 0 | Unexpected error |



#### <a name="create_resource"></a>![Method: ](https://apidocs.io/img/method.png ".ResourcesController.createResource") createResource

> Create a Resource with params


```php
function createResource(
        $authorization,
        $createResourceBody = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| createResourceBody |  ``` Optional ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$createResourceBody = new CreateResourceBody();

$result = $resources->createResource($authorization, $createResourceBody);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 422 | Unprocessable Entity |
| 0 | Unexpected error |



#### <a name="get_resource_things"></a>![Method: ](https://apidocs.io/img/method.png ".ResourcesController.getResourceThings") getResourceThings

> Return all Resource Things.


```php
function getResourceThings(
        $authorization,
        $page = 1,
        $perPage = 10)
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
$page = 1;
$perPage = 10;

$result = $resources->getResourceThings($authorization, $page, $perPage);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 0 | Unexpected error |



#### <a name="get_resource_by_id"></a>![Method: ](https://apidocs.io/img/method.png ".ResourcesController.getResourceById") getResourceById

> Return a Resource by id.


```php
function getResourceById(
        $authorization,
        $id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$id = 'id';

$result = $resources->getResourceById($authorization, $id);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 0 | Unexpected error |



#### <a name="update_resource_by_id"></a>![Method: ](https://apidocs.io/img/method.png ".ResourcesController.updateResourceById") updateResourceById

> Update a Resource by id, with params


```php
function updateResourceById(
        $authorization,
        $id,
        $updateResourceByIdBody = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |
| updateResourceByIdBody |  ``` Optional ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$id = 'id';
$updateResourceByIdBody = new UpdateResourceByIdBody();

$result = $resources->updateResourceById($authorization, $id, $updateResourceByIdBody);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Unprocessable Entity |
| 0 | Unexpected error |



#### <a name="delete_resource_by_id"></a>![Method: ](https://apidocs.io/img/method.png ".ResourcesController.deleteResourceById") deleteResourceById

> Delete a Resource by id


```php
function deleteResourceById(
        $authorization,
        $id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$id = 'id';

$result = $resources->deleteResourceById($authorization, $id);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 0 | Unexpected error |



[Back to List of Controllers](#list_of_controllers)

### <a name="schedules_controller"></a>![Class: ](https://apidocs.io/img/class.png ".SchedulesController") SchedulesController

#### Get singleton instance

The singleton instance of the ``` SchedulesController ``` class can be accessed from the API Client.

```php
$schedules = $client->getSchedules();
```

#### <a name="get_schedules"></a>![Method: ](https://apidocs.io/img/method.png ".SchedulesController.getSchedules") getSchedules

> Return all Schedules that your account has access to.  Includes Schedules for your own User as well as any Users for which you are the Account Manager.


```php
function getSchedules(
        $authorization,
        $page = 1,
        $perPage = 10,
        $userId = null)
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
$page = 1;
$perPage = 10;
$userId = 89;

$result = $schedules->getSchedules($authorization, $page, $perPage, $userId);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 0 | Unexpected error |



#### <a name="create_schedule"></a>![Method: ](https://apidocs.io/img/method.png ".SchedulesController.createSchedule") createSchedule

> Create a Schedule with params.


```php
function createSchedule(
        $authorization,
        $createScheduleBody = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| createScheduleBody |  ``` Optional ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$createScheduleBody = new CreateScheduleBody();

$result = $schedules->createSchedule($authorization, $createScheduleBody);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Unprocessable Entity |
| 0 | Unexpected error |



#### <a name="get_schedule_by_id"></a>![Method: ](https://apidocs.io/img/method.png ".SchedulesController.getScheduleById") getScheduleById

> Return a Schedule by id.


```php
function getScheduleById(
        $authorization,
        $id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$id = 'id';

$result = $schedules->getScheduleById($authorization, $id);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 410 | Gone |
| 0 | Unexpected error |



#### <a name="delete_schedule_by_id"></a>![Method: ](https://apidocs.io/img/method.png ".SchedulesController.deleteScheduleById") deleteScheduleById

> Delete a Schedule


```php
function deleteScheduleById(
        $authorization,
        $id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$id = 'id';

$result = $schedules->deleteScheduleById($authorization, $id);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 0 | Unexpected error |



#### <a name="create_schedule_time_window"></a>![Method: ](https://apidocs.io/img/method.png ".SchedulesController.createScheduleTimeWindow") createScheduleTimeWindow

> Add a TimeWindow to a Schedule.


```php
function createScheduleTimeWindow(
        $authorization,
        $id,
        $createScheduleTimeWindowBody = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |
| createScheduleTimeWindowBody |  ``` Optional ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$id = 'id';
$createScheduleTimeWindowBody = new CreateScheduleTimeWindowBody();

$result = $schedules->createScheduleTimeWindow($authorization, $id, $createScheduleTimeWindowBody);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Unprocessable Entity |
| 0 | Unexpected error |



#### <a name="update_schedule_time_window_by_id"></a>![Method: ](https://apidocs.io/img/method.png ".SchedulesController.updateScheduleTimeWindowById") updateScheduleTimeWindowById

> Update a TimeWindow for a Schedule.


```php
function updateScheduleTimeWindowById(
        $authorization,
        $id,
        $timeWindowId,
        $updateScheduleTimeWindowByIdBody = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |
| timeWindowId |  ``` Required ```  | TODO: Add a parameter description |
| updateScheduleTimeWindowByIdBody |  ``` Optional ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$id = 'id';
$timeWindowId = 'time_window_id';
$updateScheduleTimeWindowByIdBody = new UpdateScheduleTimeWindowByIdBody();

$result = $schedules->updateScheduleTimeWindowById($authorization, $id, $timeWindowId, $updateScheduleTimeWindowByIdBody);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Unprocessable Entity |
| 0 | Unexpected error |



#### <a name="delete_schedule_time_window_by_id"></a>![Method: ](https://apidocs.io/img/method.png ".SchedulesController.deleteScheduleTimeWindowById") deleteScheduleTimeWindowById

> Delete a TimeWindow from a Schedule


```php
function deleteScheduleTimeWindowById(
        $authorization,
        $id,
        $timeWindowId)
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
$id = 'id';
$timeWindowId = 'time_window_id';

$result = $schedules->deleteScheduleTimeWindowById($authorization, $id, $timeWindowId);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 0 | Unexpected error |



[Back to List of Controllers](#list_of_controllers)

### <a name="search_controller"></a>![Class: ](https://apidocs.io/img/class.png ".SearchController") SearchController

#### Get singleton instance

The singleton instance of the ``` SearchController ``` class can be accessed from the API Client.

```php
$search = $client->getSearch();
```

#### <a name="search_query"></a>![Method: ](https://apidocs.io/img/method.png ".SearchController.searchQuery") searchQuery

> Search for Providers and Provided Services.


```php
function searchQuery(
        $authorization,
        $query)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| query |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$query = 'query';

$result = $search->searchQuery($authorization, $query);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 0 | Unexpected error |



[Back to List of Controllers](#list_of_controllers)

### <a name="services_controller"></a>![Class: ](https://apidocs.io/img/class.png ".ServicesController") ServicesController

#### Get singleton instance

The singleton instance of the ``` ServicesController ``` class can be accessed from the API Client.

```php
$services = $client->getServices();
```

#### <a name="get_services"></a>![Method: ](https://apidocs.io/img/method.png ".ServicesController.getServices") getServices

> Return list of Services.


```php
function getServices(
        $authorization,
        $page = 1,
        $perPage = 10,
        $userId = null)
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
$page = 1;
$perPage = 10;
$userId = 89;

$result = $services->getServices($authorization, $page, $perPage, $userId);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 0 | Unexpected error |



#### <a name="create_service"></a>![Method: ](https://apidocs.io/img/method.png ".ServicesController.createService") createService

> Create a Service with params.


```php
function createService(
        $authorization,
        $createServiceBody = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| createServiceBody |  ``` Optional ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$createServiceBody = new CreateServiceBody();

$result = $services->createService($authorization, $createServiceBody);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Unprocessable Entity |
| 0 | Unexpected error |



#### <a name="get_service_available_slots_by_id"></a>![Method: ](https://apidocs.io/img/method.png ".ServicesController.getServiceAvailableSlotsById") getServiceAvailableSlotsById

> Return available times for a Service.


```php
function getServiceAvailableSlotsById(
        $authorization,
        $id,
        $date = null,
        $endDate = null,
        $startDate = null)
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
$id = 'id';
$date = date("D M d, Y G:i");
$endDate = date("D M d, Y G:i");
$startDate = date("D M d, Y G:i");

$result = $services->getServiceAvailableSlotsById($authorization, $id, $date, $endDate, $startDate);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 0 | Unexpected error |



#### <a name="get_service_by_id"></a>![Method: ](https://apidocs.io/img/method.png ".ServicesController.getServiceById") getServiceById

> Return a Service by id.


```php
function getServiceById(
        $authorization,
        $id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$id = 'id';

$result = $services->getServiceById($authorization, $id);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 0 | Unexpected error |



#### <a name="update_service_by_id"></a>![Method: ](https://apidocs.io/img/method.png ".ServicesController.updateServiceById") updateServiceById

> Update a Service with params.


```php
function updateServiceById(
        $authorization,
        $id,
        $updateServiceByIdBody = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |
| updateServiceByIdBody |  ``` Optional ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$id = 'id';
$updateServiceByIdBody = new UpdateServiceByIdBody();

$result = $services->updateServiceById($authorization, $id, $updateServiceByIdBody);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Unprocessable Entity |
| 0 | Unexpected error |



#### <a name="delete_service_by_id"></a>![Method: ](https://apidocs.io/img/method.png ".ServicesController.deleteServiceById") deleteServiceById

> Delete a Service by id


```php
function deleteServiceById(
        $authorization,
        $id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$id = 'id';

$result = $services->deleteServiceById($authorization, $id);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 0 | Unexpected error |



[Back to List of Controllers](#list_of_controllers)

### <a name="users_controller"></a>![Class: ](https://apidocs.io/img/class.png ".UsersController") UsersController

#### Get singleton instance

The singleton instance of the ``` UsersController ``` class can be accessed from the API Client.

```php
$users = $client->getUsers();
```

#### <a name="get_users"></a>![Method: ](https://apidocs.io/img/method.png ".UsersController.getUsers") getUsers

> Return all Users that your account has access to.  Includes your own User as well as any Users for which you are the Account Manager.


```php
function getUsers(
        $authorization,
        $page = 1,
        $perPage = 10)
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
$page = 1;
$perPage = 10;

$result = $users->getUsers($authorization, $page, $perPage);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 0 | Unexpected error |



#### <a name="create_user"></a>![Method: ](https://apidocs.io/img/method.png ".UsersController.createUser") createUser

> Create a User


```php
function createUser(
        $authorization,
        $createUserBody = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| createUserBody |  ``` Optional ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$createUserBody = new CreateUserBody();

$result = $users->createUser($authorization, $createUserBody);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 422 | Unprocessable Entity |
| 0 | Unexpected error |



#### <a name="get_user_by_id"></a>![Method: ](https://apidocs.io/img/method.png ".UsersController.getUserById") getUserById

> Return a User by id.


```php
function getUserById(
        $authorization,
        $id)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |



#### Example Usage

```php
$authorization = 'Authorization';
$id = 'id';

$result = $users->getUserById($authorization, $id);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 0 | Unexpected error |



#### <a name="update_user_by_id"></a>![Method: ](https://apidocs.io/img/method.png ".UsersController.updateUserById") updateUserById

> Update a User by id, with params.


```php
function updateUserById(
        $authorization,
        $id,
        $updateUserByIdBody = null)
```

#### Parameters

| Parameter | Tags | Description |
|-----------|------|-------------|
| authorization |  ``` Required ```  | A valid API key, in the format 'Token API_KEY' |
| id |  ``` Required ```  | TODO: Add a parameter description |
| updateUserByIdBody |  ``` Optional ```  | the content of the request |



#### Example Usage

```php
$authorization = 'Authorization';
$id = 'id';
$updateUserByIdBody = new UpdateUserByIdBody();

$result = $users->updateUserById($authorization, $id, $updateUserByIdBody);

```

#### Errors

| Error Code | Error Description |
|------------|-------------------|
| 400 | Bad Request |
| 401 | Unauthorized/Missing Token |
| 403 | Forbidden |
| 404 | Not Found |
| 422 | Unprocessable Entity |
| 0 | Unexpected error |



[Back to List of Controllers](#list_of_controllers)
