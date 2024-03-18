<?php $session=session();?>
<?php

if(isset($_GET['sefer_id']) && !empty($_GET['sefer_id'])) 
{
  $sefer_id = $_GET['sefer_id'];
}
else
{
  header("Location: voyage");
    exit;
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      background-color: #f2f2f2;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .content-wrapper{
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background-color: #f2f2f2;
      margin: -50px 0 0;
    }

    .bus-layout {
      background-color: #d9d9d9;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .row {
      display: flex;
      justify-content: space-around;
      margin-bottom: 20px;
    }

    .seat {
      width: 50px;
      height: 50px;
      margin: 5px;
      background-color: #bfbfbf;
      cursor: pointer;
      border-radius: 5px;
    }

    .driver-seat {
      width: 50px;
      height: 50px;
      margin: 5px;
      background-color: #3366cc;
      cursor: not-allowed;
      border-radius: 5px;
    }

    .empty-space {
      width: 50px;
      height: 50px;
      margin: 5px;
      visibility: hidden;
    }
    .empty-space2 {
      width: 20px;
      height: 20px;
      margin: 2px;
      visibility: hidden;
    }

    .door {
      width: 20px;
      height: 50px;
      margin: 5px;
      background-color: #996633;
      border-radius: 5px;
    }

    .steering-wheel {
      width: 20px;
      height: 20px;
      margin: 5px;
      background-color: #333;
      border-radius: 50%;
    }

    .seat.kadin {
      background-color: #dc54c7;
    }
    .seat.erkek {
      background-color: #3f4bee;
    }
    .seat.secili {
      background-color: #3abb47;
    }
    .seat.rezerve
    {
      background-color: #fcb603;
    }
    h2#hesap-basligi {
  color: #3498db;
    }
  </style>
  <title>Otobüs Koltuk Seçimi</title>
</head>
<body>
<h2 id="hesap-basligi" style="text-align:center;">KOLTUK SEÇİMİ</h2>

<?php

use App\Models\UserModelKoltuklar;
use App\Models\UsersModel;

$koltukModel = new UserModelKoltuklar();
$koltuklar = $koltukModel->where('Sefer_id',$sefer_id)->findAll();

$koltuklarArray=[];
$uzunluk = count($koltuklar);
$koltuklarArray = array(); // Yeni bir dizi oluştur

for ($i = 0; $i < $uzunluk; $i++) {
    $koltuklarArray[$i] = array(
        'Koltuk_no' => $koltuklar[$i]['Koltuk_no'],
        'Koltuk_durum' => $koltuklar[$i]['Durum'],
        'Yolcu_id' => $koltuklar[$i]['Yolcu_id']
    );
}
?>

<div class="content-wrapper">
<?php 
$bakiye = isset($session->user["Bakiye"]) ? $session->user["Bakiye"] : 0;
echo $bakiye . ' ₺';
$yolcuu_id=isset($session->user["Yolcu_id"]) ? $session->user["Yolcu_id"] : '';
?>

