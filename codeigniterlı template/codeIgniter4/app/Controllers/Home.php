<?php  namespace App\Controllers;
use App\Models\UserModel;


use CodeIgniter\Controller;

class Home extends BaseController
{

    
    public function index() {
       
        return view('index');
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
        $session=session();
        if( $session->has('user') ){
            return view('booking');
        }else{
            return view('login');
        }
        
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
        
        $session=session();
        if( $session->has('user') ){
            return view('hesabim');
        }else{
            return view('login');
        }
    }
    public function packages(){
        return view('packages');
    }
    public function register(){
        $session=session();
        if( $session->has('user') ){
            return view('hesabim');
        }else{
            return view('register');
        }
    }
    public function hesabim(){
        $session=session();
        if( $session->has('user') ){
            return view('hesabim');
        }else{
            return view('login');
        }
    }
    public function biletlerim(){
        return view('biletlerim');
    }

    public function koltuksecimi(){
        return view('koltuksecimi');
    }

    public function seferekle(){
        return view('seferekle');
    }
    public function ilekle(){
        return view('ilekle');
    }
    public function biletlog(){
        return view('biletlog');
    }
    public function yolculist(){
        return view('yolculist');
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
    public function regConnect(){
        return view('regConnect');
    }
    public function payment(){
        return view('payment');
    }
    public function admin() {
        $session = session();
    $user = $session->get('user');
    
    // Admin kullanıcının e-posta adresi
    $adminEmail = 'admin@gmail.com';
    
    if($user && $user['Email'] === $adminEmail){
        return view('admin');
    } else {
        if($session->has('user')){
        return view('hesabim');
        }
        else{
            return view('index');
        }
    }
    }
    
    public function dbtest(){
        $db = \Config\Database::connect();

        $query = $db->query('SELECT * FROM yolcular');
        $data['veriler'] = $query->getResult();

        return view('db_deneme', $data);
    }


    public function buyticket(){
        return view('buyTicket');
    }
    
    public function voyage(){
        return view('voyage');
    }

    public function koltuk(){
        return view('koltuksecimi');
    }

    
    
}
