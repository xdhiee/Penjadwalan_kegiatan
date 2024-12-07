<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "penjadwalan_kegiatan"; // Nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Variabel untuk pesan dan hasil pencarian
$activity = null;
$message = "";

// Proses pencarian kegiatan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-title'])) {
    $search_title = $_POST['search-title'];

    // Query untuk mencari kegiatan berdasarkan judul
    $sql = "SELECT * FROM kegiatan WHERE title = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $search_title);
    $stmt->execute();
    $result = $stmt->get_result();
    $activity = $result->fetch_assoc();
    $stmt->close();


    if (!$activity) {
        $message = "Kegiatan dengan judul tersebut tidak ditemukan.";
    }
}

// Proses pembatalan kegiatan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel-id'])) {
    $cancel_id = $_POST['cancel-id'];

    // Query untuk menghapus kegiatan
    $sql = "DELETE FROM kegiatan WHERE id_kegiatan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cancel_id);

    if ($stmt->execute()) {
        $message = "Kegiatan berhasil dibatalkan.";
        $activity = null; // Reset detail kegiatan
    } else {
        $message = "Terjadi kesalahan saat membatalkan kegiatan.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batalkan Kegiatan</title>
    <link rel="stylesheet" href="style4.css">
</head>
<body>
    <header>
        <h1>Batalkan Kegiatan</h1>
    </header>
    <main>
        <div class="form-container">
            <h2>Form Pembatalan Kegiatan</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="search-title">Cari berdasarkan judul kegiatan:</label>
                    <input type="text" id="search-title" name="search-title" placeholder="Masukkan judul kegiatan yang ingin dibatalkan" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">Cari</button>
                </div>
                <div class="center-btn">
                    <a href="index.php" class="btn keluar-btn">Keluar</a>
                </div>
            </form>

            <?php if ($activity): ?>
            <form method="POST" action="">
                <div id="cancel-section" class="cancel-section">
                    <div class="activity-details">
                        <h3>Detail Kegiatan</h3>
                        <p id="activity-title"><strong>Judul:</strong> <?php echo htmlspecialchars($activity['title']); ?></p>
                        <p id="activity-date"><strong>Tanggal:</strong> <?php echo htmlspecialchars($activity['tanggal']); ?></p>
                        <p id="activity-location"><strong>Lokasi:</strong> <?php echo htmlspecialchars($activity['lokasi']); ?></p>
                        <p id="activity-description"><strong>Deskripsi:</strong> <?php echo htmlspecialchars($activity['description']); ?></p>
                    </div>
                    <input type="hidden" name="cancel-id" value="<?php echo $activity['id_kegiatan']; ?>">
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Batalkan Kegiatan</button>
                    </div>
                </div>
            </form>
            <?php endif; ?>

            <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
            <?php endif; ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Penjadwalan Kegiatan. Semua Hak Dilindungi.</p>
    </footer>
</body>
</html>