<div class="text-center mt-4">
        <a href="#" onclick="history.back();" class="back-btn">Geri Dön</a>
         </div>
         <form method="post" onsubmit="return validateForm()"> 
  <div class="bus-layout">
    <div class="row">
      <?php 
      $yolcuCinsiyeti = new UsersModel();
      
      //23
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[22]['Yolcu_id'])->first();

      if($koltuklarArray[22]['Koltuk_no'] == '23')
      {
        if($koltuklarArray[22]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-23" style="background-color: #3f4bee;"><p style="text-align: center;  ">23</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-23" style="background-color: #dc54c7;"><p style="text-align: center;  ">23</p></div>';
          }
        }
        else if($koltuklarArray[22]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-23"><p style="text-align: center;  ">23</p></div>';
        }
        else if($koltuklarArray[22]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-23"><input type="radio" name="seat" id="seat" value="23">23</div>';
        }
      }

      //20
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[19]['Yolcu_id'])->first();
        if($koltuklarArray[19]['Koltuk_no'] == '20')
      {
        if($koltuklarArray[19]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-20"style="background-color: #3f4bee;"><p style="text-align: center; ">20</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-20" style="background-color: #dc54c7;"><p style="text-align: center; ">20</p></div>';
          }
        }
        else if($koltuklarArray[19]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-20"><p style="text-align: center; ">20</p></div>';
        }
        else if($koltuklarArray[19]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-20"><input type="radio" name="seat" id="seat" value="20">20</div>';
        }
      }

      //17
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[16]['Yolcu_id'])->first();
      if($koltuklarArray[16]['Koltuk_no'] == '17')
      {
        if($koltuklarArray[16]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-17"style="background-color: #3f4bee;"><p style="text-align: center; ">17</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-17" style="background-color: #dc54c7;"><p style="text-align: center; ">17</p></div>';
          }
        }
        else if($koltuklarArray[16]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-17"><p style="text-align: center; ">17</p></div>';
        }
        else if($koltuklarArray[16]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-17"><input type="radio" name="seat" id="seat" value="17">17</div>';
        }
      }

      //16
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[15]['Yolcu_id'])->first();
      if($koltuklarArray[15]['Koltuk_no'] == '16')
      {
        if($koltuklarArray[15]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-16" style="background-color: #3f4bee;"><p style="text-align: center; ">16</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-16" style="background-color: #dc54c7;"><p style="text-align: center; ">16</p></div>';
          }
        }
        else if($koltuklarArray[15]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-16"><p style="text-align: center; ">16</p></div>';
        }
        else if($koltuklarArray[15]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-16"><input type="radio" name="seat" id="seat" value="16">16</div>';
        }
      }

      //13
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[12]['Yolcu_id'])->first();
      if($koltuklarArray[12]['Koltuk_no'] == '13')
      {
        if($koltuklarArray[12]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-13" style="background-color: #3f4bee;"><p style="text-align: center; ">13</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-13" style="background-color: #dc54c7;"><p style="text-align: center; ">13</p></div>';
          }
        }
        else if($koltuklarArray[12]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-13"><p style="text-align: center; ">13</p></div>';
        }
        else if($koltuklarArray[12]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-13"><input type="radio" name="seat" id="seat" value="13">13</div>';
        }
      }

      //10
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[9]['Yolcu_id'])->first();
      if($koltuklarArray[9]['Koltuk_no'] == '10')
      {
        if($koltuklarArray[9]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-10" style="background-color: #3f4bee;"><p style="text-align: center; ">10</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-10" style="background-color: #dc54c7;"><p style="text-align: center; ">10</p></div>';
          }
        }
        else if($koltuklarArray[9]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-10"><p style="text-align: center; ">10</p></div>';
        }
        else if($koltuklarArray[9]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-10"><input type="radio" name="seat" id="seat" value="10">10</div>';
        }
      }

      //7
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[15]['Yolcu_id'])->first();
      if($koltuklarArray[6]['Koltuk_no'] == '7')
      {
        if($koltuklarArray[6]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-7" style="background-color: #3f4bee;"><p style="text-align: center; ">7</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-7" style="background-color: #dc54c7;"><p style="text-align: center; ">7</p></div>';
          }
        }
        else if($koltuklarArray[6]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-7"><p style="text-align: center; ">7</p></div>';
        }
        else if($koltuklarArray[6]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-7"><input type="radio" name="seat" id="seat" value="7">7</div>';
        }
      }

      //4
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[3]['Yolcu_id'])->first();
      if($koltuklarArray[3]['Koltuk_no'] == '4')
      {
        if($koltuklarArray[3]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-4" style="background-color: #3f4bee;"><p style="text-align: center; ">4</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-4" style="background-color: #dc54c7;"><p style="text-align: center; ">4</p></div>';
          }
        }
        else if($koltuklarArray[3]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-4"><p style="text-align: center; ">4</p></div>';
        }
        else if($koltuklarArray[3]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-4"><input type="radio" name="seat" id="seat" value="4">4</div>';
        }
      }

      //1
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[0]['Yolcu_id'])->first();
      if($koltuklarArray[0]['Koltuk_no'] == '1')
      {
        if($koltuklarArray[0]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-1" style="background-color: #3f4bee;"><p style="text-align: center; ">1</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-1" style="background-color: #dc54c7;"><p style="text-align: center; ">1</p></div>';
          }
        }
        else if($koltuklarArray[0]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-1"><p style="text-align: center; ">1</p></div>';
        }
        else if($koltuklarArray[0]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-1"><input type="radio" name="seat" id="seat" value="1">1</div>';
        }
      }
      ?>
      <hr style="border-width: 3px; border-color: rgb(190, 192, 199);" >
      <img src="assets/img/direksiyon.png" height="60" width="60"/>
    </div>
    <div class="row2">
      <div class="empty-space2"></div>
    </div>
    <div class="row">
      <?php
      //24
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[23]['Yolcu_id'])->first();
        if($koltuklarArray[23]['Koltuk_no'] == '24')
      {
        if($koltuklarArray[23]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-24" style="background-color: #3f4bee;"><p style="text-align: center; ">24</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-24" style="background-color: #dc54c7;"><p style="text-align: center; ">24</p></div>';
          }
        }
        else if($koltuklarArray[23]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-24"><p style="text-align: center; ">24</p></div>';
        }
        else if($koltuklarArray[23]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat " id="seat-24"><input type="radio" name="seat" id="seat" value="24">24</div>';
        }
      }

      //21
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[20]['Yolcu_id'])->first();
        if($koltuklarArray[20]['Koltuk_no'] == '21')
      {
        if($koltuklarArray[20]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-21" style="background-color: #3f4bee;"><p style="text-align: center; ">21</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-21" style="background-color: #dc54c7;"><p style="text-align: center; ">21</p></div>';
          }
        }
        else if($koltuklarArray[20]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-21"><p style="text-align: center; ">21</p></div>';
        }
        else if($koltuklarArray[20]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-21"><input type="radio" name="seat" id="seat" value="21">21</div>';
        }
      }

      //18
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[17]['Yolcu_id'])->first();
        if($koltuklarArray[17]['Koltuk_no'] == '18')
      {
        if($koltuklarArray[17]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-18" style="background-color: #3f4bee;"><p style="text-align: center; ">18</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-18" style="background-color: #dc54c7;"><p style="text-align: center; ">18</p></div>';
          }
        }
        else if($koltuklarArray[17]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-18"><p style="text-align: center; ">18</p></div>';
        }
        else if($koltuklarArray[17]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-18"><input type="radio" name="seat" id="seat" value="18">18</div>';
        }
      }
      echo '<img src="assets/img/kapi.png" height="60" width="60"/>';

      //14
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[13]['Yolcu_id'])->first();
        if($koltuklarArray[13]['Koltuk_no'] == '14')
      {
        if($koltuklarArray[13]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-14" style="background-color: #3f4bee;"><p style="text-align: center; ">14</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-14" style="background-color: #dc54c7;"><p style="text-align: center; ">14</p></div>';
          }
        }
        else if($koltuklarArray[13]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-14"><p style="text-align: center; ">14</p></div>';
        }
        else if($koltuklarArray[13]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-14"><input type="radio" name="seat" id="seat" value="14">14</div>';
        }
      }

      //11
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[10]['Yolcu_id'])->first();
        if($koltuklarArray[10]['Koltuk_no'] == '11')
      {
        if($koltuklarArray[10]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-11" style="background-color: #3f4bee;"><p style="text-align: center; ">11</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-11" style="background-color: #dc54c7;"><p style="text-align: center; ">11</p></div>';
          }
        }
        else if($koltuklarArray[10]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-11"><p style="text-align: center; ">11</p></div>';
        }
        else if($koltuklarArray[10]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-11"><input type="radio" name="seat" id="seat" value="11">11</div>';
        }
      }

      //8
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[7]['Yolcu_id'])->first();
        if($koltuklarArray[7]['Koltuk_no'] == '8')
      {
        if($koltuklarArray[7]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-8" style="background-color: #3f4bee;"><p style="text-align: center; ">8</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-8" style="background-color: #dc54c7;"><p style="text-align: center; ">8</p></div>';
          }
        }
        else if($koltuklarArray[7]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-8"><p style="text-align: center; ">8</p></div>';
        }
        else if($koltuklarArray[7]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-8"><input type="radio" name="seat" id="seat" value="8">8</div>';
        }
      }

      //5
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[4]['Yolcu_id'])->first();
        if($koltuklarArray[4]['Koltuk_no'] == '5')
      {
        if($koltuklarArray[4]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-5" style="background-color: #3f4bee;"><p style="text-align: center; ">5</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-5" style="background-color: #dc54c7;"><p style="text-align: center; ">5</p></div>';
          }
        }
        else if($koltuklarArray[4]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-5"><p style="text-align: center; ">5</p></div>';
        }
        else if($koltuklarArray[4]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-5"><input type="radio" name="seat" id="seat" value="5">5</div>';
        }
      }

      //2
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[1]['Yolcu_id'])->first();
        if($koltuklarArray[1]['Koltuk_no'] == '2')
      {
        if($koltuklarArray[1]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-2" style="background-color: #3f4bee;"><p style="text-align: center; ">2</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-2" style="background-color: #dc54c7;"><p style="text-align: center; ">2</p></div>';
          }
        }
        else if($koltuklarArray[1]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-2"><p style="text-align: center; ">2</p></div>';
        }
        else if($koltuklarArray[1]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-2"><input type="radio" name="seat" id="seat" value="2">2</div>';
        }
      }
      echo '<hr>';
      echo '<img src="assets/img/kapi.png" height="60" width="60"/>';
      ?>
    </div>
    <div class="row">
      <?php
      //25
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[24]['Yolcu_id'])->first();
        if($koltuklarArray[24]['Koltuk_no'] == '25')
      {
        if($koltuklarArray[24]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-25" style="background-color: #3f4bee;"><p style="text-align: center; ">25</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-25" style="background-color: #dc54c7;"><p style="text-align: center; ">25</p></div>';
          }
        }
        else if($koltuklarArray[24]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-25"><p style="text-align: center; ">25</p></div>';
        }
        else if($koltuklarArray[24]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-25"><input type="radio" name="seat" id="seat" value="25">25</div>';
        }
      }

      //22
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[21]['Yolcu_id'])->first();
        if($koltuklarArray[21]['Koltuk_no'] == '22')
      {
        if($koltuklarArray[21]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-22" style="background-color: #3f4bee;"><p style="text-align: center; ">22</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-22" style="background-color: #dc54c7;"><p style="text-align: center; ">22</p></div>';
          }
        }
        else if($koltuklarArray[21]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-22"><p style="text-align: center; ">22</p></div>';
        }
        else if($koltuklarArray[21]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-22"><input type="radio" name="seat" id="seat" value="22">22</div>';
        }
      }

      //19
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[18]['Yolcu_id'])->first();
        if($koltuklarArray[18]['Koltuk_no'] == '19')
      {
        if($koltuklarArray[18]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-19" style="background-color: #3f4bee;"><p style="text-align: center; ">19</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-19" style="background-color: #dc54c7;"><p style="text-align: center; ">19</p></div>';
          }
        }
        else if($koltuklarArray[18]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-19"><p style="text-align: center; ">19</p></div>';
        }
        else if($koltuklarArray[18]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-19"><input type="radio" name="seat" id="seat" value="19">19</div>';
        }
      }
      echo '<img src="assets/img/kapi.png" height="60" width="60"/>';

      //15
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[14]['Yolcu_id'])->first();
        if($koltuklarArray[14]['Koltuk_no'] == '15')
      {
        if($koltuklarArray[14]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-15" style="background-color: #3f4bee;"><p style="text-align: center; ">15</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-15" style="background-color: #dc54c7;"><p style="text-align: center; ">15</p></div>';
          }
        }
        else if($koltuklarArray[14]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-15"><p style="text-align: center; ">15</p></div>';
        }
        else if($koltuklarArray[14]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-15"><input type="radio" name="seat" id="seat" value="15">15</div>';
        }
      }

      //12
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[11]['Yolcu_id'])->first();
        if($koltuklarArray[11]['Koltuk_no'] == '12')
      {
        if($koltuklarArray[11]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-12" style="background-color: #3f4bee;"><p style="text-align: center; ">12</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-12" style="background-color: #dc54c7;"><p style="text-align: center; ">12</p></div>';
          }
        }
        else if($koltuklarArray[11]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-12"><p style="text-align: center; ">12</p></div>';
        }
        else if($koltuklarArray[11]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-12"><input type="radio" name="seat" id="seat" value="12">12</div>';
        }
      }

      //9
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[8]['Yolcu_id'])->first();
        if($koltuklarArray[8]['Koltuk_no'] == '9')
      {
        if($koltuklarArray[8]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-9" style="background-color: #3f4bee;"><p style="text-align: center; ">9</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-9" style="background-color: #dc54c7;"><p style="text-align: center; ">9</p></div>';
          }
        }
        else if($koltuklarArray[8]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-9"><p style="text-align: center; ">9</p></div>';
        }
        else if($koltuklarArray[8]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-9"><input type="radio" name="seat" id="seat" value="9">9</div>';
        }
      }

      //6
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[5]['Yolcu_id'])->first();
        if($koltuklarArray[5]['Koltuk_no'] == '6')
      {
        if($koltuklarArray[5]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-6" style="background-color: #3f4bee;"><p style="text-align: center; ">6</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-6" style="background-color: #dc54c7;"><p style="text-align: center; ">6</p></div>';
          }
        }
        else if($koltuklarArray[5]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-6"><p style="text-align: center; ">6</p></div>';
        }
        else if($koltuklarArray[5]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-6"><input type="radio" name="seat" id="seat" value="6">6</div>';
        }
      }
      
      //3
      $yolcu = $yolcuCinsiyeti->where('Yolcu_id',$koltuklarArray[2]['Yolcu_id'])->first();
        if($koltuklarArray[2]['Koltuk_no'] == '3')
      {
        if($koltuklarArray[2]['Koltuk_durum'] == 'Satin Alindi')
        {
          if($yolcu['Cinsiyet']=='Erkek')
          {
            echo '<div class="seat rezerve" id="seat-3" style="background-color: #3f4bee;"><p style="text-align: center; ">3</p></div>';
          }
          else if($yolcu['Cinsiyet']=='Kadın')
          {
            echo '<div class="seat rezerve" id="seat-3" style="background-color: #dc54c7;"><p style="text-align: center; ">3</p></div>';
          }
        }
        else if($koltuklarArray[2]['Koltuk_durum']== 'Rezerve')
        {
          echo '<div class="seat rezerve" id="seat-3"><p style="text-align: center; ">3</p></div>';
        }
        else if($koltuklarArray[2]['Koltuk_durum'] == 'Musait')
        {
          echo '<div class="seat" id="seat-3"><input type="radio" name="seat" id="seat" value="3">3</div>';
        }
      }
      echo '<hr>';
      echo '<img src="assets/img/kapi.png" height="60" width="60"/>';
      ?>
    </div>
  </div>
  
  <select id="biletFiyat" name="biletFiyat" required>
    <option value="" selected disabled>Bilet Seçiniz</option>
    <?php
    
    use App\Models\UserModelSeferler;
    $seferModel = new UserModelSeferler();
    $sefer = $seferModel->where("Sefer_id", $sefer_id)->first();
    echo '<option value="' . $sefer['Fiyat'] . '"> Satın Al - ' . $sefer['Fiyat'] . '₺</option>';
    echo '<option value="200"> Rezerve Et - 200₺</option>';
  ?>
  </select>
  <?php echo '.<input type="hidden" name="bakiye" id="bakiye" value='.$bakiye.'>'?>
  <?php echo '.<input type="hidden" name="seferr" id="seferr" value='.$sefer_id.'>'?>
  <?php echo '.<input type="hidden" name="yolcuu" id="yolcuu" value='.$yolcuu_id.'>'?>

  <input type="submit" value="Bakiye ile Öde"formaction="<?= site_url('/bakiyeodeme') ?>"id="bakiyeOdeBtn">
  <input type="submit" value="Kart ile Öde"formaction="<?= site_url('/kartodeme') ?>">
  <input type="submit" value="Aracı ile Öde"formaction=" ">

  </form>
  <br>
  <div id="bakiyeYetersiz"  style="color:red; display: none;">Bakiye Yetersiz</div><br>
  <div id="error-message"  style="color:red; display: none;">Lütfen koltuk seçiniz.</div>
         </div>
