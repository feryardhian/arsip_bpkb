<?php
session_start();
require 'db_connection.php';  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($db) {  
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;  
            header("Location: index.php");  
            exit();
        } else {
            $_SESSION['error'] = "Username atau password salah!";  
            header("Location: login.php");  
            exit();
        }
    } else {
        die("Koneksi ke database gagal.");
    }
}
?>
