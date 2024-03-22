<?php $session=session();
use Endroid\QrCode\Writer\SvgWriter;
use Endroid\QrCode\Writer\Result\SvgResult;
use App\Models\UserModeliller; 
use App\Models\UserModelBiletler;

require "vendor/autoload.php";
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
?>
<?php
        use App\Models\UsersModel;

        $yolcuu_id=isset($session->user["Yolcu_id"]) ? $session->user["Yolcu_id"] : '';
       
        $yolcuModel=new UsersModel();
        $yolcu=$yolcuModel->where('Yolcu_id',$yolcuu_id)->first();
        $bakiye=$yolcu['Bakiye'];
        ?>

<html>
<head>
<style>
* {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #3498db;
            text-align: center;
        }




.container .item {
  width: 48%;
  float: left;
  padding: 0 20px;
  background: #fff;
  overflow: hidden;
  margin: 10px
}
.container .item-right, .container .item-left {
  float: left;
  padding: 20px 
}

.container .item-left {
  width: 71%;
  padding: 34px 0px 19px 46px;
  border-left: 3px dotted #999;
} 

.container .item-right {
    float: left;
    padding: 20px;
    margin-right: -10px; /* Sağ tarafa olan uzaklık */
}


.container .item-left .sce .icon, .container .item-left .sce p,
.container .item-left .loc .icon, .container .item-left .loc p{
    float: left;
    word-spacing: 5px;
    letter-spacing: 1px;
    color: #888;
    margin-bottom: 10px;
}



        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
            position: relative;
        }


        .logout-container {
            position: absolute;
            top: 10px;
            right: 20px;
        }

        form {
            max-width: 400px;
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
        }



        a {
            text-decoration: none;
            padding: 10px;
            color: #fff;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
            font-size: 16px;
        }

        a:hover {

        }


        .left-menu {
    position: fixed;
    left: 0;
    top: 0;
    height: 100%;
    width: 200px;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 20px;
    border-right: 2px solid #ddd; 
}

.menu-container {
    border: 1px solid #ddd; 
    border-radius: 5px; 
    overflow: hidden;
}

.left-menu a.active {
    color: #1C357C; 
}


.menu-item {
    padding: 10px;
}


.left-menu a {
    text-decoration: none;
    padding: 10px;
    color: #333;
    width: 100%;
    text-align: center;
}

.left-menu a:hover {

}

.left-menu hr {
    width: 80%;
    border: 0.5px solid #ddd;
    margin: 5px 0;
}

.content-wrapper {
    margin-left: 200px;
}


h2#hesap-basligi {
  color: #1C357C;
    }

    .cancel-button {
    background-color: #F25454  ; /* Kırmızı arka plan */
    color: #fff; /* Beyaz metin rengi */
    border: none; /* Kenarlık yok */
    padding: 5px 5px; /* Buton içi boşluk */
    width: 85px;
    margin-top: -43px;
    margin-left: 250px;
    border-radius: 5px; /* Yuvarlatılmış kenarlar */
    cursor: pointer; /* İmleç tipi: el işareti */
}



.cancel-button:hover {
    background-color: #EC221C; /* Butona fare geldiğinde koyu kırmızı */
}

.buy-button {
    background-color: #95D480  ; /* Kırmızı arka plan */
    color: #fff; /* Beyaz metin rengi */
    border: none; /* Kenarlık yok */
    padding: 5px 5px; /* Buton içi boşluk */
    width: 160px;
    height:30px;
    margin-top: 47px;
    margin-left: 0px;
    border-radius: 5px; /* Yuvarlatılmış kenarlar */
    cursor: pointer; /* İmleç tipi: el işareti */
}
.buy-button:hover {
    background-color: #82B771; /* Butona fare geldiğinde koyu kırmızı */
}


</style>
</head>


<body>

<div class="left-menu">

<h2 id="hesap-basligi">Hesap</h2>
<br>
        <!-- Menu items go here -->
        <a class="menu-item" href="<?php echo site_url('/'); ?>">Ana Sayfa</a><hr>
        <?php 
       if (session()->get('user') && session()->get('user')['Email'] === 'admin@gmail.com'): ?>
 
    <a class="menu-item" href="<?php echo site_url('/admin'); ?>">Admin Paneli</a>
    <hr>
<?php endif; ?>
        <a href="hesabim" class="menu-item">Kullanıcı Bilgilerim </a>
        <hr>
        <a  href="biletlerim" class="menu-item  active">Bilet Bilgilerim</a>
        <hr>
        
        <a class="menu-item">Bakiye: <?php echo $bakiye?></a>
        <hr>
        
