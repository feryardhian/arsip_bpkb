<?php
header('Content-Type: application/json');
require 'db_connection.php'; 

$nama = isset($_GET['nama']) ? "%" . $_GET['nama'] . "%" : "%";
$status = isset($_GET['status']) ? $_GET['status'] : "";

$query = "SELECT * FROM arsipbaruu WHERE nm_anggota LIKE ?";

if ($status === "sudah") {
    $query .= " AND tgl_pengembalian IS NOT NULL";
} elseif ($status === "belum") {
    $query .= " AND (tgl_pengembalian IS NULL OR tgl_pengembalian = '')"; 
}

if ($stmt = $db->prepare($query)) {
    $stmt->bind_param("s", $nama);  
    $stmt->execute();  
    $result = $stmt->get_result();  

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;  
    }

    $stmt->close();  
    $db->close();   

    echo json_encode($data);  
} else {
    echo json_encode(["error" => "Query preparation failed."]);  
}
?>
