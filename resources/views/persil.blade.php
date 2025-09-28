<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pertanahan Persil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
      
        body {
            background-color: #FDF5E6; /* Warna krem lembut untuk latar belakang */
            color: #6B4F4B; /* Warna coklat tua untuk teks */
        }

        /* Mengatur kotak utama */
        .card-cream {
            background-color: #FFFBF5; /* Krem yang lebih terang untuk kartu */
            border-color: #EADBC8; /* Warna border yang serasi */
        }

        /* Mengatur header tabel */
        .thead-cream {
            background-color: #F0E6D5; /* Warna krem sedikit lebih gelap untuk header */
            border-color: #EADBC8;
        }
        
        /* Mengatur warna teks sekunder/judul */
        .text-brown-muted {
            color: #A58372;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        
        <div class="p-4 p-md-5 rounded-4 border shadow-sm card-cream">
            
            <h1 class="mb-4 text-center text-brown-muted">📜 Data Administrasi Persil</h1>
            <p class="text-center mb-5">Berikut adalah daftar persil tanah yang tercatat dalam sistem.</p>

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-cream">
                        <tr>
                            <th>Persil ID</th>
                            <th>Kode Persil</th>
                            <th>ID Pemilik</th>
                            <th>Luas (m²)</th>
                            <th>Penggunaan</th>
                            <th>Alamat Lahan</th>
                            <th>RT</th>
                            <th>RW</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                        <tr>
                            <td>{{$persil_id}}</td>
                            <td>{{$kode_persil}}</td>
                            <td>{{$pemilik_warga_id}}</td>
                            <td>{{$luas_m2}}</td>
                            <td>{{$penggunaan}}</td>
                            <td>{{$alamat_tanah}}</td>
                            <td>{{$rt}}</td>
                            <td>{{$rw}}</td>
                        
                        </tr>
                  
                    </tbody>
                </table>
            </div>

           

        </div>
    </div>
</body>
</html>