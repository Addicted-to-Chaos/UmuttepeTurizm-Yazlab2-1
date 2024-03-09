<?php $session=session(); ?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hesabım</title>
    <style>

* {
  box-sizing: border-box;
  margin:0;
  padding:0;
}
body {
  background:#DDD;
  font-family: 'Inknut Antiqua', serif;
  font-family: 'Ravi Prakash', cursive;
  font-family: 'Lora', serif;
  font-family: 'Indie Flower', cursive;
  font-family: 'Cabin', sans-serif;
}
div.container {
  max-width: 1350px;
  margin: 0 auto;
  overflow: hidden
}
.upcomming {
  font-size: 45px;
  text-transform: uppercase;
  border-left: 14px solid rgba(255, 235, 59, 0.78);
  padding-left: 12px;
  margin: 18px 8px;
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
.container .item-right {
  padding: 79px 50px;
  margin-right: 20px;
  width: 25%;
  position: relative;
  height: 286px
}
.container .item-right .up-border, .container .item-right .down-border {
    padding: 14px 15px;
    background-color: #ddd;
    border-radius: 50%;
    position: absolute
}
.container .item-right .up-border {
  top: -8px;
  right: -35px;
}
.container .item-right .down-border {
  bottom: -13px;
  right: -35px;
}
.container .item-right .num {
  font-size: 60px;
  text-align: center;
  color: #111
}
.container .item-right .day, .container .item-left .event {
  color: #555;
  font-size: 20px;
  margin-bottom: 9px;
}
.container .item-right .day {
  text-align: center;
  font-size: 25px;
}
.container .item-left {
  width: 71%;
  padding: 34px 0px 19px 46px;
  border-left: 3px dotted #999;
} 
.container .item-left .title {
  color: #111;
  font-size: 34px;
  margin-bottom: 12px
}
.container .item-left .sce {
  margin-top: 5px;
  display: block
}
.container .item-left .sce .icon, .container .item-left .sce p,
.container .item-left .loc .icon, .container .item-left .loc p{
    float: left;
    word-spacing: 5px;
    letter-spacing: 1px;
    color: #888;
    margin-bottom: 10px;
}
.container .item-left .sce .icon, .container .item-left .loc .icon {
  margin-right: 10px;
  font-size: 20px;
  color: #666
}
.container .item-left .loc {display: block}
.fix {clear: both}
.container .item .tickets, .booked, .cancel{
    color: #fff;
    padding: 6px 14px;
    float: right;
    margin-top: 10px;
    font-size: 18px;
    border: none;
    cursor: pointer
}
.container .item .tickets {background: #777}
.container .item .booked {background: #3D71E9}
.container .item .cancel {background: #DF5454}
.linethrough {text-decoration: line-through}
@media only screen and (max-width: 1150px) {
  .container .item {
    width: 100%;
    margin-right: 20px
  }
  div.container {
    margin: 0 20px auto
  }
}
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
            position: relative;
        }
label {
    font-size: 18px; /* Adjust the size as needed */
}
        h1 {
            color: #3498db;
            text-align: center; 
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
            color: #3498db;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-row {
            margin-bottom: 15px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .form-column {
            width: calc(50% - 5px);
        }
        form input {
    font-size: 18px; /* Adjust the size as needed */
}

        .form-row-center {
            display: flex;
            justify-content: center;
        }

        button[type="submit"] {
            background-color: #3498db;
            color: #fff;
            width: 100%;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #2980b9;
        }


        a {
            text-decoration: none;
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
            font-size: 16px;
        }

        a:hover {
            background-color: #2980b9;
        }

        .logout-container {
            position: absolute;
            top: 0px;
            right: 20px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 700px;
            text-align: left;
        }

        .form-container {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.form-container form {
    width: 48%;
}

.form-container .form-row {
    flex-basis: 48%;
}

    </style>
</head>
<body>
  
    <div class="logout-container">
        <a href="<?php echo site_url('/cikisYap'); ?>">Çıkış Yap</a>
    </div>

    <h1>HESABIM</h1>
    <br>
    <div class="form-container">
        
    
        <form action="<?php echo base_url('/bilgileriGuncelle'); ?>" method="post" onsubmit="return bilgiKontrol()">

        <div class="form-row">
          <div class="form-column">
                <label for="Ad">Ad:</label>
                <input type="text" id="newAdd" name="newAdd" value="<?php echo isset($session->user["Ad"]) ? $session->user["Ad"] : ''; ?>" onkeydown="return /[a-zçğıüö]/i.test(event.key) || event.key === 'Backspace' || event.key === 'Delete' || event.key === 'ArrowLeft' || event.key === 'ArrowRight'" maxlength="20" >
            </div>
    
            <div class="form-column">
                <label for="Soyad">Soyad:</label>
                <input type="text" id="newSoyad" name="newSoyad" value="<?php echo isset($session->user["Soyad"]) ? $session->user["Soyad"] : ''; ?>" onkeydown="return /[a-zçğıüö]/i.test(event.key) || event.key === 'Backspace' || event.key === 'Delete' || event.key === 'ArrowLeft' || event.key === 'ArrowRight'" maxlength="20">
            </div>
        </div>
    
        <div class="form-row">
            <div class="form-column">
                <label for="Yas">Doğum Tarihi:</label>
                <input type="date" id="newYas" name="newYas" required>
            </div>
            <div class="form-column">
                <label for="Cinsiyet">Cinsiyet:</label>
                <select id="newCinsiyet" name="newCinsiyet" required>
                    <option value="<?php echo isset($session->user["Cinsiyet"]) ? $session->user["Cinsiyet"] : ''; ?>" disabled selected><?php echo isset($session->user["Cinsiyet"]) ? $session->user["Cinsiyet"] : ''; ?></option>
                    <option value="Erkek">Erkek</option>
                    <option value="Kadın">Kadın</option>
                </select>
            </div>
        </div>
    
        <div class="form-row">
            <div class="form-column">
                <label for="Email">E-posta:</label>
                <input type="email" id="newEmail" name="newEmail" value="<?php echo isset($session->user["Email"]) ? $session->user["Email"] : ''; ?>">
            </div>
    
            <div class="form-column">
                <label for="Tc">TC Kimlik No:</label>
                <input type="text" id="newTc" name="newTc" value="<?php echo isset($session->user["Tc"]) ? $session->user["Tc"] : ''; ?>" onkeydown="if (!(event.key === 'Backspace' || event.key === 'Delete' || event.key === 'ArrowLeft' || event.key === 'ArrowRight' || event.key === 'Tab' || (event.key >= '0' && event.key <= '9'))) event.preventDefault()" maxlength="11">
            </div>
        </div>
    
        <div class="form-row">
            <label for="Telefon">Telefon:</label>
            <input type="tel" id="newTelefon" name="newTelefon" value="<?php echo isset($session->user["Telefon"]) ? $session->user["Telefon"] : ''; ?>" onkeydown="if (!(event.key === 'Backspace' || event.key === 'Delete' || event.key === 'ArrowLeft' || event.key === 'ArrowRight' || event.key === 'Tab' || (event.key >= '0' && event.key <= '9'))) event.preventDefault()" maxlength="11">
        </div>
    
        <div class="form-row form-row-center">
        <?php if (isset($successMessage1)): ?>
          <p><?php echo $successMessage1; ?></p>
          <?php endif; ?>
            <button type="submit" name="guncelle">Bilgileri Güncelle</button>
        </div>
        <p id="errorMessage1" style="color: red;"></p>
    </form>
    
      <form action="<?php echo base_url('/sifreDegistir'); ?>" method="post" onsubmit="return sifreKontrol()">

          <div class="form-row">
            
                <label for="Password">Eski Şifre:</label>
                <input type="password" id="oldPass" name="oldPass">
    
                <label for="Password">Yeni Şifre:</label>
                <input type="password" id="newPass" name="newPass">

                <label for="Password">Yeni Şifre Yeniden:</label>
                <input type="password" id="reNewPass" name="reNewPass">
            </div>
    
        <div class="form-row form-row-center">
          <?php if (isset($successMessage2)): ?>
          <p><?php echo $successMessage2; ?></p>
          <?php endif; ?>
            <button type="submit" name="guncelle">Şifreyi Değiştir</button>
        </div>
        <p id="errorMessage2" style="color: red;"></p>
      </form>
      

    </div>
    
<br><br>
<HR>
<br><br>


    <div class="container">
  <h1>BİLETLERİM</h1>
<br>
  <!--BİLET 1-->
  <div class="item">
    <div class="item-right">
     <!-- koltuk no-->
     <p class="day">Koltuk</p>
      <h2 class="num">23</h2>
      <span class="up-border"></span>
      <span class="down-border"></span>
    </div>
    
    <div class="item-left">
      <h2>Ankara -> Bursa </h2><br>
      <hr>
      <div class="sce">
        <div class="icon">
          <i class="fa fa-table"></i>
        </div>

        <p><b>PNR Kodu:</b> 12345678</p>
        <p></p>
      </div>
      <div class="fix"></div>
      <div class="loc">
        <div class="icon">
          <i class="fa fa-map-marker"></i>
        </div>
        <p>Sefer Tarihi : 2024-03-29<br/> Saat: 12:00:00 <br> Peron no: 30 <br> Bilet Durumu : Rezerve <br> İşlem Tarihi: 2024-03-08 17:05:04</p>
      </div>
      <div class="fix"></div>
    </div> 
  </div> <!-- bilet 1 son -->
  
  <!--BİLET 2-->
  <div class="item">
    <div class="item-right">
     <!-- koltuk no-->
     <p class="day">Koltuk</p>
      <h2 class="num">23</h2>
      <span class="up-border"></span>
      <span class="down-border"></span>
    </div>
    
    <div class="item-left">
      <h2>Ankara -> Bursa </h2><br>
      <hr>
      <div class="sce">
        <div class="icon">
          <i class="fa fa-table"></i>
        </div>

        <p><b>PNR Kodu:</b> 12345678</p>
        <p></p>
      </div>
      <div class="fix"></div>
      <div class="loc">
        <div class="icon">
          <i class="fa fa-map-marker"></i>
        </div>
        <p>Sefer Tarihi : 2024-03-29<br/> Saat: 12:00:00 <br> Peron no: 30 <br> Bilet Durumu : Rezerve <br> İşlem Tarihi: 2024-03-08 17:05:04</p>
      </div>
      <div class="fix"></div>
    </div> 
  </div> <!-- bilet 2 son -->


   <!--BİLET 3-->
   <div class="item">
    <div class="item-right">
     <!-- koltuk no-->
     <p class="day">Koltuk</p>
      <h2 class="num">23</h2>
      <span class="up-border"></span>
      <span class="down-border"></span>
    </div>
    
    <div class="item-left">
      <h2>Ankara -> Bursa </h2><br>
      <hr>
      <div class="sce">
        <div class="icon">
          <i class="fa fa-table"></i>
        </div>

        <p><b>PNR Kodu:</b> 12345678</p>
        <p></p>
      </div>
      <div class="fix"></div>
      <div class="loc">
        <div class="icon">
          <i class="fa fa-map-marker"></i>
        </div>
        <p>Sefer Tarihi : 2024-03-29<br/> Saat: 12:00:00 <br> Peron no: 30 <br> Bilet Durumu : Rezerve <br> İşlem Tarihi: 2024-03-08 17:05:04</p>
      </div>
      <div class="fix"></div>
    </div> 
  </div> <!-- bilet 3 son -->
  
</div>
</div>



</body>

<script>
  function sifreKontrol() 
  {
    var phpOldPass = "<?php echo isset($session->user['Sifre']) ? $session->user['Sifre'] : ''; ?>";
    var oldPass = document.getElementById('oldPass').value;
    var newPass = document.getElementById('newPass').value;
    var reNewPass = document.getElementById('reNewPass').value;
    var errorMessages = "";

    if (phpOldPass !== oldPass) {
      errorMessages += "Eski şifreniz yanlış girilmiştir.<br>";
    }

    if (oldPass === '' || newPass === '' || reNewPass === '') {
      errorMessages += "Lütfen tüm şifre alanlarını doldurunuz.<br>";
    }

    if (newPass !== reNewPass) {
      errorMessages += "Yeni şifreler birbiriyle uyuşmamaktadır.<br>";
    }

    var errorContainer = document.getElementById("errorMessage2");
    errorContainer.innerHTML = errorMessages;

    if (errorMessages !== "") {
      return false; 
    } else {
      return true; 
    }
  }

  function bilgiKontrol() {
    
    var newAd = document.getElementById('newAdd').value;
    var newSoyad = document.getElementById('newSoyad').value;
    var newYas = document.getElementById('newYas').value;
    var newEposta = document.getElementById('newEmail').value;
    var newTc = document.getElementById('newTc').value;
    var newTelefon= document.getElementById('newTelefon').value;
    var newCinsiyet= document.getElementById('newCinsiyet').value;


    var errorMessages = "";


    if (newAd === '' || newSoyad === '' ||  newEposta === '' || newTc === ''|| newTelefon === '') {
      errorMessages += "Lütfen alanları boş bırakmayınız.<br>";
    }

    if (newTc.length  !== 11) {
      errorMessages += "TC kimlik numarası 11 haneli olmak zorundadır!.<br>";
    }
    if (newTelefon.length  !== 11) {
      errorMessages += "TC kimlik numarası 11 haneli olmak zorundadır!.<br>";
    }
    if(newCinsiyet ===null){
      newCinsiyet="Erkek";
    }
    var errorContainer = document.getElementById("errorMessage1");
    errorContainer.innerHTML = errorMessages;

    if (errorMessages !== "") {
      return false; // Formun gönderimini engeller
    } else {
      return true; // Formun gönderilmesine izin verir
    }
  }

  function buGun() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); 
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("newYas").value = today;
    }
    buGun();
</script>



</html>

