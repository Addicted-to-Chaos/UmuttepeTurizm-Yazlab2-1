<?php

namespace App\Controllers;

class Home extends BaseController
{

    
    public function index() {
        
        $db = \Config\Database::connect();
         
        $query = $db->query('SELECT * FROM yolcular');
        $data['veriler'] = $query->getResult();

        return view('db_deneme', $data);
    }


    public function about(){
        return view('about');
    }
    public function dortYuzDort(){
        return view('404');
    }
    public function blog(){
        return view('blog');
    }
    public function booking(){
        return view('booking');
    }
    public function contact(){
        return view('contact');
    }
    public function destination(){
        return view('destination');
    }
    public function gallery(){
        return view('gallery');
    }
    public function guides(){
        return view('guides');
    }
    public function login(){
        return view('login');
    }
    public function package(){
        return view('package');
    }
    public function register(){
        return view('register');
    }
    public function services(){
        return view('services');
    }
    public function testimonial(){
        return view('testimonial');
    }
    public function tour(){
        return view('tour');
    }
}
