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
        
        $session=session();
        if( $session->has('user') ){
            return view('biletlerim');
        }else{
            return view('index');
        }
    }

    public function koltuksecimi(){
        return view('koltuksecimi');
    }

    public function seferekle(){
        $session = session();
        $user = $session->get('user');
        
        $adminEmail = 'admin@gmail.com';
        
        if($user && $user['Email'] === $adminEmail){
            return view('seferekle');

        } else {
            if($session->has('user')){
            return view('hesabim');
            }
            else{
                return view('index');
            }
        }
    }
    public function ilekle(){
        $session = session();
        $user = $session->get('user');
        
        $adminEmail = 'admin@gmail.com';
        
        if($user && $user['Email'] === $adminEmail){
            return view('ilekle');
        } else {
            if($session->has('user')){
            return view('hesabim');
            }
            else{
                return view('index');
            }
        }
    }
    public function biletlog(){
        $session = session();
    $user = $session->get('user');
    
    $adminEmail = 'admin@gmail.com';
    
    if($user && $user['Email'] === $adminEmail){
        return view('biletlog');
    } else {
        if($session->has('user')){
        return view('hesabim');
        }
        else{
            return view('index');
        }
    }
    }
    public function yolculist(){
        $session = session();
    $user = $session->get('user');
    
    $adminEmail = 'admin@gmail.com';
    
    if($user && $user['Email'] === $adminEmail){
        return view('yolculist');

    } else {
        if($session->has('user')){
        return view('hesabim');
        }
        else{
            return view('index');
        }
    }
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
        $session=session();
        if( $session->has('user') ){
            return view('payment');
        }else{
            
            return view('index');
        }
        
    }
    public function admin() {
    $session = session();
    $user = $session->get('user');
    
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

        $session=session();
        if( $session->has('user') ){
            return view('voyage');
        }else{
            $message='Bilet satın almak için lütfen giriş yapınız';
            return view('buyticket',['message' => $message]);
        }
    }

    public function koltuk(){
        
        $session=session();
        if( $session->has('user') ){
            return view('koltuksecimi');
        }else{
            $message='Bilet satın almak için lütfen giriş yapınız';
            return view('buyticket',['message' => $message]);
        }
            
            
    }
    

    
    
}
