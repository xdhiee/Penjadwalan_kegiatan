<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjadwalan Kegiatan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Penjadwalan Kegiatan</h1>
    </header>
    <main>
        <!-- Form Tambah Kegiatan -->
        <section>
            <h2>Tambah Kegiatan</h2>
            <form id="scheduleForm">
                <label for="title">Judul Kegiatan:</label>
                <input type="text" id="title" name="title" placeholder="Judul kegiatan" required>
                
                <label for="date">Tanggal:</label>
                <input type="date" id="date" name="date" required>
                
                <label for="location">Lokasi:</label>
                <input type="text" id="location" name="location" placeholder="Lokasi kegiatan" required>
                
                <label for="participants">Peserta:</label>
                <textarea id="participants" name="participants" placeholder="Masukkan nama peserta, pisahkan dengan koma" required></textarea>
                
                <button type="submit">Tambahkan</button>
            </form>
        </section>
        
        <hr>

        <!-- Daftar Jadwal -->
        <section>
            <h2>Daftar Jadwal</h2>
            <ul id="scheduleList"></ul>
        </section>
    </main>

    <script src="script.js"></script>
</body>
</html>
