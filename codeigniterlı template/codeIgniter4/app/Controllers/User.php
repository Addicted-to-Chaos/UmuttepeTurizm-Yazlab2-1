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
        $model = new UsersModel();
        $result = $model->where('Email', $this->request->getVar('Email'))
                        ->where('Sifre', $this->request->getVar('Sifre'))
                        ->first();
    
        $session = session();
        if ($result) {
            #$session->set('user', $result['Yolcu_id']);
            $session->set('user', [
                'Yolcu_id' => $result['Yolcu_id'],
                'Email' => $result['Email'],
                'Sifre' => $result['Sifre'],
                'Ad' => $result['Ad'],
                'Soyad' => $result['Soyad'],
                'Telefon' => $result['Telefon'],
                'Tc' => $result['Tc'],
                'Yas' => $result['Yas'],
                'Cinsiyet' => $result['Cinsiyet'],
            ]);
            return view('hesabim', ['user' => $result]);
        } else {
            return view('login');
        }
    }
    
    
public function cikisYap() {
    $session=session();
    $session->destroy() ;
    return view('index');
}

public function sifreDegistir()
{
    $session = session();
    $userData = $session->get('user');

    if (!$userData) {
        return redirect()->to('/login');
    }

    $currentPassword = $this->request->getVar('oldPass');
    $newPassword = $this->request->getVar('newPass');
    $confirmPassword = $this->request->getVar('reNewPass');

    if ($userData['Sifre'] !== $currentPassword) {
        return redirect()->back()->with('error', 'Mevcut şifreniz yanlış.');
    }

    if ($newPassword !== $confirmPassword) {
        return redirect()->back()->with('error', 'Yeni şifreler eşleşmiyor.');
    }
    $model = new UsersModel();
    $updateData = [
        'Sifre' => $newPassword
    ];

    $model->where('Yolcu_id', $userData['Yolcu_id'])->set($updateData)->update();

    // Oturumu güncelle
    $userData['Sifre'] = $newPassword;
    $session->set('user', $userData);

    $successMessage = 'Şifreniz başarıyla güncellendi.';

    // Mesajı view'a gönder
    return view('hesabim', ['successMessage' => $successMessage]);
}



 }