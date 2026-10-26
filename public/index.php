<?php

use App\Router;

if (preg_match('/\.(?:png|jpg|jpeg|gif|webp|css|js)$/', $_SERVER["REQUEST_URI"])) {
    return false;    // serve the requested resource as-is.
}

if (is_file(__DIR__ . '/../vendor/autoload.php')) {
    require __DIR__ . '/../vendor/autoload.php';
} else {
    spl_autoload_register(static function ($class) {
        if (!str_starts_with($class, 'App\\')) {
            return;
        }

        $class = substr($class, strlen('App\\'));
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        require_once __DIR__ . '/../src/' . $class . '.php';
    });
}

session_start();
require __DIR__ . '/../helpers.php';
require __DIR__ . '/../routes.php';

$router = new Router($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
$match = $router->match();
if($match) {
    if(is_callable($match->getAction())) {
        call_user_func($match->getAction());
    } else {
        $class = $match->getAction()[0];
        $controller = new $class();
        $method = $match->getAction()[1];
        $controller->$method();
    }
} else {
    http_response_code(404);
    echo '404 Not Found';
}