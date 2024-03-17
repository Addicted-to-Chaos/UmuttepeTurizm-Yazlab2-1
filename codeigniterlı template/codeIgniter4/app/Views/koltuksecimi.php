<?php $session=session();?>
<?php
$sefer_id = $_GET['sefer_id'];

?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      background-color: #f2f2f2;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .content-wrapper{
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background-color: #f2f2f2;
      margin: -50px 0 0;
    }

    .bus-layout {
      background-color: #d9d9d9;
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
    h2#hesap-basligi {
  color: #3498db;
    }
  </style>
  <title>Otobüs Koltuk Seçimi</title>
</head>
<body>
<h2 id="hesap-basligi" style="text-align:center;">KOLTUK SEÇİMİ</h2>

<?php

use App\Models\UserModelBiletler;

//seferler getir bilet ata koltuk seç


    $bilet = $biletler->where('Sefer_id', $sefer_id);
    

?>


<div class="content-wrapper">
<div class="text-center mt-4">
        <a href="#" onclick="history.back();" class="back-btn">Geri Dön</a>
         </div>
  <div class="bus-layout">
    <div class="row">
      <div class="seat" id="seat-23"><p style="text-align: center;">23</p></div>
      <div class="seat" id="seat-20"><p style="text-align: center;">20</p></div>
      <div class="seat" id="seat-17"><p style="text-align: center;">17</p></div>
      <div class="seat" id="seat-16"><p style="text-align: center;">16</p></div>
      <div class="seat" id="seat-13"><p style="text-align: center;">13</p></div>
      <div class="seat" id="seat-10"><p style="text-align: center;">10</p></div>
      <div class="seat" id="seat-7"><p style="text-align: center;">7</p></div>
      <div class="seat" id="seat-4"><p style="text-align: center;">4</p></div>
      <div class="seat" id="seat-1"><p style="text-align: center;">1</p></div>
      <hr style="border-width: 3px; border-color: rgb(190, 192, 199);" >
      <img src="assets/img/direksiyon.png" height="60" width="60"/>
    </div>
    <div class="row2">
      <div class="empty-space2"></div>
    </div>
    <div class="row">
      <div class="seat" id="seat-23"><p style="text-align: center;">24</p></div>
      <div class="seat" id="seat-20"><p style="text-align: center;">21</p></div>
      <div class="seat" id="seat-18"><p style="text-align: center;">18</p></div>
      <img src="assets/img/kapi.png" height="60" width="60"/>
      <div class="seat" id="seat-14"><p style="text-align: center;">14</p></div>
      <div class="seat" id="seat-11"><p style="text-align: center;">11</p></div>
      <div class="seat" id="seat-8"><p style="text-align: center;">8</p></div>
      <div class="seat" id="seat-5"><p style="text-align: center;">5</p></div>
      <div class="seat" id="seat-2"><p style="text-align: center;">2</p></div>
      <hr>
      <img src="assets/img/kapi.png" height="60" width="60"/>
    </div>
    <div class="row">
      <div class="seat" id="seat-25"><p style="text-align: center;">25</p></div>
      <div class="seat" id="seat-22"><p style="text-align: center;">22</p></div>
      <div class="seat" id="seat-19"><p style="text-align: center;">19</p></div>
      <img src="assets/img/kapi.png" height="60" width="60"/>
      <div class="seat" id="seat-15"><p style="text-align: center;">15</p></div>
      <div class="seat" id="seat-12"><p style="text-align: center;">12</p></div>
      <div class="seat" id="seat-9"><p style="text-align: center;">9</p></div>
      <div class="seat" id="seat-6"><p style="text-align: center;">6</p></div>
      <div class="seat" id="seat-3"><p style="text-align: center;">3</p></div>
      <hr>
      <img src="assets/img/kapi.png" height="60" width="60"/>
    </div>
    <!-- Daha fazla sıra eklemek için aynı yapının kopyalarını ekleyebilirsiniz -->
  </div>
  <button id="confirmButton" style="position: fixed; bottom: 20px; right: 20px;">Confirm Selection</button>
  <div class="text-center mt-4">
  <button id="confirmButton" style="position: fixed; bottom: 20px; right: 20px;">Confirm Selection</button>
      
         </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    const seats = document.querySelectorAll('.seat');
    let lastClickedSeatId = null; // Son tıklanan koltuğun ID'sini saklamak için değişken

    seats.forEach(seat => {
      seat.addEventListener('click', function () {
        if (!seat.classList.contains('driver-seat')) {
          if (lastClickedSeatId) {
            // Eğer zaten bir koltuk seçildiyse, seçilen koltuğun rengini eski haline getir
            const lastClickedSeat = document.getElementById(lastClickedSeatId);
            lastClickedSeat.classList.remove('secili');
          }
          // Son tıklanan koltuğun ID'sini güncelle
          lastClickedSeatId = this.id;
          seat.classList.add('secili');
        }
      });
    });
  });

    const seats = document.querySelectorAll('.seat');

seats.forEach(seat => {
  seat.addEventListener('click', function() {
    const seatId = this.id;
    // "seat-" kısmını kaldırarak sadece numarayı alın
    const seatNumber = seatId.split('-')[1];
    console.log('Tıklanan koltuğun numarası:', seatNumber);
  });
});
  
</script>
</body>

</html>
