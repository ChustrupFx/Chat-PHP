<?php

require('vendor/autoload.php');

use App\Core\Router;

$router = new Router();

$router->get('/', 'ChatController@view');

$router->dispatch();



