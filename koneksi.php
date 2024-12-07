<?php
$host = "localhost"; // Server MySQL (biasanya localhost)
$user = "root"; // Username MySQL
$password = ""; // Password MySQL (default kosong untuk XAMPP)
$database = "penjadwalan_kegiatan"; // Nama database

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
