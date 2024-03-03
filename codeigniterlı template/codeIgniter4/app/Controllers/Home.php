<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('index'); //views içerisindeki index.html dosyasını index.php haline getirdim. Onu çağırıyor
                              //index.php dosyasına gitmek için bu da. Her sayfa için ayrı ayrı metot yazmak gerekli.
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
