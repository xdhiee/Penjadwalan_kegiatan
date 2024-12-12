<?php
include 'koneksi.php'; // Hubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $tanggal = $_POST['tanggal'];
    $lokasi = $_POST['lokasi'];
    $description = $_POST['description'];

    // Query untuk menambahkan data
    $sql = "INSERT INTO kegiatan (title, tanggal, lokasi, description) 
            VALUES ('$title','$tanggal','$lokasi', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Kegiatan berhasil ditambahkan!";
        header("Location: index.php");
        exit(); // Hentikan eksekusi skrip setelah redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <header>
        <h1>Tambah Kegiatan</h1>
        <form action="Tambah_Kegiatan.php" method="POST">
    </header>
    <main>
        <div class="form-container">
            <h2>Formulir Tambah Kegiatan</h2>
                <div class="form-group">
                    <label for="title">Judul Kegiatan</label>
                    <input type="text" id="title" name="title" placeholder="Masukkan judul kegiatan" required>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" required>
                </div>
                <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" id="lokasi" name="lokasi" placeholder="Masukkan lokasi kegiatan" required>
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" rows="4" placeholder="Masukkan deskripsi kegiatan" required></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">Tambah Kegiatan</button>
                    
                </div>
                <div class="center">
                <a href="index.php" class="btn_keluar">Keluar</a>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Penjadwalan Kegiatan. Semua Hak Dilindungi.</p>
    </footer>
</body>
</html>
