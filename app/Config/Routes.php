<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 * 
 */

$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get('/petshop', 'PetshopController::index'); //Display products

    $routes->get('/search', 'PetshopController::index'); //product search for petshop home

    $routes->post('/product/add', 'ProductlistController::addProduct'); //add products process

    $routes->post('/product/delete/(:num)', 'ProductlistController::deleteProduct/$1'); //remove product process

    $routes->get('/product', 'ProductlistController::index'); //product list display

    $routes->get('/product/filter', 'ProductlistController::filterProduct'); //filtering for product list

    $routes->get('/product/search', 'ProductlistController::index'); //product search for product list

    $routes->post('product/update/(:num)', 'ProductlistController::updateProduct/$1'); //Update Process

    $routes->get('/soldout', 'SoldOutListController::index'); //Delete Process

    $routes->post('/buy/(:num)', 'BuyproductController::buyProduct/$1'); //buying process

    $routes->post('/sold_out/update/(:num)', 'SoldOutListController::updateSoldProduct/$1');

    $routes->post('/sold_out/restock/(:num)', 'SoldOutListController::restock/$1');

    $routes->get('/reports', 'ReportsController::sales'); //Sales report

    $routes->get('reports/monthlyReport', 'ReportsController::monthlyReport'); //PDF

    $routes->get('/profile', 'UsersProfileController::showProfile');

    $routes->post('/profile/update/(:num)', 'UsersProfileController::updateProfile/$1');

    //Admin

    $routes->get('/dashboard', 'AdminController::index');

    $routes->get('/admin/users', 'AdminController::users'); //users display

    $routes->post('/admin/users/delete/(:num)', 'UsersController::deleteUser/$1'); //users DELETE PROCESS

    $routes->post('/admin/users/update/(:num)', 'UsersController::updateUser/$1'); //users UPDATE DATA

    $routes->get('/admin/users/rejected', 'AdminController::rejectedUsers'); //rejected users display

    $routes->post('/admin/users/rejected/delete/(:num)', 'UsersController::deleteUser/$1'); //rejected users delete

    $routes->post('/admin/users/default-password', 'AdminController::defaultPassword'); //rejected users delete

    $routes->post('/admin/users/rejected/pending/(:num)', 'AdminController::pendingUser/$1'); //MOVE TO PENDING USER REJECTED

    $routes->get('/admin/users/pending', 'AdminController::pendingUsers'); //pending users display

    $routes->post('/admin/users/pending/approved/(:num)', 'AdminController::approveUser/$1'); //pending users display

    $routes->post('/admin/users/pending/rejected/(:num)', 'AdminController::rejectUser/$1'); //reject process

    $routes->get('/admin/sales', 'AdminController::adminSales');

    $routes->get('/admin/sales/q', 'AdminController::adminSales');

    $routes->get('/admin/sales/print', 'AdminController::printSales');

    $routes->get('/admin/schedules', 'Home::schedule'); //Scheduling http://192.254.0.1/api/admin/schedules

    $routes->post('/admin/schedules', 'DeviceRegister::update');

    $routes->post('/admin/schedules/add', 'DeviceRegister::addDevice');

    $routes->post('/admin/system/toggleActive/(:num)', 'SchedulingController::toggle/$1');
});

//login
$routes->get('/login', 'UsersController::users');
$routes->get('/', 'UsersController::users');

$routes->post('auth/login', 'UsersController::login');

$routes->post('/register', 'UsersController::registerUser');
$routes->get('/logout', 'UsersController::logout');


//ESP12 Connection

$routes->get('api/test', 'SchedulingController::res');
$routes->post('api/register', 'DeviceRegister::register');
$routes->post('api/get-sched', 'DeviceRegister::getSched');
