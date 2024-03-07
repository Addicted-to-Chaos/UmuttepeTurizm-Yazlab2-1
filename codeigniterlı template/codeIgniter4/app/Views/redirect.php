<!-- redirect.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
    <script>
        setTimeout(function() {
            window.location.href = "<?php echo site_url('/login'); ?>"; // Yönlendirme yapılacak sayfa
        }, 2000); // 2 saniye bekleme
    </script>
</head>
<body>
    <p>Kayıt Başarılı. Yönlendiriliyorsunuz...</p>
</body>
</html>
