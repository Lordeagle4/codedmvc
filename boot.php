<?php
require_once('./vendor/autoload.php');

//import classes
use Dotenv\Dotenv;

//initialize the enviroment variables.
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

//initialize plate template
$templates = new League\Plates\Engine('./src/Views');

//initialize the middleware system
try {
    $middlewareDirectory = './src/Middleware';
    $middlewareFiles = glob("$middlewareDirectory/*middleware.php");
    foreach ($middlewareFiles as $middlewareFile) {
        //include_once $middlewareFile;
        $className = 'Codedwebltd\\Microservice\\Middleware\\' . pathinfo($middlewareFile, PATHINFO_FILENAME);

        if (class_exists($className)) {
            //create new instance of the middleware class if exist
            new $className();
        }
    }
} catch (\Throwable $th) {
    echo json_encode(array([
        'message' => $th->getMessage()
    ]));
}

//register classes in the app container


//initialize the routing system
try {
    $request = $_SERVER['REQUEST_URI'];
    $basePath = $_ENV['BASE_PATH'];
    if (strpos($request, $basePath) === 0) {
        $request = substr($request, strlen($basePath));
    }
    $endpoint = trim(parse_url($request, PHP_URL_PATH), '/');
    require_once('./src/Routes/web.php');
} catch (\Throwable $th) {
    echo json_encode(array([
        'message' => $th->getMessage()
    ]));
}


