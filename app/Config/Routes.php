<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */



//  landing
$routes->get('/', 'Landing::index');
$routes->get('/total_suara', 'Landing::total_suara');
$routes->get('/kirka_per_kecamatan', 'Landing::kirka_per_kecamatan');
$routes->get('/kirka_per_kecamatan/(:any)', 'Landing::kirka_per_kecamatan/$1');
$routes->get('/caleg_pkb', 'Landing::caleg_pkb');
$routes->get('/kecamatan', 'Landing::kecamatan');
$routes->get('/kecamatan/(:any)', 'Landing::kecamatan/$1');
$routes->get('/kelurahan', 'Landing::kelurahan');
$routes->get('/kelurahan/(:any)/(:any)', 'Landing::kelurahan/$1/$2');
$routes->get('/bytps', 'Landing::bytps');
$routes->get('/bytps/(:any)/(:any)/(:any)', 'Landing::bytps/$1/$2/$3');
$routes->post('/suara_partai', 'Landing::suara_partai');
$routes->get('/login', 'Landing::login');
$routes->get('/logout', 'Landing::logout');
$routes->post('/auth', 'Landing::auth');
$routes->post('/logout', 'Landing::logout');
$routes->get('/suara_belum_masuk', 'Landing::suara_belum_masuk');
$routes->get('/suara_belum_masuk/(:any)/(:any)/(:any)/(:any)', 'Landing::suara_belum_masuk/$1/$2/$3/$4');
$routes->get('/c1_belum_masuk', 'Landing::c1_belum_masuk');
$routes->get('/c1_belum_masuk/(:any)/(:any)/(:any)', 'Landing::c1_belum_masuk/$1/$2/$3');
$routes->get('/suara_tertinggi', 'Landing::suara_tertinggi');
$routes->get('/suara_tertinggi/(:any)/(:any)/(:any)/(:any)', 'Landing::suara_tertinggi/$1/$2/$3/$4');
$routes->get('/suara_partai_dan_suara_jiwa', 'Landing::suara_partai_dan_suara_jiwa');
$routes->get('/suara_partai_dan_suara_jiwa/cetak_pdf/(:any)', 'Landing::cetak_pdf/$1');
$routes->get('/suara_partai_dan_suara_jiwa/(:any)', 'Landing::suara_partai_dan_suara_jiwa/$1');


// cetak
$routes->get('/cetak/excel', 'Cetak::excel');
$routes->get('/cetak/excel/(:any)', 'Cetak::excel/$1');

// wilayah
$routes->get('/wilayah/cetak_pdf/(:any)', 'Wilayah::cetak_pdf/$1');
$routes->get('/wilayah', 'Wilayah::index');
$routes->get('/wilayah/(:any)', 'Wilayah::index/$1');

// js
$routes->post('/js/get_kelurahan', 'Js::get_kelurahan');


$routes->get('/statistik', 'Landing::statistik');

// search
$routes->post('/indonesia', 'Search::indonesia');
$routes->post('/suara', 'Search::suara');



// home
$routes->get('/home', 'Home::index');

// reset
$routes->get('/reset_tps', 'Reset::reset_tps');
$routes->get('/reset_suara_partai', 'Reset::reset_suara_partai');
$routes->get('/reset_suara_caleg', 'Reset::reset_suara_caleg');


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
if (session('role') == 'Root') {
    $routes->get('/tps/(:any)/(:any)', 'Tps::index/$1/$2');
}
$routes->post('/tps/add', 'Tps::add');
$routes->post('/tps/update', 'Tps::update');
$routes->post('/tps/update_kirka', 'Tps::update_kirka');
$routes->post('/tps/update_saksi', 'Tps::update_saksi');
$routes->post('/tps/update_hp_saksi', 'Tps::update_hp_saksi');
$routes->post('/tps/update_dpt', 'Tps::update_dpt');
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

// user
$routes->get('/user', 'User::index');
$routes->get('/user/(:any)', 'User::index/$1');
$routes->post('/user/add', 'User::add');
$routes->post('/user/update', 'User::update');
$routes->post('/user/delete', 'User::delete');

// suara partai
// $routes->get('/suara-partai/generate', 'Suara_partai::generate');
$routes->get('/suara-partai', 'Suara_partai::index');
$routes->get('/suara-partai/(:any)/(:any)', 'Suara_partai::index/$1/$2');

// suara caleg
// $routes->get('/suara-caleg/generate', 'Suara_caleg::generate');
$routes->get('/suara-caleg', 'Suara_caleg::index');
$routes->get('/suara-caleg/(:any)', 'Suara_caleg::index/$1');

// penghitungan suara
$routes->get('/election', 'Election::index');
$routes->get('/election/(:num)', 'Election::index/$1');
$routes->post('/election/update_suara_partai', 'Election::update_suara_partai');
$routes->post('/election/update_suara_caleg', 'Election::update_suara_caleg');

// upload file
$routes->post('/upload_c1', 'Upload::upload_c1');
$routes->post('/upload_dokumen_d', 'Upload::upload_dokumen_d');


// Rekapitulasi
$routes->get('/kirka', 'Kirka\Kirka::index');
$routes->get('/kirka/by_tps', 'Kirka\Kirka::by_tps');
$routes->get('/kirka/sub_wilayah', 'Kirka\Kirka::sub_wilayah');
$routes->get('/kirka/sub_wilayah/(:any)/(:any)/(:any)', 'Kirka\Kirka::sub_wilayah/$1/$2/$3');
$routes->get('/kirka/download/(:any)/(:any)/(:any)', 'Kirka\Kirka::download/$1/$2/$3');
