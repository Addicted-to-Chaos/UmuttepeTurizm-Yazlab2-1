<?php

use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */


    $routes->get('/', 'Home::index');
    $routes->get('/hesabim', 'Home::hesabim');
    $routes->get('/biletlerim', 'Home::biletlerim');
    $routes->get('/koltuksecimi', 'Home::koltuksecimi');
    $routes->get('/seferekle', 'Home::seferekle');
    $routes->get('/ilekle', 'Home::ilekle');
    $routes->get('/yolculist', 'Home::yolculist');
    $routes->get('/biletlog', 'Home::biletlog');
    $routes->get('/about', 'Home::about');
    $routes->get('/contact', 'Home::contact');
    $routes->get('/destination', 'Home::destination');
    $routes->get('/login', 'Home::login');
    $routes->get('/packages', 'Home::packages');
    $routes->get('/register', 'Home::register');
    $routes->get('/services', 'Home::services');
    $routes->post('/kayitOl', 'User::kayitOl');
    $routes->get('/dbtest', 'Home::dbtest'); #veritabanının test sayfası
    $routes->post('/girisYap', 'User::girisYap');
    $routes->get('/cikisYap', 'User::cikisYap');
    $routes->get('/packages', 'User::packages');
    $routes->post('/sifreDegistir' ,'User::sifreDegistir');
    $routes->post('/bilgileriGuncelle' ,'User::bilgileriGuncelle');
    $routes->get('/payment', 'Home::payment');
    $routes->get('/admin', 'Home::admin');
    $routes->get('/buyTicket','Home::buyTicket');
    $routes->get('/voyage','Home::voyage');
    $routes->post('/seferler' ,'User::seferler');
    $routes->get('/koltuksecimi','Home::koltuksecimi');

    $routes->post('/ekleSefer' ,'User::ekleSefer');
    $routes->post('/ilekle' ,'User::ilekle');
    $routes->post('/koltuksec' ,'User::koltuksec');

    $routes->post('/kartodeme' ,'User::kartodeme');
    $routes->post('/bakiyeodeme' ,'User::bakiyeodeme');
    
    $routes->post('/odendi' ,'User::odendi');
    
    $routes->post('/rezervasyonIptal' ,'User::rezervasyonIptal');

    $routes->post('/askiyaAl' ,'User::rezervasyonIptal');
    $routes->post('/bakiyeEkle' ,'User::bakiyeEkle');
    $routes->post('/eklendi' ,'User::eklendi');
    $routes->post('/rezerveToBuy' ,'User::rezerveToBuy');

    

    





    