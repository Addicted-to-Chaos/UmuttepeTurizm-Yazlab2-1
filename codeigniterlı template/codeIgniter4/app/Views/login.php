<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
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

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            color: rgb(57, 82, 131);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            text-align: left;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
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
            background-color: rgb(57, 82, 131);
        }
    </style>
</head>
<body>
    <h3><?php $session=session(); echo $session ->getFlashdata('login'); ?></h3>
    <form action="<?php echo site_url('/girisYap'); ?>" method="post">
        <h2>Giriş Yap</h2>
        <label for="Email">E-mail:</label>
        <input type="email" id="Email" name="Email" required>

        <label for="Sifre">Şifre:</label>
        <input type="password" id="Sifre" name="Sifre" required>

        <div class="form-row">
     <button type="submit" class="btn btn-primary" name="kaydet">Giriş Yap</button>
        </div>
        
        <p>Hesabınız yok mu? <a href="register" class="register-link">Kayıt Ol</a></p>
    </form>
</body>
</html>
