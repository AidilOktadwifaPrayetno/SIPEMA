<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pengaduan_mahasiswa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = isset($_POST['password']) ? $_POST['password'] : null; // Tidak mengenkripsi password
    $telp = mysqli_real_escape_string($conn, $_POST['telp']);

    // Validasi sederhana
    if (empty($nim) || empty($nama) || empty($username) || empty($_POST['password']) || empty($telp)) {
        echo "<script>alert('Semua field harus diisi.');</script>";
    } else {
        // Periksa apakah username sudah ada
        $checkUsername = "SELECT * FROM mahasiswa WHERE username = '$username'";
        $result = $conn->query($checkUsername);

        if ($result->num_rows > 0) {
            echo "<script>alert('Username sudah digunakan.');</script>";
        } else {
            // Masukkan data ke database
            $sql = "INSERT INTO mahasiswa (nim, nama, username, password, telp) VALUES ('$nim', '$nama', '$username', '$password', '$telp')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Registrasi berhasil!');</script>";
            } else {
                echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Mahasiswa</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
    <div class="card" style="padding: 50px; width: 60%; margin: 0 auto; margin-top: 10%;">
        <h4 style="text-align: center;" class="orange-text">Sistem Pengaduan Mahasiswa</h4><br>
        <h4 style="text-align: center;" class="orange-text">Register Mahasiswa</h4><br>
        <form method="POST">
            <div class="input_field">
                <label for="nim">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                    </svg></i> NIM </label>
                <input id="nim" type="text" name="nim" required>
            </div>
            <div class="input_field">
                <label for="nama">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                    </svg> Nama </label>
                <input id="nama" type="text" name="nama" required>
            </div>
            <div class="input_field">
                <label for="username">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                    </svg> Username </label>
                <input id="username" type="text" name="username" required>
            </div>
            <div class="input_field">
                <label for="password">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                    </svg> Password</label>
                <input id="password" type="password" name="password" required>
            </div>
            <div class="input_field">
                <label for="telp">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-phone-fill" viewBox="0 0 16 16">
                        <path d="M2 2a1 1 0 0 1 1-1h2.153a1 1 0 0 1 1.098-1h2.153a1 1 0 0 1 1.098 1h3.102a1 1 0 0 1 1.098 1v10.293a1 1 0 0 1-1.098 1H10.153a1 1 0 0 1-1.098-1h-3.102a1 1 0 0 1-1.098-1V2z"/>
                    </svg> No. Telepon</label>
                <input id="telp" type="text" name="telp" required>
            </div>
            <input type="submit" name="register" value="Register" class="btn orange" style="width: 100%;">
            <p>Sudah punya akun? <a href="index.php">Login</a></p>
        </form>
    </div>
</body>
</html>
