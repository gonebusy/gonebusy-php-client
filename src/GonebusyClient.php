<?php
/*
 * Gonebusy
 *
 * This file was automatically generated for GoneBusy Inc. by APIMATIC v2.0 ( https://apimatic.io ) on 11/18/2016
 */

namespace GonebusyLib;

use GonebusyLib\Controllers;

/**
 * Gonebusy client class
 */
class GonebusyClient
{
    /**
     * Constructor with authentication and configuration parameters
     */
    public function __construct($authorization = NULL)
    {
        Configuration::$authorization = $authorization ? $authorization : Configuration::$authorization;
    }
 
    /**
     * Singleton access to Bookings controller
     * @return Controllers\BookingsController The *Singleton* instance
     */
    public function getBookings()
    {
        return Controllers\BookingsController::getInstance();
    }
 
    /**
     * Singleton access to Users controller
     * @return Controllers\UsersController The *Singleton* instance
     */
    public function getUsers()
    {
        return Controllers\UsersController::getInstance();
    }
 
    /**
     * Singleton access to Services controller
     * @return Controllers\ServicesController The *Singleton* instance
     */
    public function getServices()
    {
        return Controllers\ServicesController::getInstance();
    }
 
    /**
     * Singleton access to Search controller
     * @return Controllers\SearchController The *Singleton* instance
     */
    public function getSearch()
    {
        return Controllers\SearchController::getInstance();
    }
 
    /**
     * Singleton access to Schedules controller
     * @return Controllers\SchedulesController The *Singleton* instance
     */
    public function getSchedules()
    {
        return Controllers\SchedulesController::getInstance();
    }
 
    /**
     * Singleton access to Resources controller
     * @return Controllers\ResourcesController The *Singleton* instance
     */
    public function getResources()
    {
        return Controllers\ResourcesController::getInstance();
    }
 
    /**
     * Singleton access to PricingModels controller
     * @return Controllers\PricingModelsController The *Singleton* instance
     */
    public function getPricingModels()
    {
        return Controllers\PricingModelsController::getInstance();
    }
 
    /**
     * Singleton access to Categories controller
     * @return Controllers\CategoriesController The *Singleton* instance
     */
    public function getCategories()
    {
        return Controllers\CategoriesController::getInstance();
    }
}