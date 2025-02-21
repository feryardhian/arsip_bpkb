<?php
require 'session_check.php';
require 'db_connection.php';

$query_total = "SELECT COUNT(*) AS total FROM arsipbaruu";
$result_total = $db->query($query_total);
$total_arsip = ($result_total && $result_total->num_rows > 0) ? $result_total->fetch_assoc()['total'] : 0;

$query_sudah = "SELECT COUNT(*) AS sudah FROM arsipbaruu WHERE tgl_pengembalian IS NOT NULL";
$result_sudah = $db->query($query_sudah);
$sudah_diambil = ($result_sudah && $result_sudah->num_rows > 0) ? $result_sudah->fetch_assoc()['sudah'] : 0;

$query_belum = "SELECT COUNT(*) AS belum FROM arsipbaruu WHERE tgl_pengembalian IS NULL";
$result_belum = $db->query($query_belum);
$belum_diambil = ($result_belum && $result_belum->num_rows > 0) ? $result_belum->fetch_assoc()['belum'] : 0;

$query_recent = "SELECT nm_anggota, no_pyd, tgl_pyd, tgl_pengembalian FROM arsipbaruu ORDER BY tgl_pyd DESC LIMIT 5";
$result_recent = $db->query($query_recent);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Arsip BPKB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background: url('assets/images/a4.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
            display: flex;
        }
        .container {
            margin-top: 20px;
        }
        .card {
            border-radius: 10px;
        }
        .chart-container {
            width: 100%;
            height: 300px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="mb-3">
    <button onclick="goBack()" class="btn btn-success btn-lg fw-bold">🔙 Kembali</button>

    </div>

    <h2 class="text-center mt-3">📊 Dashboard Arsip BPKB</h2>

    <div class="row text-center mt-4">
        <div class="col-md-4">
            <div class="card text-bg-primary p-3">
                <h4>Total Arsip</h4>
                <h2><?= $total_arsip; ?></h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-success p-3">
                <h4>Sudah Diambil</h4>
                <h2><?= $sudah_diambil; ?></h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-danger p-3">
                <h4>Belum Diambil</h4>
                <h2><?= $belum_diambil; ?></h2>
            </div>
        </div>
    </div>

    <div class="card mt-4 p-3">
        <h4 class="text-center">📈 Statistik Arsip</h4>
        <div class="chart-container">
            <canvas id="arsipChart"></canvas>
        </div>
    </div>

    <div class="card mt-4 p-3">
        <h4 class="text-center">📋 Arsip Terbaru</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>No PYD</th>
                    <th>Tanggal PYD</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_recent->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['nm_anggota']; ?></td>
                        <td><?= $row['no_pyd']; ?></td>
                        <td><?= $row['tgl_pyd']; ?></td>
                        <td>
                            <?= ($row['tgl_pengembalian']) ? '✅ Sudah Diambil' : '❌ Belum Diambil'; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>

<script>
    var ctx = document.getElementById('arsipChart').getContext('2d');
    var arsipChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Sudah Diambil', 'Belum Diambil'],
            datasets: [{
                data: [<?= $sudah_diambil; ?>, <?= $belum_diambil; ?>],
                backgroundColor: ['#28a745', '#dc3545']
            }]
        }
    });
</script>

</body>
</html>
