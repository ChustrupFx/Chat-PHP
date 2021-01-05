<?php

define('URL_BASE', 'http://localhost:8080');

require('../vendor/autoload.php');

use App\Core\Router;
use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable(__DIR__."/../");
$dotenv->load();

$router = new Router();

$router::get('/', 'ChatController@view')->name('chat.view');
$router::post('/sendmessage', 'ChatController@sendMessage')->name('chat.sendmessage');


$router->dispatch();



