<?php

require_once './vendor/autoload.php';

use App\Router;

define('base_path', __DIR__);
define('DS', DIRECTORY_SEPARATOR);

$router = new Router();
$router->getRoute();














