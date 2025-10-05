<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang di Dashboard Desa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(180deg, #ecfdf5, #f8fff7);
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #0f172a;
        }

        .thankyou-container {
            max-width: 700px;
            margin: 80px auto;
            padding: 50px 40px;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(22, 101, 52, 0.1);
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .thankyou-container .logo {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #166534, #22c55e);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 28px;
            margin: 0 auto 20px;
            box-shadow: 0 4px 12px rgba(34, 197, 94, 0.4);
        }

        h2 {
            color: #166534;
            font-weight: 700;
            margin-bottom: 20px;
        }

        blockquote {
            font-size: 1.05rem;
            margin-top: 25px;
            color: #374151;
            background-color: #f1fbf3;
            border-left: 5px solid #22c55e;
            padding: 15px 20px;
            border-radius: 8px;
        }

        .btn-green {
            background-color: #166534;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            margin: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-green:hover {
            background-color: #22c55e;
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
        }

        footer {
            text-align: center;
            color: #6b7280;
            margin-top: 40px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="thankyou-container">
        <div class="logo">BD</div>
        <h2>Selamat Datang, <span style="color:#22c55e;">{{$username}}</span> 🌾</h2>
        <blockquote>
            Terima kasih telah masuk ke <strong>Sistem Bina Desa</strong>.  
            Semoga hari Anda penuh produktivitas dan kebaikan untuk masyarakat desa.
        </blockquote>
        <div class="mt-4">
            <a href="{{ url('/dashboard') }}" class="btn btn-green">Ke Dashboard</a>
            <a href="{{ url('/auth') }}" class="btn btn-green" style="background-color:#22c55e;">Kembali ke Login</a>
        </div>
    </div>

    <footer>© 2025 Sistem Informasi Bina Desa</footer>

</body>
</html>
