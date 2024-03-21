<?php $session=session();?>
<!DOCTYPE html>
<html lang="tr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UmuttepeTurizm Admin</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor_/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css_/sb-admin-2.min.css" rel="stylesheet">

    <style>


body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.form-wrapper {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    display: flex;
    flex-wrap: wrap;
    width: 70%;
    margin-top: 10px; /* Azaltılan boşluk */
    align-self: flex-start; /* Formu üste hizalar */
}

.form-column {
    flex: 1;
    padding: 0 10px; /* Gerekirse sütun içeriğindeki boşluğu azaltır */
}


.form-column label {
    display: block;
    margin-bottom: 5px;
}

.form-column select,
.form-column input[type="text"],
.form-column input[type="date"],
.form-column input[type="time"],
.form-column input[type="number"] {
    width: calc(100% - 16px);
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #78a6e7;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 20px;
    width: 100%; 
    box-sizing: border-box;
}

input[type="submit"]:hover {
    background-color: #2e85e2;
}

h2#hesap-basligi {
  color: #3498db;
  text-align: center;
  padding-top: 20px;
    }
    h4#hesap-basligi {
  color: #3498db;
  text-align: center;
  padding-top: 20px;
    }
    .containertoplusefer {
        text-align: center;
        margin-top: -100px;
    }

    
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" >
                
                <div class="sidebar-brand-text mx-3">Admin <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="admin">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>PANEL</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Sefer
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Sefer ve İl Ayarları</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="seferekle">Sefer Ekle</a>
                        <a class="collapse-item" href="ilekle">İl Ekle</a>
                        <div class="collapse-divider"></div>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Kullanıcı
            </div>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="yolculist"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Yolcu Listesi</span>
                </a>
                
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Bilet
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="biletlog"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Bilet Logları</span>
                </a>
                
            </li>
            <hr class="sidebar-divider">
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('/'); ?>">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Ana Sayfa</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>   

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Umuttepe Turizm</span>
                                <img class="img-profile rounded-circle"
                                    src="assets/img_/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Çıkış Yap
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
<div class="container-fluid">

                    <!-- Page Heading -->


                    <!-- Content Row -->
 <h2 id="hesap-basligi">Sefer Ekle</h2>
<form method="post" action="<?php echo site_url('/ekleSefer'); ?>" onsubmit="return bilgiKontrol()">    
<div class="row">                
  <div class="container">
               
    <div class="form-wrapper">
        
        <div class="form-column">
            <label for="seferKalkisSehir">Kalkış Şehri:</label>
            <?php
                use App\Models\UserModelSehirler;
                $sehirModel = new UserModelSehirler();
                $sehirler = $sehirModel->findAll();
            ?>
            <select id="seferKalkisSehir" name="seferKalkisSehir">
            <?php
            foreach ($sehirler as $sehir) {
            echo '<option value="' . $sehir['Plaka_kodu'] . '">' . $sehir['Sehir_adi'] . '</option>';
            }
            ?>
            </select>
            
            <label for="seferVarisSehir">Varış Şehri:</label>
            <select id="seferVarisSehir" name="seferVarisSehir">
            <?php
                foreach ($sehirler as $sehir) {
                echo '<option value="' . $sehir['Plaka_kodu'] . '">' . $sehir['Sehir_adi'] . '</option>';
                }
            ?>
            </select>
            
            <label for="seferDate">Tarih:</label>
            <input type="date" id="seferDate" name="seferDate">
            
            <label for="departure-time">Kalkış Saati:</label>
            <input type="time" id="departure-time" name="departure-time">
            
            <label for="arrival-time">Varış Saati:</label>
            <input type="time" id="arrival-time" name="arrival-time" step="1" value="19:30">
        </div>
        <div class="form-column">
            <label for="platform">Peron No:</label>
            <input type="text" id="seferPeron" name="seferPeron">
            
            <label for="plate">Plaka:</label>
            <input type="text" id="seferPlaka" name="seferPlaka">
            
            <!--<label for="capacity">Kapasite:</label>
            <input type="number" id="seferKapasite" name="seferKapasite">-->
            
            <label for="price">Bilet Fiyatı:</label>
            <input type="text" id="seferFiyat" name="seferFiyat">
            
            <input type="submit" value="Sefer Ekle">
<p id="errorMessage" style="color: red;"></p>
<?php if (isset($message)) {
    echo '<p id="errorMessage" style="color: green;">' . $message . '</p>';
}?>

        </div>
    </div>
    

</div>

</div>


</form>
<form method="post" action="<?php echo site_url('/ekleSefer'); ?>">
<div class="containertoplusefer">
<hr><br>
<input style="width: 350px;" type="submit"id="topluSefer" name="topluSefer"value="Toplu Sefer Ekle"></div><br><hr><br>

</form>

              
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Çıkış Yapmak İstediğinize Emin misiniz ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Mevcut oturumunuzu sonlandırmaya hazırsanız aşağıdan "Çıkış Yap"ı seçin.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">İptal</button>
                    <a class="btn btn-primary" href="<?php echo site_url('/cikisYap'); ?>">Çıkış Yap</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor_/jquery/jquery.min.js"></script>
    <script src="assets/vendor_/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js_/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor_/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js_/demo/chart-area-demo.js"></script>
    <script src="assets/js_/demo/chart-pie-demo.js"></script>

</body>
<script>
function bilgiKontrol() {
    
    var seferKalkisSehir = document.getElementById('seferKalkisSehir').value;
    var seferVarisSehir = document.getElementById('seferVarisSehir').value;

    var seferDate = document.getElementById('seferDate').value;
    var kalkisSaat = document.getElementById('departure-time').value;
    var varisSaat = document.getElementById('arrival-time').value;
    var seferPeron = document.getElementById('seferPeron').value;
    var seferPlaka = document.getElementById('seferPlaka').value;
    var seferFiyat= document.getElementById('seferFiyat').value;


    var errorMessages = "";


    if (seferDate === '' || kalkisSaat === '' ||  varisSaat === '' || seferPeron === ''|| seferPlaka === ''||seferFiyat === '') {
      errorMessages += "Lütfen alanları boş bırakmayınız.<br>";
    }

    if(seferVarisSehir ===null){
        errorMessages += "Sefer varış şehri seçiniz.<br>";
    }
    if(seferKalkisSehir ===null){
        errorMessages += "Sefer kalkış şehri seçiniz.<br>";
    }

    var errorContainer = document.getElementById("errorMessage");
    errorContainer.innerHTML = errorMessages;

    if (errorMessages !== "") {
      return false; 
    } else {
      return true; 
    }
  }
  </script>

</html>

