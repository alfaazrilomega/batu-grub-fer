<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->addRedirect('/', 'id');

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