<a class="menu-item" href="<?php echo site_url('/cikisYap'); ?>">Çıkış Yap</a>
        <hr>
       
        
        
</div>

    <div class="content-wrapper">
        <div class="container">
            <h2 id="hesap-basligi" style="text-align:center;">BİLETLERİM</h2>

            <br><br>
            <!--BİLET 1-->
            <?php
            use App\Models\UserModelBiletLogView;
            $biletLogViewModel=new UserModelBiletLogView();
            $biletLogViews=$biletLogViewModel->where('Yolcu_Ad',$session->user["Ad"])->where('Yolcu_Soyad',$session->user["Soyad"])->findAll();

            if(empty($biletLogViews)){

              echo '<div><p style="color:red;">Kayıtlı bilet bulunmamaktadır.</p> </div>';
            }
            else{
                if (isset($message)) {
                    echo '<p id="errorMessage" style="color: green;">' . $message . '</p>';
                }
                if (isset($biletDurum)) {
                    echo '<p id="errorMessage" style="color: green;">' . $message . '</p>';
                }
                
                foreach ($biletLogViews as $bilet) 
                {
                
                  echo '<div class="item">';
                  
                  echo '<form method="post" action="'.site_url('/askiyaAl').'">';

                  echo '<div class="item-left">';
                  echo  '<h3>'.$bilet['Kalkis_Sehir'].' ->'.$bilet['Varis_Sehir'].'</h3><br>'; 
                  echo  '<hr>';
                  echo  '<div class="sce">';
                  echo  '<div class="icon">';
                  echo  '<i class="fa fa-table"></i>';
                  echo  '</div>';
                  echo  '</div>';
                  
                  echo  '<div class="fix"></div>';
                  echo  '<div class="loc">';
                  echo  '<div class="icon">';
                  echo  '<i class="fa fa-map-marker"></i>';
                  echo  '</div>';
                  if ($bilet['Durum'] != 'Rezerve') { 
                    echo   '<p><b>PNR Kodu: </b>'.$bilet['PNR_kodu'].'</p>';
                 }
                  echo    '<p>Sefer Tarihi: '.$bilet['Sefer_Tarihi'].'<br/>'; 
                  echo    'Saat:'.$bilet['Kalkis_Saat'].'<br>'; 
                  echo        'Peron no: '.$bilet['Peron_No'].'<br>'; 
                  echo        'Koltuk no: '.$bilet['Koltuk_no'].' <br>'; 
                  echo        'Bilet Durumu: '.$bilet['Durum'].' <br>';  
                  echo  '</div>';
                  if ($bilet['Durum'] == 'Rezerve') { 
                    echo '<input type="hidden" name="bilId" id="bilId"value='.$bilet['Bilet_id'].'>';
                    echo '<input type="hidden" name="seferrr" id="sefer"value='.$bilet['Sefer_id'].'>';
                    echo '<input type="hidden" name="koltukk" id="koltukk"value='.$bilet['Koltuk_no'].'>';
                    echo'<input class="buy-button" type="submit" id="satinAl" name="satinAl" value="Bileti Satın Al">';
                    echo '<input class="cancel-button" type="submit"value="İptal Et">';

                    
                 }
                 else
                 {
                    

                    $qr_Bilgi='PNR Kodu: '.$bilet['PNR_kodu']."\r\n" .'Saat:'.$bilet['Kalkis_Saat']. "\r\n". 'Yolcu:'.$bilet['Yolcu_Ad'].' '.$bilet['Yolcu_Soyad']."\r\n" .'Koltuk: '.$bilet['Koltuk_no'];
                    $qr_code=QrCode::create($qr_Bilgi)
                    ->setSize(100);
                    $writer=new SvgWriter;
                    $result=$writer->write($qr_code);
                    
                    header("Content-Type:".$result->getMimeType());
                    echo '<div id="qrCodeContainer" style="margin-left:250px; margin-top:-40px;">';
                    echo $result->getString();
                    echo '</div>';
                    echo '<input type="hidden" name="bilId" id="bilId"value='.$bilet['Bilet_id'].'>';
                    echo '<div class="item-right">';
                    echo '<input class="cancel-button" type="submit"value="İptal Et">';
                    echo '</div>';

                 }
                  echo  '<div class="fix"></div>';
                  echo'</div>'; 
                  echo '</form>';
                  echo '</div>';
                }
          }
            ?>
  
  
  
        </div>
    </div>

</body>

</html>