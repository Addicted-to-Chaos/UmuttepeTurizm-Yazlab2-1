<?php $session=session(); ?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ödeme başarılı yönlendiriliyorsunuz...</title>

    <script>
        setTimeout(function() {
            window.location.href = "<?= site_url('/biletlerim') ?>"; 
        }, 0.00000000000001); 
    </script>
</head>
<body>
    <p>Ödeme başarılı yönlendiriliyorsunuz...</p>
</body>
</html>
