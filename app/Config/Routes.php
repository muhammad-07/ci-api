<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('register', 'ApiController::register');
$routes->get('verifyOTP', 'ApiController::verifyOTP');
$routes->get('addBeneficiary', 'ApiController::addBeneficiary');
$routes->get('listBeneficiary', 'ApiController::listBeneficiary');
$routes->get('fundTransfer', 'ApiController::fundTransfer');