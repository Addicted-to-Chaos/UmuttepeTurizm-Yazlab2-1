<?php  namespace App\Controllers;
use App\Models\UserModelBiletler;
use App\Models\UserModelBiletLog;
use App\Models\UserModelKoltuklar;
use App\Models\UsersModel;
use App\Models\UserModelSeferler;
use App\Models\UserModeliller;

use App\Libraries\ShopierPayment;



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
            'Cinsiyet' => $this->request->getVar('Cinsiyet'),
            'Bakiye'=>0
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
    $session=session();
    if( $session->has('user') )
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
    else
    {
        $message='Bilet satın almak için lütfen giriş yapınız';
            return view('buyticket',['message' => $message]);
    }

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
    $topluSefer = $this->request->getPost('topluSefer');
    if(!empty($topluSefer)){
       
    $procedureName = 'SeferYenile';
    $query = "CALL $procedureName(?)";
    $result = $this->db->query($query, 5);

    if ($result)
        {
            $message='Seferler başarıyla eklenmiştir';
        }
        else
        {
            $error = $this->db->error();
            $message = "Hata oluştu: " . $error['message'];
        }

    return view('seferekle',['message' => $message]);
    }
    else{
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

    return view('seferekle',['message' => $message]);}

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
    $biletFiyat = $this->request->getVar('biletFiyat');


    $data = [
        'yolcuId' => $yolcuId,
        'seferId' => $seferId,
        'koltukId' => $koltukId,
        'biletFiyat' =>$biletFiyat
    ];
    $db = db_connect();


    if($biletFiyat==0)
    {
        //'Satin Alindi';
        $procedureName = 'biletal';
        $query = "CALL $procedureName(?,?,?)";
        $result = $this->db->query($query, [$yolcuId,$seferId,$koltukId]);
 
        return view ('odendi', $data);
    }
    else
    {
        return view('payment', $data); 
    }
}

public function odendi()
 {
    
    $kartNumara = $this->request->getVar('kartNumara');
    $expireDate = $this->request->getVar('expireDate');
    $cvv = $this->request->getVar('cvv');
    $kartIsım = $this->request->getVar('kartIsım');
    $seferId = $this->request->getVar('seferId');
    $koltukId = $this->request->getVar('koltukId');
    $yolcuId = $this->request->getVar('yolcuId');
    $biletFiyat = $this->request->getVar('biletFiyat');

    $data = [
        'kartNumara' => $kartNumara,
        'expireDate' => $expireDate,
        'cvv' => $cvv,
        'kartIsım' => $kartIsım,
        'seferId' =>$seferId,
        'koltukId' =>$koltukId,
        'yolcuId'=>$yolcuId,
        'biletFiyat'=>$biletFiyat
    ];
   
    if($biletFiyat>=300){
        //'Satin Alindi';
        $procedureName = 'biletal';
        $query = "CALL $procedureName(?,?,?)";
        $result = $this->db->query($query, [$yolcuId,$seferId,$koltukId]);

    }
    else{

        if($biletFiyat>0)
        {
        //'Rezerve';
        $procedureName = 'rezervasyon';
        $query = "CALL $procedureName(?,?,?)";
        $result = $this->db->query($query, [$yolcuId,$seferId,$koltukId]);
        }
        else
        {
            //'Güvenlik Kuvveti';
            $procedureName = 'biletal';
            $query = "CALL $procedureName(?,?,?)";
            $result = $this->db->query($query, [$yolcuId,$seferId,$koltukId]);
        }
    }


    return view ('odendi', $data);
}


