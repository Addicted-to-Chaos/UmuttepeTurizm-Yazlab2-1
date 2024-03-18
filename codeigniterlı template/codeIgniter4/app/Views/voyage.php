<?php $session=session();



?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <title>Umuttepe Turizm</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Template Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">

    <style>
        /* Popup stilini burada belirtin */

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
            position: relative;
      }
        .popup {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .popup-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 10px;
            width: 60%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .bus-layout {
            background-color: #ffffff;
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
            transition: background-color 0.3s ease;
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

        .content-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #fff;
            margin: -50px 0 0;
        }

        .service-content-inner {
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
        }

        .service-content-inner:hover {
            transform: translateY(-5px);
        }

        .service-content-inner:hover .btn-primary {
            background-color: #6482B8 ;
            color: #fff;
        }

        .btn-primary {
            border-radius: 20px;
            margin-left: auto;
            font-size: 18px;
            padding: 10px 20px;
            background-color: #1C357C;
            color: white;
        }

        .service-content-inner .service-content {
            margin-right: 20px;
      
        }

        .service-content-inner .service-content h5 {
            font-size: 20px;
       
        }

        .back-btn {
        display: inline-block;
        background-color: #1C357C;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .back-btn:hover {
        background-color: #6482B8;
    }
    </style>
</head>

<body>
    <!-- Services Start -->
    <div class="container-fluid bg-light service py-5">
        <div class="container py-5">
            

        <div class="text-center mt-4">
        <a href="#" onclick="history.back();" class="back-btn">Geri</a>
         </div>

            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <br>
                <h1 style="color: #1C357C; ">Aktif Seferler</h1>
                <hr style="border-width: 2px;color:#1C357C;">
                <br>
            </div>
            <div class="col-12">

            <?php if (empty($seferler)): ?>
                <p style="color:red; font-size: 30px;"><b>Aktif Sefer bulunmamaktadır.</b></p>



<?php else: ?>
    <?php foreach ($seferler as $sefer): ?>
        
        <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
            <div class="service-icon p-4">
                <img src="assets/img/bus.png" width="250" class="img-fluid">
            </div>
            <div class="service-content">
                <h2 style="color: #6482B8">Konforlu Koltuk Düzeni</h2>
                <p ><b> Kalkış Şehri : </b><?=  $sefer['Kalkis_sehir']?>ㅤㅤ
                <b>Varış Şehri : </b><?= $sefer['Varis_sehir'] ?> ㅤㅤ
                <b>Sefer Tarihi : </b><?= $sefer['Tarih'] ?>ㅤㅤ
                <b>Kalkış Saati : </b><?= $sefer['Kalkis_saat'] ?></p><br> 
                <b>Sefer : </b><?= $sefer['Sefer_id'] ?></p><br>
            </div>

            <div class="d-flex align-items-center" style="margin-left: auto; margin-right: 20px;">
    <!-- Fiyat bilgisi -->
    <div class="me-3" style="margin-bottom: 35px; font-size: 26px; font-weight: bold;">
    ㅤㅤ<?= $sefer['Fiyat'] ?>₺
    </div>
    <!-- Buton -->
    <button class="btn btn-primary mt-20" style="width: 200px;" onclick="goToSeatSelection(<?= $sefer['Sefer_id'] ?>)">
        Koltuk Seç
    </button>
</div>



        
        </div>
        <br>
    <?php endforeach; ?>
<?php endif; ?>
            </div>
            <!-- JavaScript Libraries -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="assets/lib/easing/easing.min.js"></script>
            <script src="assets/lib/waypoints/waypoints.min.js"></script>
            <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>
            <script src="assets/lib/lightbox/js/lightbox.min.js"></script>


            <!-- Template Javascript -->
            <script src="assets/js/main.js"></script>
</body>
<script>
    var globalSeferId; 

    function goToSeatSelection(seferId) {
        globalSeferId = seferId;
        window.location.href = "<?php echo site_url('/koltuksecimi?sefer_id=') ?>" + seferId;
    }
</script>
</html>

