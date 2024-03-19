<?php  namespace App\Controllers;
use App\Models\UserModelBiletler;
use App\Models\UserModelBiletLog;
use App\Models\UserModelKoltuklar;
use App\Models\UsersModel;
use App\Models\UserModelSeferler;
use App\Models\UserModeliller;




use CodeIgniter\Controller;

class User extends BaseController
{

    private $db;
    public function __construct(){
        $this->db=db_connect();
    }
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
                'Bakiye' => $result['Bakiye']
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
                'Bakiye' => $result['Bakiye']
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
    $session = session();

    $userData = $session->get('user');

    if (!$userData) {
        return redirect()->to('login');
    }

    $newAd = $this->request->getVar('newAdd');
    $newSoyad = $this->request->getVar('newSoyad');
    $newYas = $this->request->getVar('newYas');
    $newCinsiyet=$this->request->getVar('newCinsiyet');
    $newEmail = $this->request->getVar('newEmail');
    $newTc = $this->request->getVar('newTc');
    $newTelefon = $this->request->getVar('newTelefon');


    $userData['Ad'] = $newAd;
    $userData['Soyad'] = $newSoyad;
    $userData['Yas'] = $newYas;
    $userData['Cinsiyet'] = $newCinsiyet;
    $userData['Email'] = $newEmail;
    $userData['Tc'] = $newTc;
    $userData['Telefon'] = $newTelefon;

    $model = new UsersModel();

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

public function ilekle()
{             
    $Plaka_kodu = $this->request->getVar('Plaka_kodu');
    $Sehir_adi = $this->request->getVar('Sehir_adi');

    // Plaka kodu seçilmediyse hata göster
    if(empty($Plaka_kodu)) {
        return redirect()->to(site_url('/ilekle'))->with('message', 'Lütfen bir plaka kodu seçin.');
    }

    $model = new UserModeliller();

    // Veritabanında belirli bir plaka kodunun kaydının olup olmadığını kontrol et
    $existingRecord = $model->where('Plaka_kodu', $Plaka_kodu)->first();

    if($existingRecord) {
        // Eğer plaka kodu zaten kayıtlı ise kullanıcıya bilgi ver
        return redirect()->to(site_url('/ilekle'))->with('message', 'Bu plaka kodu zaten kayıtlı.');
    }

    // Plaka kodu kayıtlı değilse ekleme işlemine devam et
    $updateData = [
        'Plaka_kodu' => $Plaka_kodu,
        'Sehir_adi' => $Sehir_adi      
    ];    

    // Oturumu güncelle
    $model->insert($updateData);    
    return view('ilekle');
}


public function eklesefer()
{
    $kalkisSehir = $this->request->getVar('seferKalkisSehir');
    $varisSehir = $this->request->getVar('seferVarisSehir');
    $seferTarih = $this->request->getVar('seferDate');
    $kalkisSaat=$this->request->getVar('departure-time');
    $varisSaat = $this->request->getVar('arrival-time');
    $seferPeron = $this->request->getVar('seferPeron');
    $seferPlaka = $this->request->getVar('seferPlaka');
    #$seferKapasite = $this->request->getVar('seferKapasite');
    $seferFiyat = $this->request->getVar('seferFiyat');


    $model = new UserModelSeferler();

    $updateData = [
        'Kalkis_sehir' => $kalkisSehir,
        'Varis_sehir' => $varisSehir,
        'Tarih' => $seferTarih,
        'Kalkis_saat' => $kalkisSaat,
        'Varis_saat' => $varisSaat,
        'Peron_no' => $seferPeron,
        'Plaka' => $seferPlaka,
        #'Kapasite' => $seferKapasite,
        'Fiyat' => $seferFiyat,
        'Dolu_koltuk'=>0
        #'Bos_koltuk'=>$seferKapasite

    ];
    $db = db_connect();

    $insertID = $model->insert($updateData);
    $procedureName = 'KoltuklariSefereEkle';
    $query = "CALL $procedureName(?)";
    $result = $this->db->query($query, [$insertID]);

    if ($result)
        {
            $message='Sefer başarıyla eklenmiştir';
        }
        else
        {
            $error = $this->db->error();
            $message = "Hata oluştu: " . $error['message'];
        }

    return view('seferekle',['message' => $message]);

}


public function koltuksec()
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
                    
                        return view('koltuksecimi', $data); 
}

public function kartodeme()
{    
    
    $yolcuId = $this->request->getVar('yolcuu');
    $seferId = $this->request->getVar('seferr');
    $koltukId = $this->request->getVar('seat');
    $pnrKodu = generatePNR(6);
    $biletFiyat = $this->request->getVar('biletFiyat');


    $data = [
        'yolcuId' => $yolcuId,
        'seferId' => $seferId,
        'koltukId' => $koltukId,
        'pnrKodu' => $pnrKodu,
        'biletFiyat' =>$biletFiyat
    ];
    return view('payment', $data); 
}

