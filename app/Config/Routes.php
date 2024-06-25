<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login');
$routes->get('/login', 'Login');
$routes->post('login/auth', 'Login::auth');
$routes->get('/home', 'Home::index');
$routes->get('logout', 'Dashboard::logout');
$routes->get('auth/google', 'Auth::googleLogin');
$routes->get('auth/google/googleCallback', 'Auth::googleCallback');
$routes->post('/RegisterAccount','RegisterAccount::register');
// fogot-Password
$routes->get('/forgotpassword','Forgotpassword');
$routes->post('/forgotpassword', 'Forgotpassword::process');

// Route cho trang đặt lại mật khẩu với token
$routes->get('reset-password', 'Resetpassword::index');
$routes->post('reset-password', 'Resetpassword::process');

// page
// Changepassword
$routes->get('/layout', 'Dashboard::index');
$routes->get('/changepassword', 'Dashboard::changePassword');
$routes->post('change-password', 'ChangePassword::changePassword');
//profile
$routes->get('/profile', 'Dashboard::profile');
$routes->get('profile', 'ProfileController::show');
// Employee
$routes->get('/Employee', 'Dashboard::employee');
$routes->get('Employee', 'Employee::show');
// Create Employee
$routes->get('/createEmployee', 'Dashboard::createEmployee');
//add
$routes->post('/addEmployee', 'CreateE::add');
