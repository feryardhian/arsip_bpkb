<?php
require 'db_connection.php'; 

use PhpOffice\PhpSpreadsheet\IOFactory;

if (!file_exists('vendor/autoload.php')) {
    die("Error: File autoload.php tidak ditemukan! Jalankan 'composer install' di terminal.");
}

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file']['tmp_name'];

    if (!isset($db) || !$db->ping()) {
        die("Error: Koneksi ke database gagal!");
    }

    $allowedExtensions = ['xls', 'xlsx'];
    $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    if (!in_array($fileExtension, $allowedExtensions)) {
        die("Error: Hanya file Excel yang diperbolehkan (.xls, .xlsx)");
    }

    try {
        $spreadsheet = IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $data = $worksheet->toArray();

        if (count($data) <= 1) {
            die("Error: File Excel kosong atau tidak memiliki data!");
        }

        for ($i = 1; $i < count($data); $i++) {
            $nm_anggota = $data[$i][0] ?? '';
            $no_pyd = $data[$i][1] ?? '';
            $tgl_pyd = isset($data[$i][2]) ? (string) $data[$i][2] : null;
            $keterangan = $data[$i][3] ?? '';
            $tgl_pengembalian = isset($data[$i][4]) ? (string) $data[$i][4] : null;

            if (empty($no_pyd)) {
                continue;
            }

            $stmtCheck = $db->prepare("SELECT COUNT(*) FROM arsipbaruu WHERE no_pyd = ?");
            $stmtCheck->bind_param("s", $no_pyd);
            $stmtCheck->execute();
            $stmtCheck->bind_result($exists);
            $stmtCheck->fetch();
            $stmtCheck->close();

            if ($exists == 0) {
                $stmtInsert = $db->prepare("INSERT INTO arsipbaruu (nm_anggota, no_pyd, tgl_pyd, keterangan, tgl_pengembalian) VALUES (?, ?, ?, ?, ?)");
                $stmtInsert->bind_param("sssss", $nm_anggota, $no_pyd, $tgl_pyd, $keterangan, $tgl_pengembalian);
                $stmtInsert->execute();
                $stmtInsert->close();
            }
        }

        echo "✅ Data berhasil diunggah dan diimport!";
    } catch (Exception $e) {
        echo "❌ Error saat membaca file: " . $e->getMessage();
    }
} else {
    echo "❌ Error: File tidak ditemukan!";
}
?>
