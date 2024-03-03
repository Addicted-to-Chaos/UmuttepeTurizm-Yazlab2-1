<?php

use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */


    $routes->get('/', 'Home::index');
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

