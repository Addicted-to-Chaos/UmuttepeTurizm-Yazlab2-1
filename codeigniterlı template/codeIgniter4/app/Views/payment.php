<?php $session=session(); ?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ödeme</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    
    <style>
       * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    list-style: none;
    font-family: 'Montserrat', sans-serif
}

body{
    background-color:#E2E3E4;
}
form .fas.fa-calendar-alt {
    color: #6482B8;
}

form .fas.fa-lock {
    color: #6482B8;
}
form .far.fa-user {
    color: #6482B8;
}

.container {
    margin: 20px auto;
    width: 800px;
    padding: 30px
}

.card.box1 {
    width: 350px;
    height: 500px;
    background-color: #1C357C;
    color: #fff;
    border-radius: 0
}

.card.box2 {
    width: 450px;
    height: 580px;
    background-color: #ffffff;
    border-radius: 0
}

.text {
    font-size: 13px
}

.box2 .btn.btn-primary.bar {
    width: 20px;
    background-color: transparent;
    border: none;
    color: #1C357C
}

.box2 .btn.btn-primary.bar:hover {
    color: #1C357C
}

.box1 .btn.btn-primary {
    background-color: #1C357C;
    width: 45px;
    height: 45px;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 1px solid #ddd
}

.box1 .btn.btn-primary:hover {
    background-color: #1C357C;
    color: #57c97d
}

.btn.btn-success {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #ddd;
    color: black;
    display: flex;
    justify-content: center;
    align-items: center;
    border: none
}

.nav.nav-tabs {
    border: none;
    border-bottom: 2px solid #ddd
}

.nav.nav-tabs .nav-item .nav-link {
    border: none;
    color: black;
    border-bottom: 2px solid transparent;
    font-size: 14px
}

.nav.nav-tabs .nav-item .nav-link:hover {
    border-bottom: 2px solid #6482B8;
    color: #6482B8
}

.nav.nav-tabs .nav-item .nav-link.active {
    border: none;
    border-bottom: 2px solid #6482B8
}

.form-control {
    border: none;
    border-bottom: 1px solid #ddd;
    box-shadow: none;
    height: 20px;
    font-weight: 600;
    font-size: 14px;
    padding: 15px 0px;
    letter-spacing: 1.5px;
    border-radius: 0
}

.inputWithIcon {
    position: relative
}

img {
    width: 50px;
    height: 20px;
    object-fit: cover
}

.inputWithIcon span {
    position: absolute;
    right: 0px;
    bottom: 9px;
    color: #6482B8;
    cursor: pointer;
    transition: 0.3s;
    font-size: 14px
}

.form-control:focus {
    box-shadow: none;
    border-bottom: 1px solid #ddd
}

.btn-outline-primary {
    color: black;
    background-color: #ddd;
    border: 1px solid #ddd
}

.btn-outline-primary:hover {
    background-color: #6482B8;
    border: 1px solid #ddd
}

.btn-check:active+.btn-outline-primary,
.btn-check:checked+.btn-outline-primary,
.btn-outline-primary.active,
.btn-outline-primary.dropdown-toggle.show,
.btn-outline-primary:active {
    color: #6482B8;
    background-color: #1C357C;
    box-shadow: none;
    border: 1px solid #ddd
}

.btn-group>.btn-group:not(:last-child)>.btn,
.btn-group>.btn:not(:last-child):not(.dropdown-toggle),
.btn-group>.btn-group:not(:first-child)>.btn,
.btn-group>.btn:nth-child(n+3),
.btn-group>:not(.btn-check)+.btn {
    border-radius: 50px;
    margin-right: 20px
}

form {
    font-size: 14px
}

form .btn.btn-primary {
    width: 100%;
    height: 45px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: #1C357C;
    border: 1px solid #ddd
}

form .btn.btn-primary:hover {
    background-color: #6482B8
}

@media (max-width:750px) {
    .container {
        padding: 10px;
        width: 100%
    }

    .text-green {
        font-size: 14px
    }

    .card.box1,
    .card.box2 {
        width: 100%
    }

    .nav.nav-tabs .nav-item .nav-link {
        font-size: 12px
    }
}



    </style>
</head>
<body>
    <div class="container bg-light d-md-flex align-items-center">
       <!-- Butonun olduğu kısım -->
       <a href="#" onclick="window.history.back();" class="btn btn-danger position-absolute top-0 start-0 m-3">İptal</a>
       <!-- Diğer içerikler -->
       <div class="card box1 shadow-sm p-md-5 p-md-5 p-4">
          <div class="fw-bolder mb-4"><span class="ps-1"><?php echo $biletFiyat?>₺</span></div>
          <div class="d-flex flex-column">
             <div class="border-bottom mb-4"></div>
             <div class="d-flex flex-column mb-5">
    <span class="far fa-calendar-alt text"><span class="ps-2">Ödeme Tarihi:</span></span>
    <span class="ps-3 datePlaceholder">Tarih</span><br><br>
    <h6>Sayın Müşterimiz, ödemeyle ilgili herhangi bir sorununuz olduğunda bizimle email üzerinden veya telefon numaramızdan iletişime geçin. Size her konuda yardımcı olmaktan mutluluk duyarız.
