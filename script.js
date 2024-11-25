document.getElementById('scheduleForm').addEventListener('submit', function (e) {
    e.preventDefault();

    // Ambil data dari form
    const title = document.getElementById('title').value;
    const date = document.getElementById('date').value;
    const location = document.getElementById('location').value;
    const participants = document.getElementById('participants').value;

    // Validasi sederhana
    if (!title || !date || !location || !participants) {
        alert("Semua kolom harus diisi!");
        return;
    }

    // Tambahkan ke daftar
    const list = document.getElementById('scheduleList');
    const listItem = document.createElement('li');
    listItem.innerHTML = `
        <span>
            <strong>Judul:</strong> ${title} <br>
            <strong>Tanggal:</strong> ${date} <br>
            <strong>Lokasi:</strong> ${location} <br>
            <strong>Peserta:</strong> ${participants}
        </span>
    `;

    // Buat tombol aksi
    const actions = document.createElement('div');
    actions.classList.add('action-buttons');

    // Tombol Ubah
    const editButton = document.createElement('button');
    editButton.textContent = 'Ubah';
    editButton.addEventListener('click', function () {
        document.getElementById('title').value = title;
        document.getElementById('date').value = date;
        document.getElementById('location').value = location;
        document.getElementById('participants').value = participants;
        list.removeChild(listItem); // Hapus item dari daftar
    });

    // Tombol Hapus
    const deleteButton = document.createElement('button');
    deleteButton.textContent = 'Hapus';
    deleteButton.addEventListener('click', function () {
        list.removeChild(listItem);
    });

    actions.appendChild(editButton);
    actions.appendChild(deleteButton);
    listItem.appendChild(actions);
    list.appendChild(listItem);

    // Reset form
    document.getElementById('scheduleForm').reset();
});
