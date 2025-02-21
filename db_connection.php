<?php
$host = 'localhost'; 
$user = 'root'; 
$password = ''; 
$database = 'arsipbpkb';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $db = new mysqli($host, $user, $password, $database);

    $db->set_charset("utf8mb4");

} catch (Exception $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>
