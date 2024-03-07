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
        
        return view('login');
    }
    public function package(){
        return view('package');
    }
    public function register(){
        return view('register');
    }

    public function insert(){
/*
$data=['registername'=>$this->request->getVar('registername'),
'registersurname'=>$this->request->getVar('registersurname'),
'registerbirthdate'=>$this->request->getVar('registerbirthdate'),
'registergender'=>$this->request->getVar('registergender'),
'registeremail'=>$this->request->getVar('registeremail'),
'registerid'=>$this->request->getVar('registerid'),
'registerphone'=>$this->request->getVar('registerphone'),
'registerpassword'=>$this->request->getVar('registerpassword')];
     $db=\Config\Database::connect();
$builder=$db->table('Yolcular');
$builder->insert($data);*/

      /*$validation=$this->validate([
      'registername'=>'required',
      'registersurname'=>'required',
      'registerbirthdate'=>'required',
      'registergender'=>'required',
      'registeremail'=>'required',
      'registerid'=>'required',
      'registerphone'=>'required',
      'registerpassword'=>'required'     
      
      ]);
      if(!$validation){
        return view('register',['validation'=>$this->validator]);
      }else{
        echo "successs";
      }*/

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

    public function dbtest(){
        $db = \Config\Database::connect();

        $query = $db->query('SELECT * FROM yolcular');
        $data['veriler'] = $query->getResult();

        return view('db_deneme', $data);
    }
}
