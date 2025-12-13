@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Detail Peta Persil</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('peta_persil.index') }}">Data Peta</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            {{-- KIRI: INFORMASI UTAMA PETA --}}
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informasi Peta & Dimensi</h4>

                        {{-- Menggunakan $peta (dari Controller) --}}
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th style="width: 35%">Kode Persil</th>
                                        <td>:
                                            @if ($peta->persil)
                                                <span class="fw-bold">{{ $peta->persil->kode_persil }}</span>
                                                <span class="d-block text-muted small">Pemilik: {{ $peta->persil->warga->nama ?? 'Tidak Diketahui' }}</span>
                                            @else
                                                <span class="text-danger">Persil Tidak Ditemukan</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Panjang (m)</th>
                                        <td>: {{ number_format($peta->panjang_m, 2) ?? '-' }} meter</td>
                                    </tr>
                                    <tr>
                                        <th>Lebar (m)</th>
                                        <td>: {{ number_format($peta->lebar_m, 2) ?? '-' }} meter</td>
                                    </tr>
                                    <tr>
                                        <th>Luas (Estimasi)</th>
                                        <td>:
                                            @if ($peta->panjang_m && $peta->lebar_m)
                                                <span class="fw-bold text-success">{{ number_format($peta->panjang_m * $peta->lebar_m, 2) }} m²</span>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Dibuat</th>
                                        <td>: {{ $peta->created_at->format('d F Y H:i') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            <h6 class="card-subtitle mb-2">Data GeoJSON</h6>
                            @if ($peta->geojson)
                                <pre style="background: #f4f4f4; padding: 10px; border: 1px solid #ddd; max-height: 200px; overflow-y: auto;">{{ json_encode($peta->geojson, JSON_PRETTY_PRINT) }}</pre>
                            @else
                                <div class="alert alert-secondary">Tidak ada data GeoJSON terlampir.</div>
                            @endif
                        </div>

                        <div class="mt-4">
                            @if (Auth::check() && Auth::user()->role === 'Admin')
                                <a href="{{ route('peta_persil.edit', $peta->peta_id) }}" class="btn btn-warning btn-sm">Edit Data</a>
                            @endif
                            <a href="{{ route('peta_persil.index') }}" class="btn btn-light btn-sm">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KANAN: LAMPIRAN FILE (SCAN PETA) --}}
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Scan Peta & Lampiran File</h4>
                        <p class="card-description">
                            Total file: {{ $peta->attachments->count() }}
                        </p>

                        @if ($peta->attachments->count() > 0)
                            <div class="row">
                                @foreach ($peta->attachments as $media)
                                    <div class="col-md-6 mb-4">
                                        <div class="border p-2 rounded text-center h-100">

                                            {{-- TAMPILAN GAMBAR / ICON --}}
                                            @if (str_contains($media->mime_type, 'image'))
                                                {{-- GAMBAR --}}
                                                <img src="{{ asset('storage/uploads/peta_persil/' . $media->file_name) }}"
                                                    class="img-fluid rounded mb-2"
                                                    style="max-height: 120px; object-fit: cover; width: 100%;"
                                                    alt="{{ $media->caption }}"
                                                    onerror="this.onerror=null;this.src='https://via.placeholder.com/150?text=Scan+Rusak';">
                                            @else
                                                {{-- DOKUMEN --}}
                                                <div class="py-4 text-info">
                                                    <i class="mdi mdi-file-document mdi-48px"></i>
                                                </div>
                                            @endif

                                            {{-- Nama File --}}
                                            <p class="text-small text-muted mb-1 text-truncate"
                                                title="{{ $media->caption }}">
                                                {{ $media->caption }}
                                            </p>

                                            {{-- TOMBOL LIHAT --}}
                                            <div class="d-flex justify-content-center gap-2 mt-2">
                                                <a href="{{ asset('storage/uploads/peta_persil/' . $media->file_name) }}"
                                                    target="_blank" class="btn btn-inverse-info btn-sm py-1 px-2">
                                                    <i class="mdi mdi-eye"></i> Lihat
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            {{-- TAMPILAN NO FILE --}}
                            <div class="d-flex flex-column align-items-center justify-content-center text-center p-5 border rounded bg-light"
                                style="min-height: 250px;">
                                <i class="mdi mdi-map-search-outline mdi-48px text-muted mb-3"></i>
                                <h6 class="text-muted fw-bold">Tidak Ada Scan Peta/Lampiran</h6>
                                <p class="text-muted small">Tidak ada file yang dilampirkan untuk data peta ini.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
