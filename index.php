<!DOCTYPE html>
<html>
<head>
    <title>Sistem Pengaduan Mahasiswa</title>
    <link rel="shortcut icon" href="img/logo.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <link href="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">

    <style>
        body {
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
            transition: background 1s ease-in-out;
            height: 100vh;
            margin: 0;
        }
        html {
            height: 100%;
        }
    </style>
</head>
<body>

    <div class="container">
        <?php 
            include 'conn/koneksi.php';
            if(@$_GET['p']==""){
                include_once 'login.php';
            }
            elseif(@$_GET['p']=="login"){
                include_once 'login.php';
            }
            elseif(@$_GET['p']=="logout"){
                include_once 'logout.php';
            }
        ?>
    </div>

    <script>
        // Daftar gambar untuk latar belakang
        const backgrounds = [
            'img/bg.jpg',
            'img/bg3.jpg',
            'img/bg4.jpg',
        ];

        let currentIndex = 0;

        function changeBackground() {
            // Ganti latar belakang
            document.body.style.backgroundImage = `url('${backgrounds[currentIndex]}')`;

            // Update index ke gambar berikutnya
            currentIndex = (currentIndex + 1) % backgrounds.length;
        }

        // Ganti latar belakang setiap 5 detik
        setInterval(changeBackground, 5000);

        // Set latar belakang pertama saat halaman dimuat
        changeBackground();
    </script>

    <script src="js/popper.min.js"></script>
</body>
</html>