public function bakiyeodeme()
{
    $seferId = $this->request->getVar('seferr');
    $koltukId = $this->request->getVar('seat');
    $yolcuId = $this->request->getVar('yolcuu');
    $biletFiyat = $this->request->getVar('biletFiyat');

    $data = [
        'seferId' =>$seferId,
        'koltukId' =>$koltukId,
        'yolcuId'=>$yolcuId,
        'biletFiyat'=>$biletFiyat
    ];

    
    $model = new UsersModel();
    $yanıt=$model->where('Yolcu_id',$yolcuId)->first();
    $bakiye=$yanıt['Bakiye']-$biletFiyat;
if($bakiye>$biletFiyat){

    $db = db_connect();


    if($biletFiyat>=300){
        //'Satin Alindi';
        $procedureName = 'biletal';
        $query = "CALL $procedureName(?,?,?)";
        $result = $this->db->query($query, [$yolcuId,$seferId,$koltukId]);
    }
    else{
        if($biletFiyat>0)
        {
        //'Rezerve';
        $procedureName = 'rezervasyon';
        $query = "CALL $procedureName(?,?,?)";
        $result = $this->db->query($query, [$yolcuId,$seferId,$koltukId]);
        
        }
        else
        {
            //'Güvenlik Kuvveti';
            $procedureName = 'biletal';
            $query = "CALL $procedureName(?,?,?)";
            $result = $this->db->query($query, [$yolcuId,$seferId,$koltukId]);
        }
    }
    
    $updateData=[
        'Bakiye'=>$bakiye
    ];
    $model->where('Yolcu_id', $yolcuId)->set($updateData)->update();

    

    return view ('odendi', $data);
}
else{
    $gonder=[
        'message'=>'Yetersiz Bakiye',
        'Sefer'=>$seferId
    ];
    return view('koltuksecimi',$gonder);
}
}

public function bakiyeEkle()
{    
    
    
    
    $session = session();

    $userData = $session->get('user');

    if (!$userData) {
        return redirect()->to('index');
    }
    else
    {
        $bakiyeEkleMiktar = $this->request->getVar('bakiyeekle');
        
    if($bakiyeEkleMiktar==0)
    {
        $messageBakiye='Lütfen geçerli bir miktar giriniz.';
        return view('hesabim',['messageBakiye' => $messageBakiye]);

    }
    else
    {
        return view('payment2', ['eklenecekBakiye' => $bakiyeEkleMiktar]); 
    }
    }

    


}

public function rezerveToBuy()
{    
    $session=session();
    if( $session->has('user') )
    { 
   
    
    $messageDurum="Bilet durumu değişmiştir.";
    return view('biletlerim',['biletdurum' => $messageDurum]);
    }
    else{
    return view('index');

    }
    
}
public function eklendi()
{    
    $session=session();
    if( $session->has('user') )
    { 
    $userData = $session->get('user');
    $model=new UsersModel();
    
    $a= $model->where('Yolcu_id', $userData['Yolcu_id'])->first();
    $bakiyeEkleMiktar=0;
    $bakiyeEkleMiktar = $this->request->getVar('eklenecekBakiye');
   
    $bakiye=$a['Bakiye']+$bakiyeEkleMiktar;
    $updateData = [
        'Bakiye' => $bakiye,
    ];
    

    $model->where('Yolcu_id', $userData['Yolcu_id'])->set($updateData)->update();
    $messageBakiye="Bakiyeniz başarıyla eklenmiştir.";
    return view('hesabim',['messageBakiye' => $messageBakiye]);
    }
    else{
    return view('index');

    }
    
}

public function rezervasyonIptal(){

    $db = db_connect();

    $biletId = $this->request->getVar('bilId');
    $request = service('request');
    $yol = $this->request->getVar('seferrr');
    $koltuk = $this->request->getVar('koltukk');


    $session=session();
if(!$request->getPost('satinAl'))
{
    
    $bakiye=$this->request->getVar('bakiye');

    $procedureName = 'Askiya_Al';
    $query = "CALL $procedureName(?)";
    $result = $this->db->query($query, [$biletId]);

    if ($result)
        {
            $messageIptal='Bilet iptal edilmiştir. Paranız bakiyenize eklenmiştir.';
        }
        else
        {
            $error = $this->db->error();
            $messageIptal = "Hata oluştu: " . $error['message'];
        }

    return view('biletlerim',['message' => $messageIptal]);}
else
{

    $procedureName = 'Askiya_Al';
    $query = "CALL $procedureName(?)";
    $result = $this->db->query($query, [$biletId]);

    $procedureName = 'biletal';
        $query = "CALL $procedureName(?,?,?)";
        $result = $this->db->query($query, [$session->user["Yolcu_id"],$yol,$koltuk]);

        $seferModel=new UserModelSeferler();
        $sseferId=$seferModel->where('Sefer_id',$yol)->first();
        $kalan=$sseferId['Fiyat']-200;
        return view('payment3', ['eklenecekBakiye' => $kalan]); 
}

}


}




 
 ?>