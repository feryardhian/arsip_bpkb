<?php require 'session_check.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Arsip BPKB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('assets/images/arsip2.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
            display: flex;
            font-size: 14px; 
        }
        .sidebar {
            width: 200px; 
            background-color: rgba(0, 0, 0, 0.8);
            padding: 10px; 
            color: white;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 8px; 
            margin: 5px 0;
            border-radius: 5px;
            font-size: 13px;
        }
        .sidebar a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        .content {
            margin-left: 210px; 
            width: calc(100% - 210px);
            padding: 15px;
        }
        .btn {
            font-size: 13px; 
            padding: 6px 10px;
        }
        table {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>📁 Arsip BPKB</h2>
        <a href="dashboard.php">📊 Dashboard</a>
        <a href="index.php">📋 Data Arsip</a>
        <a href="logout.php" class="btn btn-danger">🚪 Logout</a>
    </div>
    
    <div class="content">
        <h1 class="text-center mb-3">Data Arsip BPKB</h1>
        
        <div class="d-flex justify-content-between mb-3">
            <a href="tambah_data.php" class="btn btn-success btn-sm">➕ Tambah Data</a>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <input type="file" name="file" class="form-control d-inline w-auto" accept=".xlsx, .xls" required>
                <button type="submit" class="btn btn-primary btn-sm">📤 Upload</button>
            </form>
        </div>

        <form id="searchForm" class="row mb-3">
            <div class="col-md-4">
                <input type="text" id="searchNama" class="form-control form-control-sm" placeholder="🔍 Cari Nama">
            </div>
            <div class="col-md-4">
                <select id="filterStatus" class="form-control form-control-sm">
                    <option value="">📋 Semua Status</option>
                    <option value="sudah">✅ Sudah Diambil</option>
                    <option value="belum">❌ Belum Diambil</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary btn-sm">🔎 Cari</button>
                <button type="button" id="refreshBtn" class="btn btn-secondary btn-sm">🔄 Refresh</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">No PYD</th>
                        <th class="text-center">Tanggal PYD</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Tanggal Pengembalian</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="data-anggota">
                    <tr><td colspan="7" class="text-center loading-message">⌛ Memuat data...</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        async function loadData(nama = '', status = '') {
            const tableBody = document.getElementById('data-anggota');
            tableBody.innerHTML = '<tr><td colspan="7" class="text-center loading-message">⌛ Memuat data...</td></tr>';

            try {
                const response = await fetch(`getdata.php?nama=${nama}&status=${status}`);
                const data = await response.json();
                tableBody.innerHTML = '';

                if (data.length === 0) {
                    tableBody.innerHTML = '<tr><td colspan="7" class="text-center">❌ Data tidak ditemukan</td></tr>';
                    return;
                }

                data.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = ` 
                        <td class="text-center">${item.id}</td>
                        <td class="text-center">${item.nm_anggota}</td>
                        <td class="text-center">${item.no_pyd}</td>
                        <td class="text-center">${item.tgl_pyd}</td>
                        <td class="text-center">${item.keterangan}</td>
                        <td class="text-center">${item.tgl_pengembalian || '-'}</td>
                        <td class="text-center">
                            <a href="edit_data.php?id=${item.id}" class="btn btn-sm btn-warning">✏️ Edit</a>
                            <button class="btn btn-sm btn-danger" onclick="deleteData(${item.id})">🗑️ Hapus</button>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            } catch (error) {
                console.error('Fetch error:', error);
                tableBody.innerHTML = '<tr><td colspan="7" class="text-center text-danger">❗ Gagal memuat data</td></tr>';
            }
        }

        function deleteData(id) {
            if (confirm('⚠️ Apakah Anda yakin ingin menghapus data ini?')) {
                fetch(`delete.php?id=${id}`, { method: 'GET' })
                    .then(response => response.json())
                    .then(result => {
                        if (result.error) {
                            alert(result.error);
                        } else {
                            loadData();
                            alert('✅ Data berhasil dihapus!');
                        }
                    })
                    .catch(error => console.error('Request failed:', error));
            }
        }

        document.getElementById('searchForm').addEventListener('submit', (event) => {
            event.preventDefault(); 
            const nama = document.getElementById('searchNama').value;
            const status = document.getElementById('filterStatus').value;
            loadData(nama, status);
        });

        document.getElementById('refreshBtn').addEventListener('click', () => {
            document.getElementById('searchNama').value = '';
            document.getElementById('filterStatus').value = '';
            loadData();
        });

        window.onload = () => loadData();
    </script>
</body>
</html>
