<?php
$host    = 'localhost';
$dbname   = 'fict';                 // Sesuaikan dengan nama database Anda
$username = 'fict_app';             // Username database (default XAMPP: root)
$password = '';             // Password database (default ELU)

try {
    // Membuat koneksi PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Set mode error PDO ke Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Tampilkan pesan jika terjadi kesalahan koneksi
    die("Koneksi gagal: " . $e->getMessage());
}
?>