</div>
<!--BU SCRİPTLERİ ELLEMEYİN (KAAN) -->
<script>
document.addEventListener("DOMContentLoaded", function() {
  var divElements = document.querySelectorAll("[id^='seat-']");
  
  divElements.forEach(function(divElement) {
    var checkbox = divElement.querySelector("input[type='radio']");
    
    divElement.addEventListener("click", function() {
      checkbox.checked = !checkbox.checked;
    });
  });
});
</script>
<script>
    function kontrolEt() {
        var secilenFiyat = document.getElementById("biletFiyat").value;
        var bakiye = parseInt(document.getElementById("bakiye").value);

        if (bakiye < secilenFiyat) {
            document.getElementById("bakiyeOdeBtn").disabled = true;
            document.getElementById("bakiyeYetersiz").style.display = "block";
        } else {
            document.getElementById("bakiyeOdeBtn").disabled = false;
            document.getElementById("bakiyeYetersiz").style.display = "none";
        }
    }

    document.addEventListener("DOMContentLoaded", kontrolEt);
    document.getElementById("biletFiyat").addEventListener("change", kontrolEt);
</script>
<script>
  function validateForm() {
    var seatSelected = false;
    var seatInputs = document.querySelectorAll('input[name="seat"]');
    
    seatInputs.forEach(function(input) {
      if (input.checked) {
        seatSelected = true;
      }
    });

    if (!seatSelected) {
      document.getElementById('error-message').style.display = 'block';
      return false; // Form submission blocked
    }

    return true; // Form submission allowed
  }
</script>
<!-- -->

<script>
   document.addEventListener('DOMContentLoaded', function () {
    const seats = document.querySelectorAll('.seat');
    let lastClickedSeatId = null; // Son tıklanan koltuğun ID'sini saklamak için değişken

    seats.forEach(seat => {
      seat.addEventListener('click', function () {
        if (!seat.classList.contains('driver-seat')) {
          if (lastClickedSeatId) {
            // Eğer zaten bir koltuk seçildiyse, seçilen koltuğun rengini eski haline getir
            const lastClickedSeat = document.getElementById(lastClickedSeatId);
            lastClickedSeat.classList.remove('secili');
          }
          // Son tıklanan koltuğun ID'sini güncelle
          lastClickedSeatId = this.id;
          seat.classList.add('secili');
        }
      });
    });
  });

    
  
</script>
</body>

</html>
