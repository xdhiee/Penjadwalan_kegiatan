<?php
include 'koneksi.php'; // Menghubungkan ke database

// Variabel untuk menyimpan hasil query
$results = null;

// Mengecek jika form dikirim dan tanggal dipilih
if (isset($_POST['tanggal'])) {
    $tanggal = $_POST['tanggal']; // Mendapatkan nilai tanggal yang dipilih
    
    // Query untuk mengambil data kegiatan berdasarkan tanggal
    $sql = "SELECT * FROM kegiatan WHERE tanggal = '$tanggal'";
    $results = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Jadwal</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <header>
        <h1>Lihat Jadwal Kegiatan</h1>
    </header>
    <main>
        <div class="schedule-container">
            <h2>Jadwal Kegiatan</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="date">Cari berdasarkan tanggal:</label>
                    <input type="date" id="tanggal" name="tanggal" required>
                </div>
                <div class="center">
                    <button type="submit" class="btn">Cari</button>
                </div>
                <div class="center">
                    <a href="index.php" class="btn keluar-btn">Keluar</a>
                </div>
            </form>

            <div id="schedule-results" class="results">
                <!-- Hasil jadwal akan ditampilkan di sini -->
                <?php if ($results && $results->num_rows > 0): ?>
                    <ul>
                        <?php while ($row = $results->fetch_assoc()): ?>
                            <li>
                                <strong><?php echo htmlspecialchars($row['title']); ?></strong><br>
                                Tanggal: <?php echo htmlspecialchars($row['tanggal']); ?><br>
                                Deskripsi: <?php echo htmlspecialchars($row['description']); ?>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php elseif ($results && $results->num_rows == 0): ?>
                    <p>Tidak ada kegiatan pada tanggal tersebut.</p>
                <?php else: ?>
                    <p>Masukkan tanggal untuk melihat jadwal kegiatan.</p>
                <?php endif; ?>
            </div>
            
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Penjadwalan Kegiatan. Semua Hak Dilindungi.</p>
    </footer>
</body>
</html>
