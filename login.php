<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Arsip BPKB</title>
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

        .login-container {
            background: rgba(255, 255, 255, 0.8); 
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 100%;
            padding: 12px;
            border-radius: 50px;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        @media (max-width: 576px) {
            .login-container {
                padding: 20px;
            }

            .btn-primary {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2 class="mb-4">🔒 Login Arsip BPKB</h2>
        <form action="login_process.php" method="post">
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="👤 Username" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="🔑 Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Masuk</button>
        </form>
        <p><a href="about.php">Tentang Aplikasi</a></p>
        <p class="text-muted">Masuk untuk mengelola data arsip BPKB dengan mudah dan efisien.</p>
    </div>

</body>
</html>
