<?php

use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */


    $routes->get('/', 'Home::index');
    $routes->get('/hesabim', 'Home::hesabim');
    $routes->get('/biletlerim', 'Home::biletlerim');
    $routes->get('/koltuksecimi', 'Home::koltuksecimi');
    $routes->get('/about', 'Home::about');
    $routes->get('/404', 'Home::dortYuzDort');
    $routes->get('/blog', 'Home::blog');
    $routes->get('/booking', 'Home::booking');
    $routes->get('/contact', 'Home::contact');
    $routes->get('/destination', 'Home::destination');
    $routes->get('/gallery', 'Home::gallery');
    $routes->get('/guides', 'Home::guides');
    $routes->get('/login', 'Home::login');
    $routes->get('/packages', 'Home::packages');
    $routes->get('/register', 'Home::register');
    $routes->get('/services', 'Home::services');
    $routes->get('/testimonial', 'Home::testimonial');
    $routes->get('/tour', 'Home::tour');
    $routes->post('/kayitOl', 'User::kayitOl');
    $routes->get('/dbtest', 'Home::dbtest'); #veritabanının test sayfası
    $routes->post('/girisYap', 'User::girisYap');
    $routes->get('/cikisYap', 'User::cikisYap');
    $routes->get('/packages', 'User::packages');
    $routes->post('/sifreDegistir' ,'User::sifreDegistir');
    $routes->post('/bilgileriGuncelle' ,'User::bilgileriGuncelle');
    