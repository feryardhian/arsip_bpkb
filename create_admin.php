<?php
require 'db_connection.php';

$username = "admin";
$password = password_hash("admin123", PASSWORD_DEFAULT); 

$query = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$query->bind_param("ss", $username, $password);
$query->execute();

echo "Akun admin berhasil dibuat!";
?>
