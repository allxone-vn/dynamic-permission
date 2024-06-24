<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login');
$routes->get('/login', 'Login');
$routes->post('login/auth', 'Login::auth');
$routes->get('/home', 'Home::index');
$routes->get('logout', 'home::logout');
$routes->get('auth/google', 'Auth::googleLogin');
$routes->get('auth/google/googleCallback', 'Auth::googleCallback');
$routes->post('/RegisterAccount','RegisterAccount::register');
$routes->get('/forgotpassword','Forgotpassword');