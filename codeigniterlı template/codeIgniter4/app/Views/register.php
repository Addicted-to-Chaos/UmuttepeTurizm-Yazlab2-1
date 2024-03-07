<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(222, 233, 244);
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .center-text {
        text-align: center;
     }
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: left;
        }

        h2 {
            color: rgb(57, 82, 131);
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: rgb(57, 82, 131);
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: rgb(57, 82, 131);
        }

        .register-link {
            color: rgb(57, 82, 131);
            text-decoration: none;
            margin-top: 10px;
            display: inline-block;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        .form-row {
            margin-bottom: 15px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .form-column {
            width: calc(50% - 5px); /* %50 genişlikte, aralarında 10px boşluk */
        }
    </style>
</head>
<body>
    <form action="<?php echo site_url('/kayitOl'); ?>" method="post">
  
    <h2>Kayıt Ol</h2>

        <div class="form-row">
            <div class="form-column">
                <label for="Ad">Ad:</label>
                <input type="text" id="Ad" name="Ad" required>
            </div>

            <div class="form-column">
                <label for="Soyad">Soyad:</label>
                <input type="text" id="Soyad" name="Soyad" required>
            </div>
        </div>

       <div class="form-row">
            <div class="form-column">
                <label for="Yas">Doğum Tarihi:</label>
                <input type="date" id="Yas" name="Yas" required>
            </div>

            <div class="form-column">
                <label for="Cinsiyet">Cinsiyet:</label>
                <select id="Cinsiyet" name="Cinsiyet" required>
                    <option value="" disabled selected>Cinsiyet seçin</option>
                    <option value="Erkek">Erkek</option>
                    <option value="Kadın">Kadın</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="Email">E-posta:</label>
                <input type="email" id="Email" name="Email" required>
            </div>

            <div class="form-column">
                <label for="Tc">TC Kimlik No:</label>
                <input type="text" id="Tc" name="Tc" pattern="[0-9]{11}"  required>
            </div>
        </div>

        <div class="form-row">
            <label for="Telefon">Telefon:</label>
            <input type="tel" id="Telefon" name="Telefon" required>
        </div>
        <div class="form-row">
            <label for="Sifre">Şifre:</label>
            <input type="password" id="Sifre" name="Sifre" required>
        </div>
     <!--   <input type="submit" name="kaydet" value="Kayıt Ol">-->
     <div class="form-row">
     <button type="submit" class="btn btn-primary" name="kaydet">Kayıt Ol</button>
        </div>
    


        <p class="center-text">Hesabınız var mı? <a href="<?= site_url('/index') ?>" class="register-link" style="color: rgb(57, 82, 131);" >Giriş Yap</a></p>
    </form>
    
</body>
</html>
