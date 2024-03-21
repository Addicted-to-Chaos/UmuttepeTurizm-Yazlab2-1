<?php $session=session(); ?>
<?php
        use App\Models\UsersModel;

        $yolcuu_id=isset($session->user["Yolcu_id"]) ? $session->user["Yolcu_id"] : '';
       
        $yolcuModel=new UsersModel();
        $yolcu=$yolcuModel->where('Yolcu_id',$yolcuu_id)->first();
        $bakiye=$yolcu['Bakiye'];
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        .card {
            display: flex;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-radius: 8px;
            width: 800px;
        }

        .form-section {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
        }

        .form-section:first-child {
            border-right: 1px solid #ddd;
            padding-right: 20px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .form-group .half-width {
            width: 48%; 
            display: inline-block;
            margin-right: 4%;
        }

        .form-group .full-width {
            width: 100%;
        }
        

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

body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
            position: relative;
      }

label {
    font-size: 15px; 
}
        h1 {
            color: #1C357C;
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
            color: #1C357C;
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
    font-size: 15px; 
}

        .form-row-center {
            display: flex;
            justify-content: center;
        }

        button[type="submit"] {
            background-color: #1C357C;
            color: #fff;
            width: 100%;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: rgb(57, 82, 131);
        }



        .logout-container {
            position: absolute;
            top: 0px;
            right: 20px;
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

 .left-menu a.active {
    color: #1C357C; /* Change this to the desired blue color */
}

</style>


<title>Hesabim</title>
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
        <a href="" class="menu-item active">Kullanıcı Bilgilerim </a>
        <hr>
        <a  href="biletlerim" class="menu-item">Bilet Bilgilerim</a>
        <hr>
        
        <a class="menu-item">Bakiye: <?php echo $bakiye?></a>
        <hr>
        
<a class="menu-item" href="<?php echo site_url('/cikisYap'); ?>">Çıkış Yap</a>
        <hr>
        <form method="post" action="<?php echo base_url('/bakiyeEkle'); ?>">
   
            <label for="Password" style="margin-left:20px;">Hesabıma Bakiye Ekle:</label>
            <input style="width: 90px; margin-left:20px;" type="text" id="bakiyeekle" name="bakiyeekle" onkeydown="if (!(event.key === 'Backspace' || event.key === 'Delete' || event.key === 'ArrowLeft' || event.key === 'ArrowRight' || event.key === 'Tab' || (event.key >= '0' && event.key <= '9'))) event.preventDefault()" maxlength="5">

                <button style="width: 60px; margin-left:10px; margin-right:5px;" type="submit" name="guncelle">Öde</button>
                <?php if (isset($messageBakiye)): ?>
                <p><?php echo '<p  style="margin-left: 20px;">'.$messageBakiye.'</p>'; ?></p>
                <?php endif; ?>
    
        </form>
        
        
</div>


<div class="content-wrapper">


    <div class="card">
        <form action="<?php echo base_url('/bilgileriGuncelle'); ?>" method="post" onsubmit="return bilgiKontrol()">
         <div class="form-section">
            <h2>Hesap Bilgileri</h2>
            <br><br>
            <div class="form-group">
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
            </div>
            <div class="form-group">
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
            </div>
            <div class="form-group">
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
            </div>
            <div class="form-group">
                <div class="form-row">
                    <label for="Telefon">Telefon:</label>
                    <input type="tel" id="newTelefon" name="newTelefon" hint="(505) 000 000 00" value="<?php echo isset($session->user["Telefon"]) ? $session->user["Telefon"] : ''; ?>" onkeydown="if (!(event.key === 'Backspace' || event.key === 'Delete' || event.key === 'ArrowLeft' || event.key === 'ArrowRight' || event.key === 'Tab' || (event.key >= '0' && event.key <= '9'))) event.preventDefault()" maxlength="11">
                </div>
            </div>
            <div class="form-row form-row-center">
                <?php if (isset($successMessage1)): ?>
                  <p><?php echo $successMessage1; ?></p>
                  <?php endif; ?>
                    <button type="submit" name="guncelle">Bilgileri Güncelle</button>
                </div>
                <p id="errorMessage1" style="color: red;"></p>
        </form>
    </div>
     

    <form action="<?php echo base_url('/sifreDegistir'); ?>" method="post" onsubmit="return sifreKontrol()">

        <div class="form-section">
      
            <h2>Şifre Bilgileri</h2>
            <br><br>
            
            <div class="form-group">
                
                <div class="form-row">
            
                    <label for="Password">Eski Şifre:</label>
                    <input type="password" id="oldPass" name="oldPass">
                </div>
                <div class="form-row">
                 
                    <label for="Password">Yeni Şifre:</label>
                    <input type="password" id="newPass" name="newPass">
                </div>
                <div class="form-row">
            

                    <label for="Password">Yeni Şifre Yeniden:</label>
                    <input type="password" id="reNewPass" name="reNewPass">
                </div>
                


            </div>
            
            <div class="form-row form-row-center">
                <?php if (isset($successMessage2)): ?>
                <p><?php echo $successMessage2; ?></p>
                <?php endif; ?>
                  <button type="submit" name="guncelle">Şifreyi Değiştir</button>
              </div>
              <p id="errorMessage2" style="color: red;"></p>

              <!-- Şifre Bilgileri formu sonrasına eklenen duyuru tercihleri -->
   

              <br><br><br><br>
      
    </form>

    
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
    if (newTelefon.length  !== 10) {
      errorMessages += "Telefon numarası 10 haneli olmak zorundadır!.<br>";
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


