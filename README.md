# GoneBusy PHP Client API

You will need [PHP](http://php.net/) and [Composer](https://getcomposer.org/) to work with this code. This has only been tested on POSIX.

## How To Configure:
The generated code might need to be configured with your API credentials. To do that, provide the credentials and configuration values as a constructor parameters for the controllers.

## How To Build:
```sh
composer install
```
The generated code uses a PHP library called [UniRest](http://unirest.io/php.html). Its already added as a composer dependency in the generated composer.json file. Therefore, you will need internet access to resolve this dependency.

## How To Use:
For using this SDK do the following:

1. Make a new PHP >= 5.3 project and copy the generated PHP files form `src/` and `vendor/` in your project directory.
1. Import classes from your file in your code where needed for example, use GoneBusy\Controllers\BookingsController;
1. You can now instantiate controllers and call the respective methods.
