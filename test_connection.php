<?php
require 'db_connection.php';

if ($db) {
    echo "Koneksi berhasil!";
} else {
    echo "Koneksi gagal!";
}
?>