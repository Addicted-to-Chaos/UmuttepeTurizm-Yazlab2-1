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
</style>
</head>


<body>

    <div class="left-menu">

        <h2 id="hesap-basligi">Hesap</h2>
        <br>
                <!-- Menu items go here -->
                <a href="hesabim" class="menu-item">Kullanıcı Bilgilerim </a>
                <hr>
                <a  href="" class="menu-item active">Bilet Bilgilerim</a>
                <hr>
                <a  href="" class="menu-item">Ödeme ve Fatura</a>
                <hr>
        <a class="menu-item" href="<?php echo site_url('/'); ?>">Ana Sayfa</a>
        <hr>
        <a class="menu-item" href="<?php echo site_url('/cikisYap'); ?>">Çıkış Yap</a>
        <hr>
        </div>

    <div class="content-wrapper">
        <div class="container">
            <h2 id="hesap-basligi" style="text-align:center;">BİLETLERİM</h2>

            <br><br>
            <!--BİLET 1-->
  <div class="item">
    <div class="item-left">
      <h3>Ankara -> Bursa </h3><br>
      <hr>
      <div class="sce">
        <div class="icon">
          <i class="fa fa-table"></i>
        </div>
      </div>
      <div class="fix"></div>
      <div class="loc">
        <div class="icon">
          <i class="fa fa-map-marker"></i>
        </div>
        <p><b>PNR Kodu:</b> 12345678</p>
        <p>Sefer Tarihi : 2024-03-29<br/> 
            Saat: 12:00:00 <br> 
            Peron no: 30 <br> 
            Koltuk no: 5 <br> 
            Bilet Durumu : Rezerve <br> 
      </div>
      <div class="fix"></div>
    </div> 
  </div> <!-- bilet 1 son -->
  
  <!--BİLET 2-->
  <div class="item">
    <div class="item-left">
        <h3>Ankara -> Bursa </h3><br>
        <hr>
        <div class="sce">
          <div class="icon">
            <i class="fa fa-table"></i>
          </div>
        </div>
        <div class="fix"></div>
        <div class="loc">
          <div class="icon">
            <i class="fa fa-map-marker"></i>
          </div>
          <p><b>PNR Kodu:</b> 12345678</p>
          <p>Sefer Tarihi : 2024-03-29<br/> 
              Saat: 12:00:00 <br> 
              Peron no: 30 <br> 
              Koltuk no: 5 <br> 
              Bilet Durumu : Rezerve <br> 
        </div>
        <div class="fix"></div>
      </div>
  </div> <!-- bilet 2 son -->


   <!--BİLET 3-->
   <div class="item">
    <div class="item-left">
        <h3>Ankara -> Bursa </h3><br>
        <hr>
        <div class="sce">
          <div class="icon">
            <i class="fa fa-table"></i>
          </div>
        </div>
        <div class="fix"></div>
        <div class="loc">
          <div class="icon">
            <i class="fa fa-map-marker"></i>
          </div>
          <p><b>PNR Kodu:</b> 12345678</p>
          <p>Sefer Tarihi : 2024-03-29<br/> 
              Saat: 12:00:00 <br> 
              Peron no: 30 <br> 
              Koltuk no: 5 <br> 
              Bilet Durumu : Rezerve <br> 
        </div>
        <div class="fix"></div>
      </div>
  </div> <!-- bilet 3 son -->
        </div>
    </div>

</body>

</html>