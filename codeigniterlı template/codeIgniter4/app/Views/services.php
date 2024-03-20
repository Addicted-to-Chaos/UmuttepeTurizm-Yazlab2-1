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
                        <a href="<?= site_url('/about') ?>" class="nav-item nav-link">Hakkımızda</a>
                        <a href="<?= site_url('/services') ?>" class="nav-item nav-link active">Hizmetlerimiz</a>
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
                <h3 class="text-white display-3 mb-4">Hizmetlerimiz</h1>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="<?= site_url('/') ?>">Ana Sayfa</a></li>
                    <li class="breadcrumb-item active text-white">Hizmetlerimiz</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->

        <!-- Services Start -->
        <div class="container-fluid bg-light service py-5">
            <div class="container py-5">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <h5 class="section-title px-3">Hizmetler</h5>
                    <h1 class="mb-0">Hizmetlerimiz</h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0">
                                    <div class="service-content text-end">
                                        <h5 class="mb-4">Rezervasyon İmkanı</h5>
                                        <p class="mb-0">Seyahatinizi önceden planlama şansı sunan online rezervasyon sistemimizle, istediğiniz koltuğu seçebilir ve yolculuğunuzu kolayca organize edebilirsiniz. Hızlı, güvenilir ve kullanıcı dostu rezervasyon hizmetimizle müşterilerimize zaman kazandırıyoruz.
                                        </p>
                                    </div>
                                    <div class="service-icon p-4">
                                        <!-- Replace the Font Awesome user icon with your PNG image -->
                                        <img src="assets/img/rezervasyon.png" width="400" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="service-content-inner d-flex align-items-center  bg-white border border-primary rounded p-4 pe-0">
                                    <div class="service-content text-end">
                                        <h5 class="mb-4">Otobüs İçerisinde Yiyecek İçecek Hizmeti</h5>
                                        <p class="mb-0">Yolculuğunuz boyunca açlık hissetmeyeceğiniz bir deneyim sunmak için, geniş bir yiyecek ve içecek yelpazesi sunuyoruz. Kaliteli ve taze ürünlerle donatılmış olan otobüslerimizde, lezzetli atıştırmalıklar ve içecekler bulabilirsiniz.
                                        </p>
                                    </div>
                                    <div class="service-icon p-4">
                                        <!-- Replace the Font Awesome user icon with your PNG image -->
                                        <img src="assets/img/yemek.png" width="250" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0">
                                    <div class="service-content text-end">
                                        <h5 class="mb-4">Ücretsiz WiFi</h5>
                                        <p class="mb-0">Yolculuklarınızı daha bağlantılı hale getirmek için otobüs içinde ücretsiz WiFi hizmetimizden faydalanabilirsiniz. İster işle ilgili işleri halledin, ister sosyal medyada vakit geçirin; sürekli internet erişimi ile bağlantınızı koparmıyoruz.
                                        </p>
                                    </div>
                                    <div class="service-icon p-4">
                                        <!-- Replace the Font Awesome user icon with your PNG image -->
                                        <img src="assets/img/wifi.png" width="250" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 pe-0">
                                    <div class="service-content text-end">
                                        <h5 class="mb-4">7/24 Çalışıyoruz</h5>
                                        <p class="mb-0">Acil durumlar veya beklenmedik plan değişiklikleri için 7/24 ulaşılabilir müşteri hizmetleri ekibimizle her an destek alabilirsiniz. Sorularınızı yanıtlamaktan ve ihtiyaçlarınıza anında çözüm bulmaktan memnuniyet duyuyoruz.
                                        </p>
                                    </div>
                                    <div class="service-icon p-4">
                                        <!-- Replace the Font Awesome user icon with your PNG image -->
                                        <img src="assets/img/7-24.png" width="250" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                                    <div class="service-icon p-4">
                                        <!-- Replace the Font Awesome user icon with your PNG image -->
                                        <img src="assets/img/koltuk.png" width="250" class="img-fluid">
                                    </div>
                                    <div class="service-content">
                                        <h5 class="mb-4">Konforlu Koltuk Düzeni</h5>
                                        <p class="mb-0"> Yolculuklarınızı daha keyifli hale getirmek için özel tasarlanmış konforlu koltuklarımız ile seyahat edin. Geniş aralıklarla yerleştirilmiş koltuklarımız, uzun yolculuklarda bile rahat bir deneyim sunar.
                                        </p><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                                    <div class="service-icon p-4">
                                        <!-- Replace the Font Awesome user icon with your PNG image -->
                                        <img src="assets/img/guvenlik.png" width="250" class="img-fluid">
                                    </div>
                                    <div class="service-content">
                                        <h5 class="mb-4">Güvenlik Öncelikli Araçlar</h5>
                                        <p class="mb-0">Yolcularımızın güvenliği bizim için en önemli önceliktir. Son model araçlarımız, güvenlik standartlarına tam uyumlu olup, uzman sürücülerimiz tarafından yönetilmektedir. Sorunsuz ve güvenli bir seyahat için bize güvenebilirsiniz.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                                    <div class="service-icon p-4">
                                        <!-- Replace the Font Awesome user icon with your PNG image -->
                                        <img src="assets/img/indirim.png" width="250" class="img-fluid">
                                    </div>
                                    <div class="service-content">
                                        <h5 class="mb-4">Özel İndirimler ve Kampanyalar</h5>
                                        <p class="mb-0">Müşteri memnuniyetini ön planda tutarak, düzenlediğimiz özel indirimler ve kampanyalarla yolculuk maliyetinizi düşürüyoruz. Her bütçeye uygun seyahat imkanları için sıkça güncellenen kampanya seçeneklerimizi takip edin</p><br>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="service-content-inner d-flex align-items-center bg-white border border-primary rounded p-4 ps-0">
                                    <div class="service-icon p-4">
                                        <!-- Replace the Font Awesome user icon with your PNG image -->
                                        <img src="assets/img/ekran.png" width="200" class="img-fluid">
                                    </div>
                                    <div class="service-content">
                                        <h5 class="mb-4">Bilgilendirme Ekranları</h5>
                                        <p class="mb-0">Yolculuk sırasında güzergah, varış saatleri, hava durumu gibi bilgileri içeren bilgilendirme ekranları, müşterilerimize daha bilinçli ve keyifli bir seyahat deneyimi sunar.
                                        </p><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Services End -->

        <div class="container-fluid testimonial py-5">
            <div class="container py-5">
                <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                    <h5 class="section-title px-3">Referanslarımız</h5>
                    <h1 class="mb-0">Müşteri Yorumlarımız</h1>
                </div>
                <div class="testimonial-carousel owl-carousel">
                    <div class="testimonial-item text-center rounded pb-4">
                        <div class="testimonial-comment bg-light rounded p-4">
                            <p class="text-center mb-5"><br>Harika bir seyahat deneyimi yaşadım! Otobüsler son teknolojiyle donatılmış, rahat koltuklar ve geniş iç mekan ile seyahat etmek gerçekten keyifliydi. Personel nazik ve yardımseverdi. Kesinlikle tekrar tercih edeceğim
                            </p>
                        </div>
                        <br><br>
                        <div style="margin-top: -35px;">
                            <h5 class="mb-0">Lale Göksoy</h5>
                            <p class="mb-0">Ankara</p>
                            <div class="d-flex justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item text-center rounded pb-4">
                        <div class="testimonial-comment bg-light rounded p-4">
                            <p class="text-center mb-5"><br>Uzun bir yolculuktan sonra bile taze ve enerjik hissettim. Otobüslerin hijyen standartları gerçekten etkileyiciydi. Yolculuk boyunca temiz tuvaletler ve düzenli mola noktaları sayesinde rahat ettim. Teşekkürler
                            </p>
                        </div>
                        <br><br>
                        <div style="margin-top: -35px;">
                            <h5 class="mb-0">Fatma Mutluer</h5>
                            <p class="mb-0">Bursa</p>
                            <div class="d-flex justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item text-center rounded pb-4">
                        <div class="testimonial-comment bg-light rounded p-4">
                            <p class="text-center mb-5"><br>Firmaya her seferinde güveniyorum. Her seyahatimde zamanında hareket edildi ve belirlenen varış saatlerine tam olarak uyuldu. Bu benim için son derece önemli. Ayrıca, bilet fiyatları da oldukça makul. Kesinlikle tavsiye ederim
                            </p>
                        </div>
                        <br><br>
                        <div style="margin-top: -35px;">
                            <h5 class="mb-0">Özkan Doruk</h5>
                            <p class="mb-0">Kocaeli</p>
                            <div class="d-flex justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item text-center rounded pb-4">
                        <div class="testimonial-comment bg-light rounded p-4">
                            <p class="text-center mb-5"><br>Konforlu koltuklar ve hızlı Wi-Fi bağlantısıyla, uzun yolculuklar bile keyifli hale geliyor. Ayrıca, personelin samimiyeti ve misafirperverliği, benim için bu deneyimi unutulmaz kılıyor. Herkese gönül rahatlığıyla tavsiye ederim
                            </p>
                        </div>
                        <br><br>

                        <div style="margin-top: -35px;">
                            <h5 class="mb-0">Furkan Özyurt</h5>
                            <p class="mb-0">İstanbul</p>
                            <div class="d-flex justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->

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
                        <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">UmuttepeTurizm</a>, Bu bir parodi sitesidir.
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