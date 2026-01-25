<?php

use Core\Request;
use Core\Route;

$request = new Request;
$route = new Route;

$route->get('/', 'App\Controllers\HomeController@index')->middleware('auth');
$route->get('/login', 'App\Controllers\LoginController@index');
$route->get('/register', 'App\Controllers\RegisterController@index');
$route->post('/register', 'App\Controllers\RegisterController@store');
$route->post('/login', 'App\Controllers\LoginController@login');
$route->post('/logout', 'App\Controllers\LoginController@logout');
$route->post('/contatos/store', 'App\Controllers\ContactController@store')->middleware('auth');
$route->post('/contatos/update', 'App\Controllers\ContactController@update')->middleware('auth');
$route->post('/contatos/delete', 'App\Controllers\ContactController@destroy')->middleware('auth');
$route->post('/decrypt', 'App\Controllers\ContactController@decrypt')->middleware('auth');
$route->post('/contatos/lock', 'App\Controllers\ContactController@lock')->middleware('auth');

$route->dispatch($request->uri(), $request->method());
