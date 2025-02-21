<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Aplikasi - Arsip BPKB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
       body {
            background: url('assets/images/arsip.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
        }

        .card-body {
            padding: 30px;
        }

        .btn-back {
            background-color: #007bff;
            color: white;
            border-radius: 50px;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Tentang Aplikasi Arsip BPKB</h3>
            </div>
            <div class="card-body">
                <h5>Apa itu Arsip BPKB?</h5>
                <p>Aplikasi Arsip BPKB ini dirancang untuk mempermudah pengelolaan arsip BPKB secara digital. Aplikasi ini membantu admin untuk menyimpan, mengedit, dan mencari data BPKB dengan efisien.</p>

                <h5>Fitur Utama:</h5>
                <ul>
                    <li>Pencatatan arsip BPKB secara elektronik</li>
                    <li>Pencarian arsip berdasarkan berbagai parameter (nama, nomor BPKB, dll.)</li>
                    <li>Pengelolaan data arsip dengan mudah</li>
                    <li>Keamanan data dengan sistem login yang aman</li>
                </ul>

                <h5>Tujuan Aplikasi:</h5>
                <p>Aplikasi ini bertujuan untuk meningkatkan efisiensi dalam pengelolaan arsip BPKB, mengurangi kesalahan manual, dan mempermudah akses data yang diperlukan.</p>

                <a href="login.php" class="btn-back">Kembali ke Login</a>
            </div>
        </div>
    </div>

</body>
</html>
