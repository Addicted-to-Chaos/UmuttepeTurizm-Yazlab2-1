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

        input[type="submit"] {
            background-color:rgb(57, 82, 131);
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
    </style>
</head>
<body>
    <form>
        <h2>Giriş Yap</h2>
        <label for="login-email">E-mail:</label>
        <input type="email" id="login-email" name="login-email" required>

        <label for="login-password">Şifre:</label>
        <input type="password" id="login-password" name="login-password" required>

        <input type="submit" value="Login">
        
        <p>Hesabınız yok mu? <a href="register.html" class="register-link">Kayıt Ol</a></p>
    </form>
</body>
</html>
