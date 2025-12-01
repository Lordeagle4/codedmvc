<?php
namespace Codedwebltd\Microservice\Middleware;

class Shopmiddleware {

    protected $isGlobal = true;

    public function __construct()
    {
        $this->startShopmiddleware();
    }

    /**
    * Middleware Logic starts here
    * @Middleware
    **/
    public function startShopmiddleware()
    {
        //var_dump("Shop Middleware Initialized");
    }
}

// Automatically Instantiating Global Middleware
// During the application bootstrapping process, the code iterates through the middleware files within the designated directory.
// For each middleware file found, it includes the file and checks for classes defined within it.
// Upon discovering these classes, the code instantiates each one, checking if they possess an 'isGlobal' property set to 'true'.
// If the 'isGlobal' property is 'true', the middleware instance is stored for global availability throughout the application.
// This automatic instantiation ensures that global middleware logic is available across all application endpoints.

// new Shopmiddleware(); //Do not uncomment this line to avoid creating double instances of the middleware class.
