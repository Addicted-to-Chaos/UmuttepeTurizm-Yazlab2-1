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
    <form>
        <h2>Kayıt Ol</h2>

        <div class="form-row">
            <div class="form-column">
                <label for="register-name">Ad:</label>
                <input type="text" id="register-name" name="register-name" required>
            </div>

            <div class="form-column">
                <label for="register-surname">Soyad:</label>
                <input type="text" id="register-surname" name="register-surname" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="register-birthdate">Doğum Tarihi:</label>
                <input type="date" id="register-birthdate" name="register-birthdate" required>
            </div>

            <div class="form-column">
                <label for="register-gender">Cinsiyet:</label>
                <select id="register-gender" name="register-gender" required>
                    <option value="" disabled selected>Cinsiyet seçin</option>
                    <option value="male">Erkek</option>
                    <option value="female">Kadın</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-column">
                <label for="register-email">E-posta:</label>
                <input type="email" id="register-email" name="register-email" required>
            </div>

            <div class="form-column">
                <label for="register-id">TC Kimlik No:</label>
                <input type="text" id="register-id" name="register-id" pattern="[0-9]{11}"  required>
            </div>
        </div>

        <div class="form-row">
            <label for="register-phone">Telefon:</label>
            <input type="tel" id="register-phone" name="register-phone" required>
        </div>

        <input type="submit" value="Kayıt Ol">

        <p class="center-text">Hesabınız var mı? <a href="<?= site_url('/login') ?>" class="register-link" style="color: rgb(57, 82, 131);" >Giriş Yap</a></p>
    </form>
</body>
</html>
