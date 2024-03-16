<?php  namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\UserModelSeferler;



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

        $email = \Config\Services::email();

        $email->setFrom('umuttepeTurizm@outlook.com', 'UmuttepeTurizm');
        $email->setTo(strval($data['Email']));
    
        $email->setSubject('Kayıt Başarılı');
        $email->setMessage('Umuttepe Turizm sitesine kaydınız başarıyla yapılmıştır. Eğer kayıt işlemini yapan siz değilseniz lütfen bizimle iletişime geçiniz.');

        $email->send();

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
        if ($result['Email'] == 'admin@gmail.com' && $result['Sifre'] == '123') {
            // Admin girişi yapıldığında
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
            return redirect()->to('admin'); // Admin sayfasına yönlendir
        } else {
            // Normal kullanıcı girişi yapıldığında
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
            return view('index', ['user' => $result]);
        }
    } else {
        return view('login');
    }
}
    
    
public function cikisYap() {
    $session=session();
    $session->destroy() ;
    return view('redirect');
}

public function sifreDegistir()
{
    $session = session();
    $userData = $session->get('user');

    if (!$userData) {
        return redirect()->to('login');
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

    $userData['Sifre'] = $newPassword;
    $session->set('user', $userData);

    $successMessage1 = 'Şifreniz başarıyla güncellendi.';

    return view('hesabim', ['successMessage' => $successMessage1]);
}


public function bilgileriGuncelle()
{
    // Oturumu başlat
    $session = session();

    // Kullanıcı verilerini oturumdan al
    $userData = $session->get('user');

    // Kullanıcı oturumu kontrolü
    if (!$userData) {
        return redirect()->to('login');
    }

    // Yeni bilgileri al
    $newAd = $this->request->getVar('newAdd');
    $newSoyad = $this->request->getVar('newSoyad');
    $newYas = $this->request->getVar('newYas');
    $newCinsiyet=$this->request->getVar('newCinsiyet');
    $newEmail = $this->request->getVar('newEmail');
    $newTc = $this->request->getVar('newTc');
    $newTelefon = $this->request->getVar('newTelefon');


    // Yeni bilgileri kullanıcı verilerine ekle
    $userData['Ad'] = $newAd;
    $userData['Soyad'] = $newSoyad;
    $userData['Yas'] = $newYas;
    $userData['Cinsiyet'] = $newCinsiyet;
    $userData['Email'] = $newEmail;
    $userData['Tc'] = $newTc;
    $userData['Telefon'] = $newTelefon;

    // Kullanıcı modelini yükle
    $model = new UsersModel();

    // Kullanıcı verilerini güncelle
    $updateData = [
        'Ad' => $newAd,
        'Soyad' => $newSoyad,
        'Yas' => $newYas,
        'Cinsiyet' => $newCinsiyet,
        'Email' => $newEmail,
        'Tc' => $newTc,
        'Telefon' => $newTelefon
    ];

    $model->where('Yolcu_id', $userData['Yolcu_id'])->set($updateData)->update();

    // Oturumu güncelle
    $session->set('user', $userData);

    // Başarı mesajı
    $successMessage2 = 'Bilgileriniz başarıyla güncellendi.';

    // Güncelleme sonrası kullanıcıyı hesabına yönlendir
    return view('hesabim', ['successMessage' => $successMessage2, 'user' => $userData]);
}

public function seferler()
{
   
    $model = new UserModelSeferler();
        $results = $model->where('Kalkis_sehir', $this->request->getVar('sehirNereden'))
                        ->where('Varis_sehir', $this->request->getVar('sehirNereye'))
                        ->where('Tarih', $this->request->getVar('departure-date'))
                        ->findAll();

                        $seferler = []; 

                        foreach ($results as $result) {
                            $sefer = [
                                'Sefer_id' => $result['Sefer_id'],
                                'Kalkis_sehir' => $result['Kalkis_sehir'],
                                'Varis_sehir' => $result['Varis_sehir'],
                                'Tarih' => $result['Tarih'],
                                'Kalkis_saat' => $result['Kalkis_saat'],
                                'Varis_saat' => $result['Varis_saat'],
                                'Peron_no' => $result['Peron_no'],
                                'Plaka' => $result['Plaka'],
                                'Kapasite'=> $result['Kapasite'],
                                'Dolu_koltuk'=> $result['Dolu_koltuk'],
                                'Bos_koltuk'=> $result['Bos_koltuk'],
                                'Fiyat'=> $result['Fiyat']
                            ];
                            $seferler[] = $sefer; 
                        }
                    
                        $data['seferler'] = $seferler; 
                    
                        return view('voyage', $data); 

}

 }

 ?>