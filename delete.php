<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $query = "DELETE FROM arsipbaruu WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => 'Data berhasil dihapus']);
    } else {
        echo json_encode(['error' => 'Gagal menghapus data']);
    }

    mysqli_close($conn);
}
?>
