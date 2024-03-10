<html>

<head>

<style>
* {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: #DDD;
            font-family: 'Inknut Antiqua', serif;
            font-family: 'Ravi Prakash', cursive;
            font-family: 'Lora', serif;
            font-family: 'Indie Flower', cursive;
            font-family: 'Cabin', sans-serif;
            margin: 0; /* Reset default margin */
        }

        h1 {
            color: #3498db;
            text-align: center;
        }

        .container {
            max-width: 1350px;
            margin: 0 auto;
            overflow: hidden;
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

        .form-row {
            margin-bottom: 15px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .form-column {
            width: calc(50% - 5px);
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
            color: #fff;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
            font-size: 16px;
        }

        a:hover {

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
    color: #3498db; /* Change this to the desired blue color */
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
  color: #3498db;
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