public function odendi()
 {
    
    $kartNumara = $this->request->getVar('kartNumara');
    $expireDate = $this->request->getVar('expireDate');
    $cvv = $this->request->getVar('cvv');
    $kartIsım = $this->request->getVar('kartIsım');
    $seferId = $this->request->getVar('seferId');
    $koltukId = $this->request->getVar('koltukId');
    $pnrKodu = $this->request->getVar('pnrKodu');
    $yolcuId = $this->request->getVar('yolcuId');
    $biletFiyat = $this->request->getVar('biletFiyat');

    $data = [
        'kartNumara' => $kartNumara,
        'expireDate' => $expireDate,
        'cvv' => $cvv,
        'kartIsım' => $kartIsım,
        'seferId' =>$seferId,
        'koltukId' =>$koltukId,
        'pnrKodu' =>$pnrKodu,
        'yolcuId'=>$yolcuId,
        'biletFiyat'=>$biletFiyat
    ];

    $biletData=[
        'PNR_kodu'=>$pnrKodu,
        'Yolcu_id'=>$yolcuId,
        'Sefer_id'=>$seferId,
        'Koltuk_id' => $koltukId
    ];

    $biletModel=new UserModelBiletler();
    $biletModel->insert($biletData);

    $seciliBilet=$biletModel->where('PNR_kodu',$pnrKodu)->first();

    $biletLogModel=new UserModelBiletLog();
    $durum='';
    $currentDateTime = date('Y-m-d H:i:s');
    if($biletFiyat>=300){
        $durum='Satin Alindi';
    }
    else{
        $durum='Rezerve';
    }
    $biletLogData=[
        'Bilet_id'=>$seciliBilet['Bilet_id'],
        'Durum'=>$durum,
        'Islem_tarihi'=>$currentDateTime
    ];
    $biletLogModel->insert($biletLogData);

    $koltukModel=new UserModelKoltuklar();
   
    $koltukdata=[
        'Yolcu_id'=>$yolcuId,
        'Durum'=>$durum
    ];
    $koltukModel->where('Koltuk_no',$koltukId)->where('Sefer_id',$seferId)->set($koltukdata)->update();
    


    return view ('odendi', $data);
}


public function bakiyeodeme()
{
    $kartNumara = $this->request->getVar('kartNumara');
    $expireDate = $this->request->getVar('expireDate');
    $cvv = $this->request->getVar('cvv');
    $kartIsım = $this->request->getVar('kartIsım');
    $seferId = $this->request->getVar('seferId');
    $koltukId = $this->request->getVar('koltukId');
    $pnrKodu = $this->request->getVar('pnrKodu');
    $yolcuId = $this->request->getVar('yolcuu');
    $biletFiyat = $this->request->getVar('biletFiyat');
    $bakiye=$this->request->getVar('bakiye');

    $data = [
        'kartNumara' => $kartNumara,
        'expireDate' => $expireDate,
        'cvv' => $cvv,
        'kartIsım' => $kartIsım,
        'seferId' =>$seferId,
        'koltukId' =>$koltukId,
        'pnrKodu' =>$pnrKodu,
        'yolcuId'=>$yolcuId,
        'biletFiyat'=>$biletFiyat,
        'bakiye'=>$bakiye
    ];

    
    $model = new UsersModel();
    $yanıt=$model->where('Yolcu_id',$yolcuId)->first();
    $bakiye=$yanıt['Bakiye']-$biletFiyat;
    $updateData=[
        'Bakiye'=>$bakiye
    ];

    $model->where('Yolcu_id', $yolcuId)->set($updateData)->update();


    if($biletFiyat>=300){
        $durum='Satin Alindi';
    }
    else{
        $durum='Rezerve';
    }
    $koltukModel=new UserModelKoltuklar();
   
    $koltukdata=[
        'Yolcu_id'=>$yolcuId,
        'Durum'=>$durum
    ];
    $koltukModel->where('Koltuk_no',$koltukId)->where('Sefer_id',$seferId)->set($koltukdata)->update();

    echo "Ödeme Yapıldı Yönlendiriliyorsunuz..."; 
    sleep(2);
    return view ('odendi', $data);
}

public function rezervasyonIptal(){

    $db = db_connect();

    $seferIdVar = $this->request->getVar('seferId');
    $biletIdVar = $this->request->getVar('pnrKodu');
    $yolcuIdVar  = $this->request->getVar('yolcuId');
    $koltukIdVar  = $this->request->getVar('koltukId');
    
    $bakiye=$this->request->getVar('bakiye');

    $procedureName = 'RezervasyonIptal';
    $query = "CALL $procedureName(?,?,?,?)";
    $result = $this->db->query($query, [$seferIdVar,$biletIdVar,$yolcuIdVar,$koltukIdVar]);

    if ($result)
        {
            $message='Sefer başarıyla eklenmiştir';
        }
        else
        {
            $error = $this->db->error();
            $message = "Hata oluştu: " . $error['message'];
        }

    return view('seferekle',['message' => $message]);

}

}



function generatePNR($length = 6) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $pnr = '';

    for ($i = 0; $i < $length; $i++) {
        $pnr .= $characters[rand(0, $charactersLength - 1)];
    }

    return $pnr;
}

 
 ?>