<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bina Desa</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --green-700:#166534;
      --green-500:#22c55e;
      --green-100:#ecfdf5;
      --muted:#6b7280;
      --card-bg: #ffffff;
      --glass: rgba(255,255,255,0.6);
      font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    }
    *{box-sizing:border-box}
    body{margin:0;background:linear-gradient(180deg,var(--green-100),#f8fff7);color:#0f172a}

    .container{max-width:1200px;margin:28px auto;padding:20px}

    header{display:flex;align-items:center;justify-content:space-between;padding:12px 0}
    .brand{display:flex;align-items:center;gap:12px}
    .logo{width:56px;height:56px;border-radius:12px;background:linear-gradient(135deg,var(--green-700),var(--green-500));display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:20px}
    h1{margin:0;font-size:22px;color:var(--green-700)}
    .actions{display:flex;gap:8px;align-items:center}
    .btn{background:var(--green-700);color:white;padding:8px 12px;border-radius:8px;border:0;cursor:pointer}

    .layout{display:grid;grid-template-columns:260px 1fr;gap:20px;margin-top:18px}

    /* sidebar */
    .sidebar{background:var(--card-bg);padding:16px;border-radius:12px;box-shadow:0 6px 18px rgba(2,6,23,0.06)}
    .nav{display:flex;flex-direction:column;gap:8px;margin-top:12px}
    .nav a{display:flex;gap:10px;align-items:center;padding:10px;border-radius:8px;text-decoration:none;color:#0f172a}
    .nav a.active{background:linear-gradient(90deg,var(--green-100),#f1fbf3);border-left:4px solid var(--green-700)}
    .nav svg{width:18px;height:18px;opacity:0.9}

    /* main */
    .main{display:flex;flex-direction:column;gap:18px}
    .card-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:14px}
    .card{background:var(--card-bg);padding:16px;border-radius:12px;box-shadow:0 6px 18px rgba(2,6,23,0.06)}
    .stat{display:flex;align-items:center;justify-content:space-between}
    .stat .left{display:flex;flex-direction:column}
    .kpi{font-size:20px;font-weight:700}
    .kpi-sub{font-size:12px;color:var(--muted)}

    .charts{display:grid;grid-template-columns:2fr 1fr;gap:14px}
    canvas{background:transparent;border-radius:8px}

    .table{width:100%;border-collapse:collapse;margin-top:8px}
    .table th,.table td{padding:10px;text-align:left;border-bottom:1px solid #eef2e7}

    footer{text-align:center;color:var(--muted);padding:12px;margin-top:12px}

    @media (max-width:900px){
      .layout{grid-template-columns:1fr;}
      .card-grid{grid-template-columns:1fr}
      .charts{grid-template-columns:1fr}
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <div class="brand">
        <div class="logo">BD</div>
        <div>
          <h1>Bina Desa</h1>
          <div style="color:var(--muted);font-size:13px">sistem informasi desa — ringkas & ramah</div>
        </div>
      </div>
      <div class="actions">
        <button class="btn" id="btn-refresh"  <a href="{{ url('/dashboard') }}"> refresh</button>
        <button class="btn" style="background:transparent;color:var(--green-700);border:1px solid var(--green-100)">profil</button>
      </div>
    </header>

    <div class="layout">
      <aside class="sidebar">
        <div style="font-weight:600">navigasi</div>
        <nav class="nav">
          <a href="#" class="active">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M3 12l9-9 9 9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            beranda
          </a>
          <a href="{{ url('/persil') }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="8" r="3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Data Persil
          </a>
          <a href="#">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M4 12h16" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            infrastruktur
          </a>
          <a href="#">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 2v20" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            pertanian
          </a>
          <a href="#">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><rect x="3" y="3" width="18" height="18" rx="2" stroke-width="1.5"/></svg>
            pendidikan
          </a>
        </nav>

        <div style="margin-top:16px;font-size:13px;color:var(--muted)">
          terakhir diupdate: <strong id="last-updated">-</strong>
        </div>
      </aside>

      <main class="main">
        <section class="card-grid">
          <div class="card">
            <div class="stat">
              <div class="left">
                <div class="kpi" id="total-pop">3.200</div>
                <div class="kpi-sub">total penduduk</div>
              </div>
              <div style="font-size:40px;opacity:0.15">👥</div>
            </div>
            <p style="color:var(--muted);margin-top:10px">ringkasan jumlah penduduk berdasarkan data sensus terakhir.</p>
          </div>

          <div class="card">
            <div class="stat">
              <div class="left">
                <div class="kpi" id="active-farms">124</div>
                <div class="kpi-sub">lahan pertanian aktif</div>
              </div>
              <div style="font-size:40px;opacity:0.15">🌾</div>
            </div>
            <p style="color:var(--muted);margin-top:10px">luas & jumlah lahan yang didaftarkan pada sistem.</p>
          </div>

          <div class="card">
            <div class="stat">
              <div class="left">
                <div class="kpi" id="schools">4</div>
                <div class="kpi-sub">sekolah</div>
              </div>
              <div style="font-size:40px;opacity:0.15">🏫</div>
            </div>
            <p style="color:var(--muted);margin-top:10px">jumlah fasilitas pendidikan formal di desa.</p>
          </div>

          <div class="card">
            <div class="stat">
              <div class="left">
                <div class="kpi" id="roads">12 km</div>
                <div class="kpi-sub">panjang jalan desa</div>
              </div>
              <div style="font-size:40px;opacity:0.15">🛣️</div>
            </div>
            <p style="color:var(--muted);margin-top:10px">kondisi & panjang jalan yang tercatat.</p>
          </div>
        </section>

        <section class="charts">
          <div class="card" style="padding:12px">
            <h3 style="margin:0 0 8px 0">grafik populasi per-umur</h3>
            <canvas id="popChart" height="200"></canvas>
          </div>

          <div class="card" style="padding:12px">
            <h3 style="margin:0 0 8px 0">komoditas utama</h3>
            <canvas id="cropChart" height="200"></canvas>
            <table class="table" style="margin-top:10px">
              <thead><tr><th>komoditas</th><th>luas (ha)</th></tr></thead>
              <tbody>
                <tr><td>padi</td><td>78</td></tr>
                <tr><td>jagung</td><td>32</td></tr>
                <tr><td>sayur</td><td>14</td></tr>
              </tbody>
            </table>
          </div>
        </section>

        <section class="card">
          <h3 style="margin:0 0 8px 0">daftar warga (contoh)</h3>
          <table class="table">
            <thead><tr><th>nama</th><th>umur</th><th>pekerjaan</th></tr></thead>
            <tbody>
              <tr><td>aji pratama</td><td>34</td><td>petani</td></tr>
              <tr><td>siti aminah</td><td>28</td><td>guru</td></tr>
              <tr><td>hasanuddin</td><td>50</td><td>kades</td></tr>
            </tbody>
          </table>
        </section>

        <footer>© 2025 sistem informasi desa</footer>
      </main>
    </div>
  </div>

  <!-- chart.js via CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // helper data (contoh)
    const sample = {
      updated: new Date().toLocaleString('id-ID', {timeZone: 'Asia/Jakarta'}),
      totalPop: 3200,
      farms: 124,
      schools: 4,
      roads: '12 km',
      ageLabels: ['0-9','10-19','20-29','30-39','40-49','50+'],
      ageData: [400, 520, 640, 720, 560, 360],
      crops: ['padi','jagung','sayur'],
      cropData: [78,32,14]
    };

    document.getElementById('last-updated').textContent = sample.updated;
    document.getElementById('total-pop').textContent = sample.totalPop.toLocaleString();
    document.getElementById('active-farms').textContent = sample.farms;
    document.getElementById('schools').textContent = sample.schools;
    document.getElementById('roads').textContent = sample.roads;

    // population bar chart
    const popCtx = document.getElementById('popChart').getContext('2d');
    new Chart(popCtx, {
      type: 'bar',
      data: {
        labels: sample.ageLabels,
        datasets: [{
          label: 'jumlah (orang)',
          data: sample.ageData,
          backgroundColor: 'rgba(34,197,94,0.7)'
        }]
      },
      options: {
        responsive:true,
        plugins:{legend:{display:false}},
        scales:{y:{beginAtZero:true}}
      }
    });

    // crop pie chart
    const cropCtx = document.getElementById('cropChart').getContext('2d');
    new Chart(cropCtx, {
      type: 'doughnut',
      data: {
        labels: sample.crops,
        datasets:[{data: sample.cropData, backgroundColor:['rgba(34,197,94,0.85)','rgba(16,185,129,0.85)','rgba(34,211,238,0.85)']}]
      },
      options:{responsive:true,plugins:{legend:{position:'bottom'}}}
    });

    // refresh button simulate data update
    document.getElementById('btn-refresh').addEventListener('click', ()=>{
      const now = new Date().toLocaleString('id-ID', {timeZone: 'Asia/Jakarta'});
      document.getElementById('last-updated').textContent = now;
      // simple animation for kpi numbers
      const total = sample.totalPop + Math.floor(Math.random()*5 - 2);
      document.getElementById('total-pop').textContent = total.toLocaleString();
    });
  </script>
</body>
</html>
