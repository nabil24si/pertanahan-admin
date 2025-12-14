@extends('layouts.admin.app')

@section('content')
    {{-- Start Main Content --}}
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Dashboard
            </h3>
            <div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
            </nav>
        </div>

        {{-- BARIS 1: DATA UTAMA STATISTIK --}}
        <div class="row">
            {{-- WIDGET 1: TOTAL WARGA --}}
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Data Warga <i
                                class="mdi mdi-account-multiple mdi-24px float-end"></i>
                        </h4>
                        <h2 class="mb-5">{{ $totalWarga ?? 0 }}</h2>
                        <h6 class="card-text">Data Penduduk yang Terdaftar</h6>
                    </div>
                </div>
            </div>

            {{-- WIDGET 2: TOTAL PERSIL --}}
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Persil Terdaftar <i
                                class="mdi mdi-layers mdi-24px float-end"></i>
                        </h4>
                        <h2 class="mb-5">{{ $totalPersil ?? 0 }}</h2>
                        <h6 class="card-text">Jumlah Keseluruhan Lahan</h6>
                    </div>
                </div>
            </div>

            {{-- WIDGET 3: TOTAL DOKUMEN PERSIL --}}
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Total Dokumen Lahan <i
                                class="mdi mdi-file-document-box mdi-24px float-end"></i>
                        </h4>
                        <h2 class="mb-5">{{ $totalDokumenPersil ?? 0 }}</h2>
                        <h6 class="card-text">Sertifikat, AJB, dll.</h6>
                    </div>
                </div>
            </div>
        </div>

        {{-- BARIS 2: DATA TAMBAHAN STATISTIK --}}
        <div class="row">
            {{-- WIDGET 4: TOTAL SENGKETA PERSIL --}}
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-warning card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Sengketa (Diproses) <i
                                class="mdi mdi-alert-octagon mdi-24px float-end"></i>
                        </h4>
                        @php
                            // Asumsi Anda juga mengirimkan $sengketaDiproses dari Controller
                            $sengketaDiproses = $sengketaDiproses ?? 0;
                        @endphp
                        <h2 class="mb-5">{{ $totalSengketaPersil ?? 0 }}</h2>
                        <h6 class="card-text">{{ $sengketaDiproses }} Kasus Sedang Diproses</h6>
                    </div>
                </div>
            </div>

            {{-- WIDGET 5: TOTAL PETA PERSIL --}}
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-primary card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Data Peta Persil <i
                                class="mdi mdi-map-marker-radius mdi-24px float-end"></i>
                        </h4>
                        <h2 class="mb-5">{{ $totalPetaPersil ?? 0 }}</h2>
                        <h6 class="card-text">Total Lahan yang Sudah Dipetakan</h6>
                    </div>
                </div>
            </div>

            {{-- WIDGET 6: JENIS PENGGUNAAN Lahan (Perlu Query di Controller) --}}
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-secondary card-img-holder text-dark">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Jenis Penggunaan Lahan <i
                                class="mdi mdi-factory mdi-24px float-end"></i>
                        </h4>
                        @php
                            // Asumsi Anda mengirimkan $jenisPenggunaan (misal array ['Sawah' => 50, 'Perumahan' => 30])
                            $jenis = $jenis ?? [];
                            $mostUsed = !empty($jenis) ? key($jenis) : 'N/A';
                        @endphp
                        <h2 class="mb-5">{{ count($jenis) }} Jenis</h2>
                        <h6 class="card-text">Terbanyak: {{ $mostUsed }}</h6>
                    </div>
                </div>
            </div>

        </div>

        {{-- GRAFIK & TABEL (Bagian ini tidak saya ubah, menggunakan template lama) --}}
        <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <h4 class="card-title float-start">Visit And Sales Statistics</h4>
                            <div id="visit-sale-chart-legend"
                                class="rounded-legend legend-horizontal legend-top-right float-end"></div>
                        </div>
                        <canvas id="visit-sale-chart" class="mt-4"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Traffic Sources</h4>
                        <div class="doughnutjs-wrapper d-flex justify-content-center">
                            <canvas id="traffic-chart"></canvas>
                        </div>
                        <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Recent Tickets</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> Assignee </th>
                                        <th> Subject </th>
                                        <th> Status </th>
                                        <th> Last Update </th>
                                        <th> Tracking ID </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="assets/images/faces/face1.jpg" class="me-2" alt="image"> David
                                            Grey
                                        </td>
                                        <td> Fund is not recieved </td>
                                        <td>
                                            <label class="badge badge-gradient-success">DONE</label>
                                        </td>
                                        <td> Dec 5, 2017 </td>
                                        <td> WD-12345 </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/faces/face2.jpg" class="me-2" alt="image"> Stella
                                            Johnson
                                        </td>
                                        <td> High loading time </td>
                                        <td>
                                            <label class="badge badge-gradient-warning">PROGRESS</label>
                                        </td>
                                        <td> Dec 12, 2017 </td>
                                        <td> WD-12346 </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/faces/face3.jpg" class="me-2" alt="image"> Marina
                                            Michel
                                        </td>
                                        <td> Website down for one week </td>
                                        <td>
                                            <label class="badge badge-gradient-info">ON HOLD</label>
                                        </td>
                                        <td> Dec 16, 2017 </td>
                                        <td> WD-12347 </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="assets/images/faces/face4.jpg" class="me-2" alt="image"> John Doe
                                        </td>
                                        <td> Loosing control on server </td>
                                        <td>
                                            <label class="badge badge-gradient-danger">REJECTED</label>
                                        </td>
                                        <td> Dec 3, 2017 </td>
                                        <td> WD-12348 </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Main Content --}}
@endsection
