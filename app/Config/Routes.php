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
    $routes->get('members', 'MemberController::index');
    $routes->get('karir', 'Karir::index');
    $routes->get('kontak', 'ContactController::index');
    $routes->get('contact', 'ContactController::index');
});