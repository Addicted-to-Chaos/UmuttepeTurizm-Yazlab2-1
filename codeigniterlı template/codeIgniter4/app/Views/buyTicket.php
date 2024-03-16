<?php $session=session();?>
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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="assets/css/style.css" rel="stylesheet">
    </head>

    <body>
        <style>
            input[name="return-date"][disabled] {
    color: #ffffff;
}

        </style>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Topbar Start -->
        <div class="container-fluid bg-primary px-5 d-none d-lg-block">
            <div class="row gx-0">
                <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center" style="height: 45px;">
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-twitter fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-facebook-f fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-linkedin-in fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-instagram fw-normal"></i></a>
                        <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle" href=""><i class="fab fa-youtube fw-normal"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center" style="height: 45px;">

                    <?php if(isset($session->user['Yolcu_id'])):?>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle text-light" data-bs-toggle="dropdown"><small><i class="fa fa-home me-2"></i> <?php echo isset($session->user['Ad']) ? $session->user['Ad'] : ''; ?></small></a>
                            <div class="dropdown-menu rounded">
                                <a href="<?= site_url('/hesabim') ?>" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> Profilim</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-cog me-2"></i> Hesap Ayarları</a>
                                <a href="<?php echo site_url('/cikisYap'); ?>" class="dropdown-item"><i class="fas fa-power-off me-2"></i> Çıkış Yap</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?= site_url('/register') ?>"><small class="me-3 text-light"><i class="fa fa-user me-2"></i>Kayıt Ol</small></a>
                        <a href="<?= site_url('/login') ?>"><small class="me-3 text-light"><i class="fa fa-sign-in-alt me-2"></i>Giriş Yap</small></a>
                    <?php endif; ?>    

                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->

        <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="<?= site_url('/') ?>" class="navbar-brand p-0">
                    <h1 class="m-0"><i class="fa fa-map-marker-alt me-3"></i>Umuttepe</h1>
                    <!-- <img src="assets/img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="<?= site_url('/') ?>" class="nav-item nav-link">Ana Sayfa</a>
                        <a href="<?= site_url('/about') ?>" class="nav-item nav-link">Hakkımızda</a>
                        <a href="<?= site_url('/services') ?>" class="nav-item nav-link">Hizmetlerimiz</a>
                        <a href="<?= site_url('/packages') ?>" class="nav-item nav-link">Seferler</a>
                        <a href="<?= site_url('/contact') ?>" class="nav-item nav-link">İletişim</a>
                       
                    </div>
                    <a href="<?= site_url('/buyTicket') ?>" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Bilet Al</a>
                </div>
            </nav>

            
        </div>
        <div class="container-fluid search-bar position-relative" style="background: rgb(84, 113, 172);">
            <div class="container">
                <div id="booking" class="section">
                    <div class="section-center">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="booking-cta">
                                    <h1 style="color: rgb(232, 235, 240);">BİLETİNİZİ BUGÜN ALIN</h1>
                                            <p>Avantajlı fırsatları kaçırmayın</p>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-md-offset-1">
                                        <div class="booking-form">
                                        <form action="<?php echo site_url('/seferler'); ?>" method="post">
                                                <div class="form-group">
                                                    <div class="form-checkbox">
                                                        <label for="gidisdonus">
                                                            <input type="radio" id="gidisdonus" name="flight-type" value="gidisdonus" >
                                                            <span></span>Gidiş - Dönüş
                                                        </label>
                                                        <label for="tekyon">
                                                            <input type="radio" id="tekyon" name="flight-type"value="tekyon">
                                                            <span></span>Tek Yön
                                                        </label>

                                                       
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <span class="form-label" style="color: rgb(57, 82, 131);">Nereden</span>
                                                <?php
                                                use App\Models\UserModelSehirler;
                                                $sehirModel = new UserModelSehirler();
                                                $sehirler = $sehirModel->findAll();
                                                ?>
                                                <select class="form-control" id="sehirNereden" name="sehirNereden" required>
                                                    <option value="" selected disabled>Şehir Seçiniz</option> <!-- İlk seçenek -->
                                                    <?php
                                                    foreach ($sehirler as $sehir) {
                                                        echo '<option value="' . $sehir['Plaka_kodu'] . '">' . $sehir['Sehir_adi'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                               </div>
                                              </div>

                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                    <span class="form-label" style="color: rgb(57, 82, 131);">Nereye</span>
                                                <select class="form-control" id="sehirNereye" name="sehirNereye" required>
                                                    <option value="" selected disabled>Şehir Seçiniz</option> <!-- İlk seçenek -->
                                                    <?php
                                                    foreach ($sehirler as $sehir) {
                                                        echo '<option value="' . $sehir['Plaka_kodu'] . '">' . $sehir['Sehir_adi'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                                  </div>
                                                    </div>
                                                </div>
                                                <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <span class="form-label" style="color: rgb(57, 82, 131);">Gidiş Tarihi</span>
                <input class="form-control" type="date" name="departure-date"id="departure-date" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <span class="form-label" style="color: rgb(57, 82, 131);">Dönüş Tarihi</span>
                <input class="form-control" type="date" name="return-date" disabled required>
            </div>
        </div>
    </div>

                                                <div class="form-btn" >
                                                    <button class="submit-btn" >SEFERLERİ GÖSTER</button>
                                                    
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Destination Start -->
        <div class="container-fluid destination py-5">
            <div class="container py-5">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <h5 class="section-title px-3">Öneriler</h5>
                    <h1 class="mb-0">Popüler Mekanlar</h1>
                </div>
                <div class="tab-class text-center">
                    <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
                        <li class="nav-item">
                            <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-1">
                                <span class="text-dark" style="width: 150px;">Hepsi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex py-2 mx-3 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                                <span class="text-dark" style="width: 150px;">İstanbul</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                <span class="text-dark" style="width: 150px;">Ankara</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#tab-4">
                                <span class="text-dark" style="width: 150px;">Bursa</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex mx-3 py-2 border border-primary bg-light rounded-pill" data-bs-toggle="pill" href="#tab-5">
                                <span class="text-dark" style="width: 150px;">Kocaeli</span>
                            </a>
                        </li>
                        
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="col-xl-8">
                                    <div class="row g-4">
                                        <div class="col-lg-6">
                                            <div class="destination-img">
                                                <img class="img-fluid rounded w-100" src="assets/img/destination-1.jpg" alt="">
                                                <div class="destination-overlay p-4">
                                                    
                                                </div>
                                                <div class="search-icon">
                                                    <a href="assets/img/destination-1.jpg" data-lightbox="destination-1"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="destination-img">
                                                <img class="img-fluid rounded w-100" src="assets/img/destination-2.jpg" alt="">
                                                <div class="destination-overlay p-4">
                                                    
                                                </div>
                                                <div class="search-icon">
                                                    <a href="assets/img/destination-2.jpg" data-lightbox="destination-2"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="destination-img">
                                                <img class="img-fluid rounded w-100" src="assets/img/destination-7.jpg" alt="">
                                                <div class="destination-overlay p-4">
                                                   
                                                </div>
                                                <div class="search-icon">
                                                    <a href="assets/img/destination-7.jpg" data-lightbox="destination-7"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="destination-img">
                                                <img class="img-fluid rounded w-100" src="assets/img/destination-8.jpg" alt="">
                                                
                                                <div class="search-icon">
                                                    <a href="assets/img/destination-8.jpg" data-lightbox="destination-8"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="destination-img h-100">
                                        <img class="img-fluid rounded w-100 h-100" src="assets/img/destination-9.jpg" style="object-fit: cover; min-height: 300px;" alt="">
                                        <div class="destination-overlay p-4">
                                           
                                        </div>
                                        <div class="search-icon">
                                            <a href="assets/img/destination-9.jpg" data-lightbox="destination-4"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="destination-img">
                                        <img class="img-fluid rounded w-100" src="assets/img/destination-4.jpg" alt="">
                                        <div class="destination-overlay p-4">

                                        </div>
                                        <div class="search-icon">
                                            <a href="assets/img/destination-4.jpg" data-lightbox="destination-4"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="destination-img">
                                        <img class="img-fluid rounded w-100" src="assets/img/destination-5.jpg" alt="">
                                        <div class="destination-overlay p-4">
                                           
                                        </div>
                                        <div class="search-icon">
                                            <a href="assets/img/destination-5.jpg" data-lightbox="destination-5"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="destination-img">
                                        <img class="img-fluid rounded w-100" src="assets/img/destination-6.jpg" alt="">
                                        <div class="destination-overlay p-4">
                                           
                                        </div>
                                        <div class="search-icon">
                                            <a href="assets/img/destination-6.jpg" data-lightbox="destination-6"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="destination-img">
                                        <img class="img-fluid rounded w-100" src="assets/img/destination-5.jpg" alt="">
                                        <div class="destination-overlay p-4">
                                           
                                        </div>
                                        <div class="search-icon">
                                            <a href="assets/img/destination-5.jpg" data-lightbox="destination-5"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="destination-img">
                                        <img class="img-fluid rounded w-100" src="assets/img/destination-6.jpg" alt="">
                                        <div class="destination-overlay p-4">
                                           
                                        </div>
                                        <div class="search-icon">
                                            <a href="assets/img/destination-6.jpg" data-lightbox="destination-6"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-3" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="destination-img">
                                        <img class="img-fluid rounded w-100" src="assets/img/destination-5.jpg" alt="">
                                        <div class="destination-overlay p-4">
                                          
                                        </div>
                                        <div class="search-icon">
                                            <a href="assets/img/destination-5.jpg" data-lightbox="destination-5"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="destination-img">
                                        <img class="img-fluid rounded w-100" src="assets/img/destination-6.jpg" alt="">
                                        <div class="destination-overlay p-4">
                                            
                                        </div>
                                        <div class="search-icon">
                                            <a href="assets/img/destination-6.jpg" data-lightbox="destination-6"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-4" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="destination-img">
                                        <img class="img-fluid rounded w-100" src="assets/img/destination-5.jpg" alt="">
                                        <div class="destination-overlay p-4">
                                            
                                        </div>
                                        <div class="search-icon">
                                            <a href="assets/img/destination-5.jpg" data-lightbox="destination-5"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="destination-img">
                                        <img class="img-fluid rounded w-100" src="assets/img/destination-6.jpg" alt="">
                                        <div class="destination-overlay p-4">
                                           
                                        </div>
                                        <div class="search-icon">
                                            <a href="assets/img/destination-6.jpg" data-lightbox="destination-6"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-5" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="destination-img">
                                        <img class="img-fluid rounded w-100" src="assets/img/destination-5.jpg" alt="">
                                        <div class="destination-overlay p-4">
                                           
                                        </div>
                                        <div class="search-icon">
                                            <a href="assets/img/destination-5.jpg" data-lightbox="destination-5"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="destination-img">
                                        <img class="img-fluid rounded w-100" src="assets/img/destination-6.jpg" alt="">
                                        <div class="destination-overlay p-4">
                                          
                                        </div>
                                        <div class="search-icon">
                                            <a href="assets/img/destination-6.jpg" data-lightbox="destination-6"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-6" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="destination-img">
                                        <img class="img-fluid rounded w-100" src="assets/img/destination-5.jpg" alt="">
                                        <div class="destination-overlay p-4">
                                          
                                        </div>
                                        <div class="search-icon">
                                            <a href="assets/img/destination-5.jpg" data-lightbox="destination-5"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="destination-img">
                                        <img class="img-fluid rounded w-100" src="assets/img/destination-6.jpg" alt="">
                                        <div class="destination-overlay p-4">
                                            
                                        </div>
                                        <div class="search-icon">
                                            <a href="assets/img/destination-6.jpg" data-lightbox="destination-6"><i class="fa fa-plus-square fa-1x btn btn-light btn-lg-square text-primary"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Destination End -->

        <!-- Explore Tour Start -->
        <div class="container-fluid ExploreTour py-5">
            <div class="container py-5">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <h5 class="section-title px-3">Gezi Rotalarını Keşfedin</h5>
                    <h1 class="mb-4"></h1>
                    <p class="mb-0">Gittiğiniz şehirlerde güzel vakit geçirmeniz için bulduğumuz gezileri inceleyebilirsiniz.
                    </p>
                </div>
                <div class="tab-class text-center">
                    <ul class="nav nav-pills d-inline-flex justify-content-center mb-5">
                        <li class="nav-item">
                            
                        </li>
                    
                    </ul>
                    <div class="tab-content">
                        <div id="NationalTab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-4">
                                    <div class="national-item">
                                        <img src="assets/img/explore-tour-1.jpg" class="img-fluid w-100 rounded" alt="Image">
                                        <div class="national-content">
                                            <div class="national-info">
                                                <h5 class="text-white text-uppercase mb-2">Haftasonu Gezileri</h5>
                                                <a href="#" class="btn-hover text-white">İncele<i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                        </div>
                                        <div class="national-plus-icon">
                                            <a href="#" class="my-auto"><i class="fas fa-link fa-2x text-white"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="national-item">
                                        <img src="assets/img/explore-tour-2.jpg" class="img-fluid w-100 rounded" alt="Image">
                                        <div class="national-content">
                                            <div class="national-info">
                                                <h5 class="text-white text-uppercase mb-2">Tatil Gezileri</h5>
                                                <a href="#" class="btn-hover text-white">İncele <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                        </div>
                                        <div class="national-plus-icon">
                                            <a href="#" class="my-auto"><i class="fas fa-link fa-2x text-white"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="national-item">
                                        <img src="assets/img/explore-tour-3.jpg" class="img-fluid w-100 rounded" alt="Image">
                                        <div class="national-content">
                                            <div class="national-info">
                                                <h5 class="text-white text-uppercase mb-2">Yol Gezileri</h5>
                                                <a href="#" class="btn-hover text-white">İncele <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                        </div>

                                        <div class="national-plus-icon">
                                            <a href="#" class="my-auto"><i class="fas fa-link fa-2x text-white"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="national-item">
                                        <img src="assets/img/explore-tour-4.jpg" class="img-fluid w-100 rounded" alt="Image">
                                        <div class="national-content">
                                            <div class="national-info">
                                                <h5 class="text-white text-uppercase mb-2">Tarihi Geziler</h5>
                                                <a href="#" class="btn-hover text-white">İncele <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                        </div>
                                        <div class="national-plus-icon">
                                            <a href="#" class="my-auto"><i class="fas fa-link fa-2x text-white"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="national-item">
                                        <img src="assets/img/explore-tour-5.jpg" class="img-fluid w-100 rounded" alt="Image">
                                        <div class="national-content">
                                            <div class="national-info">
                                                <h5 class="text-white text-uppercase mb-2">Aile Gezileri</h5>
                                                <a href="#" class="btn-hover text-white">İncele <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                        </div>
                            
                                        <div class="national-plus-icon">
                                            <a href="#" class="my-auto"><i class="fas fa-link fa-2x text-white"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="national-item">
                                        <img src="assets/img/explore-tour-6.jpg" class="img-fluid w-100 rounded" alt="Image">
                                        <div class="national-content">
                                            <div class="national-info">
                                                <h5 class="text-white text-uppercase mb-2">Sahil Gezileri</h5>
                                                <a href="#" class="btn-hover text-white">İncele <i class="fa fa-arrow-right ms-2"></i></a>
                                            </div>
                                        </div>
                                        <div class="national-plus-icon">
                                            <a href="#" class="my-auto"><i class="fas fa-link fa-2x text-white"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Explore Tour Start -->

              <!-- Footer Start -->
              <div class="container-fluid footer py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">İletişime geçin</h4>
                            <a href=""><i class="fas fa-home me-2"></i> Kocaeli Üniversitesi</a>
                            <a href=""><i class="fas fa-envelope me-2"></i> umuttepeTurizm@outlook</a>
                            <a href=""><i class="fas fa-phone me-2"></i> +123456</a>
                            <a href="" class="mb-3"><i class="fas fa-print me-2"></i> +123456</a>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-share fa-2x text-white me-2"></i>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Firma</h4>
                            <a href="about"><i class="fas fa-angle-right me-2"></i> Hakkımızda</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Kariyer</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Blog</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Basın</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Hediye Kartı</a>
                            <a href="#"><i class="fas fa-angle-right me-2"></i> Magazin</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Yardım</h4>
                            <a href="contact"><i class="fas fa-angle-right me-2"></i> İletişim</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Gizlilik Sözleşmesi</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Hüküm ve Koşullar</a>
                            <a href=""><i class="fas fa-angle-right me-2"></i> Çerez Politikası</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item">
                            <div class="row gy-3 gx-2 mb-4">
                                <div class="col-xl-6">
                                    <form>
                                        <div class="form-floating">
                                            <select class="form-select bg-dark border" id="select1">
                                                <option value="2">Türkçe</option>
                                                <option value="3">English</option>
                                            </select>
                                            <label for="select1">Türkçe</label>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xl-6">
                                    <form>
                                        <div class="form-floating">
                                            <select class="form-select bg-dark border" id="select1">
                                                <option value="1">TL</option>
                                                <option value="2">USD</option>
                                            </select>
                                            <label for="select1">₺</label>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <h4 class="text-white mb-3">Ödeme</h4>
                            <div class="footer-bank-card">
                                <a href="#" class="text-white me-2"><i class="fab fa-cc-amex fa-2x"></i></a>
                                <a href="#" class="text-white me-2"><i class="fab fa-cc-visa fa-2x"></i></a>
                                <a href="#" class="text-white me-2"><i class="fas fa-credit-card fa-2x"></i></a>
                                <a href="#" class="text-white me-2"><i class="fab fa-cc-mastercard fa-2x"></i></a>
                                <a href="#" class="text-white me-2"><i class="fab fa-cc-paypal fa-2x"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-cc-discover fa-2x"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
        
        <!-- Copyright Start -->
        <div class="container-fluid copyright text-body py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-end mb-md-0">
                        <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">Your Site Name</a>, All right reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-start">
                        
                         
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
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
    

</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Radio inputları al
    var gidisDonusRadio = document.getElementById("gidisdonus");
    var tekYonRadio = document.getElementById("tekyon");

    // Tarih alanının HTML elementini al
    var dateInput = document.getElementById("date-input");

    // Tarih alanında her değişiklikte çalışacak olan işlev
    dateInput.addEventListener("change", function() {
        // Bugünkü tarihi al
        var today = new Date();

        // Seçilen tarihi al
        var selectedDate = new Date(dateInput.value);

        // Bugünün tarihinden önce bir tarih seçildiyse
        if (selectedDate < today) {
            // Kullanıcıya uyarı ver
            alert("Lütfen bugünden sonraki bir tarih seçiniz.");
            // Tarih seçimini temizle
            dateInput.value = "";
        }
    });

    // Radio inputların herhangi birinin değişikliğinde kontrol edilecek olan işlev
    function checkFlightType() {
        // Eğer "Gidiş-Dönüş" seçeneği seçilmişse
        if (gidisDonusRadio.checked) {
            // Burada gidiş-dönüş uçuş türüne göre yapılacak işlemleri yapabilirsiniz
            console.log("Gidiş-Dönüş seçeneği seçildi.");
        } else if (tekYonRadio.checked) { // Eğer "Tek Yön" seçeneği seçilmişse
            // Burada tek yön uçuş türüne göre yapılacak işlemleri yapabilirsiniz
            console.log("Tek Yön seçeneği seçildi.");
        }
    }

    // Radio inputların herhangi birinin değişikliğinde checkFlightType işlevini çağır
    gidisDonusRadio.addEventListener("change", checkFlightType);
    tekYonRadio.addEventListener("change", checkFlightType);
});
    // Nereden şehir seçimi değiştiğinde çalışacak işlev
    function neredenDegisti() {
        var neredenSelect = document.getElementById("sehirNereden");
        var nereyeSelect = document.getElementById("sehirNereye");

        // Seçilen nereden şehri
        var neredenValue = neredenSelect.value;

        // Nereye şehrinin seçilebilirliği kontrol ediliyor
        for (var i = 0; i < nereyeSelect.options.length; i++) {
            if (nereyeSelect.options[i].value === neredenValue) {
                nereyeSelect.options[i].disabled = true; // Aynı şehir seçilemez yapılıyor
            } else {
                nereyeSelect.options[i].disabled = false; // Diğer seçenekler seçilebilir yapılıyor
            }
        }
    }

    // Sayfa yüklendiğinde ve Nereden şehir seçimi değiştiğinde neredenDegisti() fonksiyonunun çalışması için event listener ekleniyor
    window.onload = function() {
        neredenDegisti(); // Sayfa yüklendiğinde çalıştır
        document.getElementById("sehirNereden").addEventListener("change", neredenDegisti); // Nereden seçimi değiştiğinde çalıştır
    };

     // Sayfa yüklendiğinde dönüş tarihi alanını devre dışı bırak
     document.addEventListener("DOMContentLoaded", function() {
        disableReturnDate();
    });

    // Gidiş-dönüş seçeneği değiştiğinde dönüş tarihi alanını etkinleştir veya devre dışı bırak
    document.querySelectorAll('input[name="flight-type"]').forEach(function(radio) {
        radio.addEventListener("change", function() {
            disableReturnDate();
        });
    });

    function disableReturnDate() {
        var returnDateInput = document.querySelector('input[name="return-date"]');
        var radioRoundTrip = document.getElementById('gidisdonus');

        if (radioRoundTrip.checked) {
            returnDateInput.disabled = false; // Gidiş-dönüş seçeneği seçiliyse dönüş tarihi alanını etkinleştir
        } else {
            returnDateInput.disabled = true; // Gidiş-dönüş seçeneği seçili değilse dönüş tarihi alanını devre dışı bırak
        }
    }
    window.onload = function() {
    neredenDegisti(); // Sayfa yüklendiğinde çalıştır
    document.getElementById("sehirNereden").addEventListener("change", neredenDegisti); // Nereden seçimi değiştiğinde çalıştır

    // Tek yönlü seçeneği otomatik olarak işaretle
    document.getElementById("tekyon").checked = true;
    disableReturnDate(); // Dönüş tarihini devre dışı bırak veya etkinleştir
};


</script>



