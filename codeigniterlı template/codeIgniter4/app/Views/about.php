<?php
namespace about
?>
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
                                <a href="biletlerim" class="dropdown-item"><i class="fas fa-cog me-2"></i> Biletlerim</a>
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
                        <a href="<?= site_url('/about') ?>" class="nav-item nav-link  active">Hakkımızda</a>
                        <a href="<?= site_url('/services') ?>" class="nav-item nav-link">Hizmetlerimiz</a>
                        <a href="<?= site_url('/contact') ?>" class="nav-item nav-link">İletişim</a>
                       
                       
                    </div>
                    <a href="<?= site_url('/buyTicket') ?>" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Bilet Al</a>
                </div>
            </nav>

        </div>
        <!-- Navbar & Hero End -->

        <!-- Header Start -->
        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Hakkımızda</h1>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Ana Saya</a></li>
                    <li class="breadcrumb-item active text-white">Hakkımızda</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->

        <!-- About Start -->
        <div class="container-fluid about py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-5">
                        <div class="h-100" style="border: 50px solid; border-color: transparent #13357B transparent #13357B;">
                            <img src="assets/img/about-img2.jpg" class="img-fluid w-100 h-100" alt="">
                        </div>
                    </div>
                    <div class="col-lg-7" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(assets/img/about-img-1.png);">
                        <h5 class="section-about-title pe-3">Hakkımızda</h5>
                        <h1><span class="text-primary">Umuttepe Turizm'e </span><span class="mb-4" >Hoşgeldiniz</span></h1>
                        <p class="mb-4">

                            Şehirlerarası seyahat deneyimlerinizin güvenilir ve konforlu bir şekilde gerçekleşmesini sağlamak için buradayız. Umuttepe Turizm sektördeki deneyimi ve tutkusuyla ön plana çıkan bir otobüs firmasıdır. Misafir memnuniyetini odak noktası haline getirerek, seyahatlerinizi unutulmaz kılmak için çalışıyoruz.
                            <br>
                            <h3 class="text-primary">Vizyonumuz : </h3>
                            
                            Sektördeki liderliği elde ederek, müşterilerimize en kaliteli ve güvenli seyahat deneyimini sunmaktır. Yenilikçi çözümlerle dolu bir gelecek inşa etmek, sürdürülebilir bir ulaşım hizmeti sunmak ve toplumumuza değer katmak için çabalıyoruz.
                            
                            <h3 class="text-primary">Misyonumuz :</h3>
                            
                            Her bir yolcumuzun güvenliğini ve konforunu sağlamak, zamanında ve güvenilir bir şekilde hizmet sunmak ve sektörde öncü bir marka olarak müşteri memnuniyetini en üst düzeye çıkarmak için varız. Ekibimiz, her bir seyahati unutulmaz kılmak adına titizlikle çalışmaktadır.
                    

                        </p>
                        
                        <div class="row gy-2 gx-4 mb-4">
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Konforlu ve Modern Araç Filosu</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Esnek Bilet Seçenekleri</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>7/24 Ulaşım İmkanı</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Yolculukta Yiyecek ve İçecek Hizmetleri</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Wi-Fi ve Eğlence Sistemleri</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Rezervasyon Kolaylığı</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <!-- Travel Guide Start -->
        <div class="container-fluid guide py-5">
            <div class="container py-5">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <h5 class="section-title px-3">EKİBİMİZ</h5>
                    <h1 class="mb-0">Şoförlerimiz Hakkında</h1>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="guide-item">
                            <div class="guide-img">
                                <div class="guide-img-efects">
                                    <img src="assets/img/guide-1.jpg" class="img-fluid w-100 rounded-top" alt="Image">
                                </div>
                                <div class="guide-icon rounded-pill p-2">
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="guide-title text-center rounded-bottom p-4">
                                <div class="guide-title-inner">
                                    <h4 class="mt-3">Full Name</h4>
                                    <p class="mb-0">Designation</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="guide-item">
                            <div class="guide-img">
                                <div class="guide-img-efects">
                                    <img src="assets/img/guide-2.jpg" class="img-fluid w-100 rounded-top" alt="Image">
                                </div>
                                <div class="guide-icon rounded-pill p-2">
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="guide-title text-center rounded-bottom p-4">
                                <div class="guide-title-inner">
                                    <h4 class="mt-3">Full Name</h4>
                                    <p class="mb-0">Designation</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="guide-item">
                            <div class="guide-img">
                                <div class="guide-img-efects">
                                    <img src="assets/img/guide-3.jpg" class="img-fluid w-100 rounded-top" alt="Image">
                                </div>
                                <div class="guide-icon rounded-pill p-2">
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="guide-title text-center rounded-bottom p-4">
                                <div class="guide-title-inner">
                                    <h4 class="mt-3">Full Name</h4>
                                    <p class="mb-0">Designation</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="guide-item">
                            <div class="guide-img">
                                <div class="guide-img-efects">
                                    <img src="assets/img/guide-4.jpg" class="img-fluid w-100 rounded-top" alt="Image">
                                </div>
                                <div class="guide-icon rounded-pill p-2">
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                    <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                            <div class="guide-title text-center rounded-bottom p-4">
                                <div class="guide-title-inner">
                                    <h4 class="mt-3">Full Name</h4>
                                    <p class="mb-0">Designation</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Travel Guide End -->

        <!-- Subscribe Start -->
        <div class="container-fluid subscribe py-5">
            <div class="container text-center py-5">
                <div class="mx-auto text-center" style="max-width: 900px;">
                    <h5 class="subscribe-title px-3">Abone Olun</h5>
                    <h1 class="text-white mb-4">Email Bülteni</h1>
                    <p class="text-white mb-5">İndirimlerden haberdar olmak için bültenimize abone olmayı unutmayın.
                    </p>
                    <div class="position-relative mx-auto">
                        <input class="form-control border-primary rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="E-mail">
                        <button type="button" class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 px-4 mt-2 me-2">Abone Ol</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Subscribe End -->

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