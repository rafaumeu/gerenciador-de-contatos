<?php

use Core\Request;
use Core\Route;

$request = new Request;
$route = new Route;

$route->get('/', 'App\Controllers\HomeController@index');
$route->get('/contatos', 'App\Controllers\ContactController@index');
$route->get('/login', 'App\Controllers\LoginController@index');
$route->get('/register', 'App\Controllers\RegisterController@index');

$route->dispatch($request->uri(), $request->method());
