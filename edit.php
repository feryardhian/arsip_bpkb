<?php
include 'db_connection.php'; 

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'], $_POST['nm_anggota'], $_POST['no_pyd'], $_POST['tgl_pyd'], $_POST['keterangan'], $_POST['tgl_pengembalian'])) {

        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $nm_anggota = mysqli_real_escape_string($conn, trim($_POST['nm_anggota']));
        $no_pyd = mysqli_real_escape_string($conn, trim($_POST['no_pyd']));
        $tgl_pyd = mysqli_real_escape_string($conn, trim($_POST['tgl_pyd']));
        $keterangan = mysqli_real_escape_string($conn, trim($_POST['keterangan']));
        $tgl_pengembalian = mysqli_real_escape_string($conn, trim($_POST['tgl_pengembalian']));

        if (empty($id) || empty($nm_anggota) || empty($no_pyd) || empty($tgl_pyd)) {
            echo json_encode(['error' => 'Semua field wajib diisi!']);
            exit;
        }

        error_log("Edit Request: ID=$id, Nama=$nm_anggota, No PYD=$no_pyd, Tanggal PYD=$tgl_pyd");

        $query = "UPDATE arsipbaruu SET 
                    nm_anggota = '$nm_anggota', 
                    no_pyd = '$no_pyd', 
                    tgl_pyd = '$tgl_pyd', 
                    keterangan = '$keterangan', 
                    tgl_pengembalian = " . (!empty($tgl_pengembalian) ? "'$tgl_pengembalian'" : "NULL") . "
                  WHERE id = '$id'";

        if (mysqli_query($conn, $query)) {
            echo json_encode(['success' => 'Data berhasil diperbarui!']);
        } else {
            echo json_encode(['error' => 'Terjadi kesalahan: ' . mysqli_error($conn)]);
        }

        mysqli_close($conn);
    } else {
        echo json_encode(['error' => 'Data tidak lengkap!']);
    }
} else {
    echo json_encode(['error' => 'Metode request tidak valid!']);
}
?>

