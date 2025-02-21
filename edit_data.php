<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Edit Data Anggota</h2>
        <form id="editForm">
            <input type="hidden" id="id">
            <div class="mb-3">
                <label for="nmAnggotaEdit" class="form-label">Nama Anggota</label>
                <input type="text" class="form-control" id="nmAnggotaEdit" required>
            </div>
            <div class="mb-3">
                <label for="noPydEdit" class="form-label">No PYD</label>
                <input type="text" class="form-control" id="noPydEdit" required>
            </div>
            <div class="mb-3">
                <label for="tglPydEdit" class="form-label">Tanggal PYD</label>
                <input type="text" class="form-control" id="tglPydEdit" required>
            </div>
            <div class="mb-3">
                <label for="keteranganEdit" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keteranganEdit" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="tglPengembalianEdit" class="form-label">Tanggal Pengembalian</label>
                <input type="text" class="form-control" id="tglPengembalianEdit">
            </div>
            <button type="button" class="btn btn-warning" onclick="edit()">Perbarui Data</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script>
        function loadEditData() {
            const urlParams = new URLSearchParams(window.location.search);
            const id = urlParams.get('id');

            fetch(`getdata.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('id').value = data.id;
                    document.getElementById('nmAnggotaEdit').value = data.nm_anggota;
                    document.getElementById('noPydEdit').value = data.no_pyd;
                    document.getElementById('tglPydEdit').value = data.tgl_pyd;
                    document.getElementById('keteranganEdit').value = data.keterangan;
                    document.getElementById('tglPengembalianEdit').value = data.tgl_pengembalian || '';
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        function edit() {
            const id = document.getElementById('id').value;
            const nm_anggota = document.getElementById('nmAnggotaEdit').value;
            const no_pyd = document.getElementById('noPydEdit').value;
            const tgl_pyd = document.getElementById('tglPydEdit').value;
            const keterangan = document.getElementById('keteranganEdit').value;
            const tgl_pengembalian = document.getElementById('tglPengembalianEdit').value;

            const data = { id, nm_anggota, no_pyd, tgl_pyd, keterangan, tgl_pengembalian };

            fetch('edit.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Data berhasil diperbarui!');
                    window.location.href = 'index.html';
                } else {
                    alert('Gagal memperbarui data!');
                }
            })
            .catch(error => console.error('Error:', error));
        }

        window.onload = loadEditData;
    </script>
</body>
</html>
