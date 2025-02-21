<?php
include 'db_connection.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['nm_anggota'], $data['no_pyd'], $data['tgl_pyd'])) {
        echo json_encode(['error' => 'Semua field wajib diisi!']);
        exit;
    }

    $nm_anggota = htmlspecialchars(trim($data['nm_anggota']));
    $no_pyd = htmlspecialchars(trim($data['no_pyd']));
    $tgl_pyd = mysqli_real_escape_string($conn, trim($data['tgl_pyd']));
    $keterangan = isset($data['keterangan']) ? htmlspecialchars(trim($data['keterangan'])) : null;
    $tgl_pengembalian = isset($data['tgl_pengembalian']) ? mysqli_real_escape_string($conn, trim($data['tgl_pengembalian'])) : null;

    $query = "INSERT INTO arsipbaruu (nm_anggota, no_pyd, tgl_pyd, keterangan, tgl_pengembalian) 
              VALUES (?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, 'sssss', $nm_anggota, $no_pyd, $tgl_pyd, $keterangan, $tgl_pengembalian);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['success' => 'Data berhasil ditambahkan!']);
        } else {
            echo json_encode(['error' => 'Gagal menambahkan data: ' . mysqli_stmt_error($stmt)]);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['error' => 'Kesalahan pada query: ' . mysqli_error($conn)]);
    }

    mysqli_close($conn);
} else {
    echo json_encode(['error' => 'Metode tidak diizinkan']);
}
?>
