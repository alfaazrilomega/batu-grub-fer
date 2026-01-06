<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->addRedirect('/', 'id');
// Login routes
$routes->get('login', 'Admin\AuthController::login');
$routes->post('login', 'Admin\AuthController::processLogin');
$routes->get('logout', 'Admin\AuthController::logout');

// Admin routes group
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    // Dashboard
    $routes->get('dashboard', 'Admin\DashboardController::index');
    
    // Anggota
    $routes->get('anggota', 'Admin\AnggotaController::index');
    $routes->get('anggota/tambah', 'Admin\AnggotaController::tambah');
    $routes->post('anggota/tambah', 'Admin\AnggotaController::proses_tambah');
    $routes->get('anggota/edit/(:num)', 'Admin\AnggotaController::edit/$1');
    $routes->put('anggota/update/(:num)', 'Admin\AnggotaController::proses_edit/$1'); 
    $routes->get('anggota/delete/(:num)', 'Admin\AnggotaController::delete/$1');

    // Artikel - ROUTES DIPERBARUI
    $routes->get('artikel', 'Admin\ArtikelController::index');
    $routes->get('artikel/tambah', 'Admin\ArtikelController::tambah');
    $routes->post('artikel/tambah', 'Admin\ArtikelController::proses_tambah');
    $routes->get('artikel/edit/(:num)', 'Admin\ArtikelController::edit/$1');
    $routes->put('artikel/update/(:num)', 'Admin\ArtikelController::proses_edit/$1'); // Diubah dari POST ke PUT
    $routes->get('artikel/delete/(:num)', 'Admin\ArtikelController::delete/$1');
    
    // Komoditas
    $routes->get('komoditas', 'Admin\KomoditasController::index');
    $routes->get('komoditas/tambah', 'Admin\KomoditasController::tambah');
    $routes->post('komoditas/tambah', 'Admin\KomoditasController::proses_tambah');
    $routes->get('komoditas/edit/(:num)', 'Admin\KomoditasController::edit/$1');
    $routes->put('komoditas/update/(:num)', 'Admin\KomoditasController::proses_edit/$1');
    $routes->get('komoditas/delete/(:num)', 'Admin\KomoditasController::delete/$1');
    
    // Karir
    $routes->get('karir', 'Admin\KarirController::index');
    $routes->get('karir/tambah', 'Admin\KarirController::tambah');
    $routes->post('karir/tambah', 'Admin\KarirController::proses_tambah');
    $routes->get('karir/edit/(:num)', 'Admin\KarirController::edit/$1');
    $routes->put('karir/update/(:num)', 'Admin\KarirController::proses_edit/$1');
    $routes->get('karir/delete/(:num)', 'Admin\KarirController::delete/$1');
    
    // Lowongan
    $routes->get('lowongan', 'Admin\LowonganController::index');
    $routes->get('lowongan/tambah', 'Admin\LowonganController::tambah');
    $routes->post('lowongan/tambah', 'Admin\LowonganController::proses_tambah');
    $routes->get('lowongan/edit/(:num)', 'Admin\LowonganController::edit/$1');
    $routes->put('lowongan/update/(:num)', 'Admin\LowonganController::proses_edit/$1');
    $routes->get('lowongan/delete/(:num)', 'Admin\LowonganController::delete/$1');
    
    // Slider
    $routes->get('slider', 'Admin\SliderController::index');
    $routes->get('slider/tambah', 'Admin\SliderController::tambah');
    $routes->post('slider/tambah', 'Admin\SliderController::proses_tambah');
    $routes->get('slider/edit/(:num)', 'Admin\SliderController::edit/$1');
    $routes->put('slider/update/(:num)', 'Admin\SliderController::proses_edit/$1');
    $routes->get('slider/delete/(:num)', 'Admin\SliderController::delete/$1');
    
    // Tentang - SECTION UPDATE
    $routes->get('tentang', 'Admin\TentangController::index');
    $routes->get('tentang/edit', 'Admin\TentangController::edit');
    $routes->put('tentang/update', 'Admin\TentangController::proses_edit');
    
    // Kontak - SECTION UPDATE
    $routes->get('kontak', 'Admin\KontakController::index');
    $routes->get('kontak/edit', 'Admin\KontakController::edit');
    $routes->put('kontak/update', 'Admin\KontakController::proses_edit');
    
    // Meta
    $routes->get('meta', 'Admin\MetaController::index');
    $routes->get('meta/tambah', 'Admin\MetaController::tambah');
    $routes->post('meta/tambah', 'Admin\MetaController::proses_tambah');
    $routes->get('meta/edit/(:num)', 'Admin\MetaController::edit/$1');
    $routes->put('meta/update/(:num)', 'Admin\MetaController::proses_edit/$1');
    $routes->get('meta/delete/(:num)', 'Admin\MetaController::delete/$1');
});

$routes->group('{locale}', static function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('profil-perusahaan', 'Profil::index');
    
    $routes->get('berita', 'Berita::index');
    
    // FIX PENTING: Tambahkan /$1 di akhir controller method
    // (:segment) akan ditangkap dan diteruskan sebagai parameter ke method detail()
    $routes->get('berita/(:segment)', 'Berita::detail/$1');

    $routes->get('members', 'MemberController::index');
    $routes->get('karir', 'Karir::index');
    $routes->get('kontak', 'ContactController::index');
    $routes->get('contact', 'ContactController::index');
    
    // Ini sudah benar
    $routes->get('karir/detail/(:segment)', 'Karir::detail/$1');
    $routes->get('komoditas/(:segment)', 'CommodityDetailController::detail/$1');
});