<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Tambah Data Anggota</h2>
        <form id="addForm">
            <div class="mb-3">
                <label for="nmAnggota" class="form-label">Nama Anggota</label>
                <input type="text" class="form-control" id="nmAnggota" required>
            </div>
            <div class="mb-3">
                <label for="noPyd" class="form-label">No PYD</label>
                <input type="text" class="form-control" id="noPyd" required>
            </div>
            <div class="mb-3">
                <label for="tglPyd" class="form-label">Tanggal PYD</label>
                <input type="text" class="form-control" id="tglPyd" required>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="tglPengembalian" class="form-label">Tanggal Pengembalian</label>
                <input type="text" class="form-control" id="tglPengembalian">
            </div>
            <button type="button" class="btn btn-primary" onclick="saveData()">Simpan Data</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script>
        function saveData() {
            const nm_anggota = document.getElementById('nmAnggota').value;
            const no_pyd = document.getElementById('noPyd').value;
            const tgl_pyd = document.getElementById('tglPyd').value;
            const keterangan = document.getElementById('keterangan').value;
            const tgl_pengembalian = document.getElementById('tglPengembalian').value;

            const data = { nm_anggota, no_pyd, tgl_pyd, keterangan, tgl_pengembalian };

            fetch('adddata.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Data berhasil disimpan!');
                    window.location.href = 'index.html';
                } else {
                    alert('Gagal menyimpan data!');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
