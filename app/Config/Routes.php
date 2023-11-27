<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */



//  landing
$routes->get('/', 'Landing::index');
$routes->post('/suara_partai', 'Landing::suara_partai');
$routes->get('/login', 'Landing::login');
$routes->get('/logout', 'Landing::logout');
$routes->post('/auth', 'Landing::auth');
$routes->post('/logout', 'Landing::logout');

// search
$routes->post('/indonesia', 'Search::indonesia');
$routes->post('/suara', 'Search::suara');



// home
$routes->get('/home', 'Home::index');


// menu
$routes->get('/menu', 'Menu::index');
if (session('role') == 'Root') {
    $routes->get('/menu/(:any)', 'Menu::index/$1');
}
$routes->post('/menu/add', 'Menu::add');
$routes->post('/menu/update', 'Menu::update');
$routes->post('/menu/update_check', 'Menu::update_check');
$routes->post('/menu/copy', 'Menu::copy');
$routes->post('/menu/delete', 'Menu::delete');

// options
$routes->get('/options', 'Options::index');
if (session('role') == 'Root') {
    $routes->get('/options/(:any)', 'Options::index/$1');
}
$routes->post('/options/add', 'Options::add');
$routes->post('/options/update', 'Options::update');
$routes->post('/options/delete', 'Options::delete');

// settings
$routes->get('/settings', 'Settings::index');
$routes->post('/settings/update', 'Settings::update');

// tps
$routes->get('/tps', 'Tps::index');
$routes->post('/tps/add', 'Tps::add');
$routes->post('/tps/update', 'Tps::update');
$routes->post('/tps/delete', 'Tps::delete');

// partai
$routes->get('/partai', 'Partai::index');
$routes->post('/partai/add', 'Partai::add');
$routes->post('/partai/update', 'Partai::update');
$routes->post('/partai/delete', 'Partai::delete');

// caleg
$routes->get('/caleg', 'Caleg::index');
$routes->get('/caleg/(:any)', 'Caleg::index/$1');
$routes->post('/caleg/add', 'Caleg::add');
$routes->post('/caleg/update', 'Caleg::update');
$routes->post('/caleg/delete', 'Caleg::delete');

// suara partai
$routes->get('/suara-partai/generate', 'Suara_partai::generate');
$routes->get('/suara-partai', 'Suara_partai::index');
$routes->get('/suara-partai/(:any)', 'Suara_partai::index/$1');

// suara caleg
$routes->get('/suara-caleg/generate', 'Suara_caleg::generate');
$routes->get('/suara-caleg', 'Suara_caleg::index');
$routes->get('/suara-caleg/(:any)', 'Suara_caleg::index/$1');
