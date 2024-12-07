<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Utama Penjadwalan Kegiatan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Penjadwalan Kegiatan</h1>
    </header>
    <main>
        <section class="menu">
            <div class="menu-item">
                <a href="Tambah_Kegiatan.php" class="menu-link">Tambah Kegiatan</a>
            </div>
            <div class="menu-item">
                <a href="Lihat Kegiatan.php" class="menu-link">Lihat Jadwal</a>
            </div>
            <div class="menu-item">
                <a href="Ubah Kegiatan.php" class="menu-link">Ubah Kegiatan</a>
            </div>
            <div class="menu-item">
                <a href="Batal Kegiatan.php" class="menu-link">Hapus Kegiatan</a>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Penjadwalan Kegiatan. Semua Hak Dilindungi.</p>
    </footer>
</body>
</html>