<br><br>
Bizi Tercih ettiğiniz için teşekkür ederiz.</h6>
</div>

          </div>
       </div>
       <div class="card box2 shadow-sm">
          <div class="d-flex align-items-center justify-content-between p-md-5 p-4">
             <span class="h5 fw-bold m-0">Kart ile Ödeme</span> 
          </div>
          <ul class="nav nav-tabs mb-3 px-md-4 px-2">
             <li class="nav-item"> <a class="nav-link px-2 active" aria-current="page" href="#">Kart</a> </li>
          </ul>
          <div class="px-md-5 px-4 mb-4 d-flex align-items-center">
          </div>
          <form method="post" action="<?= site_url('/odendi') ?>">
             <div class="row">
                <div class="col-12">
                   <div class="d-flex flex-column px-md-5 px-4 mb-4">
                      <span>Kart Numarası</span> 
                      <div class="inputWithIcon"> <input class="form-control" name="kartNumara" id="kartNumara" type="text" value="" onkeydown="if (!(event.key === 'Backspace' || event.key === 'Delete' || event.key === 'ArrowLeft' || event.key === 'ArrowRight' || event.key === 'Tab' || (event.key >= '0' && event.key <= '9'))) event.preventDefault()" maxlength="16" minlength="16" required> <span class=""> <img src="https://www.freepnglogos.com/uploads/mastercard-png/mastercard-logo-logok-15.png" alt=""></span> </div>
                   </div>
                </div>
                <div class="col-md-6">
                   <div class="d-flex flex-column ps-md-5 px-md-0 px-4 mb-4">
                      <span>Son Kullanım<span class="ps-1">Tarihi</span></span> 
                      <div class="inputWithIcon"> <input type="text" class="form-control"  id="expireDate" name="expireDate" value="" onkeydown="if (!(event.key === 'Backspace' || event.key === 'Delete' || event.key === 'ArrowLeft' || event.key === 'ArrowRight' || event.key === 'Tab' || (event.key >= '0' && event.key <= '9'))) event.preventDefault()" maxlength="5" minlength="5" required > <span class="fas fa-calendar-alt"></span> </div>
                   </div>
                </div>
                <div class="col-md-6">
                   <div class="d-flex flex-column pe-md-5 px-md-0 px-4 mb-4">
                      <span>CVV</span> 
                      <div class="inputWithIcon"> <input type="text" class="form-control" id="cvv" name="cvv" value="" onkeydown="if (!(event.key === 'Backspace' || event.key === 'Delete' || event.key === 'ArrowLeft' || event.key === 'ArrowRight' || event.key === 'Tab' || (event.key >= '0' && event.key <= '9'))) event.preventDefault()" maxlength="3" minlength="3" required> <span class="fas fa-lock"></span> </div>
                   </div>
                </div>
                <div class="col-12">
                   <div class="d-flex flex-column px-md-5 px-4 mb-4">
                      <span>Kart Üzerindeki İsim</span> 
                      <div class="inputWithIcon"> <input class="form-control text-uppercase" name="kartIsım" id="kartIsım" type="text" value="" onkeydown="return /[a-zçğıüö]/i.test(event.key) || event.key === 'Backspace' || event.key === 'Delete' || event.key === 'ArrowLeft' || event.key === 'ArrowRight' event.key === 'Space' ||" maxlength="20"> <span class="far fa-user"></span> </div>
                   </div>
                </div>
                <div class="col-12 px-md-5 px-4 mt-3">
               
                <input type="hidden"id="seferId" name="seferId" value="<?php echo $seferId?>">
                <input type="hidden"id="koltukId" name="koltukId" value="<?php echo $koltukId?>">
                <input type="hidden"id="pnrKodu" name="pnrKodu" value="<?php echo $pnrKodu?>">
                <input type="hidden"id="yolcuId" name="yolcuId" value="<?php echo $yolcuId?>">
                <input type="hidden"id="biletFiyat" name="biletFiyat" value="<?php echo $biletFiyat?>">


                   <button type="submit" class="btn btn-primary w-100"><?php echo $biletFiyat?>₺</button>
                </div>
             </div>
          </form>
       </div>
    </div>
</body>

<script>
document.getElementById('expireDate').addEventListener('input', function (e) {
    let input = e.target.value;
    
    input = input.replace(/\D/g, '');

    let month = parseInt(input.substring(0, 2), 10);
    if (month > 12) {
        month = 12;
    }

    input = month + '/' + input.substring(2, 4);

    document.getElementById('expireDate').value = input;
});


// Bugünün tarihini al
var bugun = new Date();

// Tarih formatını ayarla (örneğin: "18 Mart 2024" gibi)
var tarihFormati = bugun.getDate() + ' ' + ayAdiniGetir(bugun.getMonth()) + ' ' + bugun.getFullYear();

// HTML içeriğini güncelle
document.querySelector('.datePlaceholder').textContent = tarihFormati;

// Ay adını al
function ayAdiniGetir(ay) {
    var aylar = ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'];
    return aylar[ay];
}

</script>
</html>
