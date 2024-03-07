<?php  namespace App\Controllers;
use App\Models\UsersModel;


use CodeIgniter\Controller;

class User extends BaseController
{

    public function kayitOl(){

        $dogumTarihi = $this->request->getVar('Yas'); // Doğum tarihini al
        $yas = $this->hesaplaYas($dogumTarihi); // Yaş değerini hesapla
    
        $data = [
            'Email' => $this->request->getVar('Email'),
            'Sifre' => $this->request->getVar('Sifre'),
            'Ad' => $this->request->getVar('Ad'),
            'Soyad' => $this->request->getVar('Soyad'),
            'Telefon' => $this->request->getVar('Telefon'),
            'Tc' => $this->request->getVar('Tc'),
            'Yas' => $yas, // Yaş değerini kullan
            'Cinsiyet' => $this->request->getVar('Cinsiyet')
        ];
    
        $model = new UsersModel();
        $model->insert($data);

    return view('redirect');

    }
    
    // Yaş değerini hesaplayan fonksiyon
    private function hesaplaYas($dogumTarihi) {
        $bugununTarihi = date('Y-m-d');
        $yas = date_diff(date_create($dogumTarihi), date_create($bugununTarihi))->y;
        return $yas;
    }


    public function girisYap() {
    $model=new UsersModel();
    $result=$model->where('Email', $this->request->getVar('Email'))-> 
    where('Sifre', $this->request->getVar('Sifre'))->first();
   $session=session();
   if($result) {
    $session->setFlashdata('login','login Successfully');
    $session->set('user', $result['Yolcu_id']);
    return view('hesabim');
  }
  else {
    $session->setFlashdata('login','login Failed');
      return view('login');
  }
    }
public function cikisYap() {
    $session=session();
    $session->destroy() ;
    return view('index');
}


 /*   if($result!=null) {
      if($result['Sifre']==$this->request->getVar('Sifre'))
      {
        echo "<h1> Welcome,".$result['Yolcu_id'];
      }else {
        return view('login');
    }
    }
    else {
        return view('login');
    }
*/





 }