<?php
include 'koneksi.php'; // Menghubungkan ke database

// Variabel untuk menyimpan hasil pencarian
$search_result = null;
$error_message = "";

// Mencari kegiatan berdasarkan judul
if (isset($_POST['search-title'])) {
    $search_title = $_POST['search-title'];

    // Query untuk mencari kegiatan berdasarkan judul
    $sql = "SELECT * FROM kegiatan WHERE title LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $search_title);
    $stmt->execute();
    $search_result = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$search_result) {
        $error_message = "Kegiatan dengan judul tersebut tidak ditemukan.";
    }
}

// Memperbarui data kegiatan
if (isset($_POST['title']) || isset($_POST['tanggal']) || isset($_POST['lokasi']) || isset($_POST['description'])) {
    $id_kegiatan = $_POST['id_kegiatan'];
    $new_title = $_POST['title'] ?? null;
    $new_date = $_POST['tanggal'] ?? null;
    $new_location = $_POST['lokasi'] ?? null;
    $new_description = $_POST['description'] ?? null;

    // Query untuk memperbarui kegiatan
    $sql = "UPDATE kegiatan SET 
                title = COALESCE(?, title),
                tanggal = COALESCE(?, tanggal),
                lokasi = COALESCE(?, lokasi),
                description = COALESCE(?, description)
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $new_title, $new_tanggal, $new_lokasi, $new_description, $id_kegiatan);

    if ($stmt->execute()) {
        $error_message = "Kegiatan berhasil diperbarui.";
    } else {
        $error_message = "Terjadi kesalahan saat memperbarui kegiatan.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Kegiatan</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
    <header>
        <h1>Ubah Kegiatan</h1>
    </header>
    <main>
        <div class="form-container">
            <h2>Formulir Ubah Kegiatan</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="search-title">Cari berdasarkan judul:</label>
                    <input type="text" id="search-title" name="search-title" placeholder="Masukkan judul kegiatan yang ingin diubah" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">Cari</button>
                </div>
                <div class="center-btn">
                    <a href="index.php" class="btn keluar-btn">Keluar</a>
                </div>
            </form>

            <?php if ($search_result): ?>
            <form method="POST" action="">
                <input type="hidden" name="id_kegiatan" value="<?php echo $search_result['id_kegiatan']; ?>">
                <div id="edit-section" class="edit-section">
                    <div class="form-group">
                        <label for="title">Judul Baru</label>
                        <input type="text" id="title" name="title" placeholder="Masukkan judul baru (kosongkan jika tidak diubah)" value="<?php echo $search_result['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal Baru</label>
                        <input type="date" id="tanggal" name="tanggal" value="<?php echo $search_result['tanggal']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi Baru</label>
                        <input type="text" id="lokasi" name="lokasi" placeholder="Masukkan lokasi baru (kosongkan jika tidak diubah)" value="<?php echo $search_result['lokasi']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi Baru</label>
                        <textarea id="description" name="description" rows="4" placeholder="Masukkan deskripsi baru (kosongkan jika tidak diubah)"><?php echo $search_result['description']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
            <?php endif; ?>

            <?php if ($error_message): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Penjadwalan Kegiatan. Semua Hak Dilindungi.</p>
    </footer>
</body>
</html>
