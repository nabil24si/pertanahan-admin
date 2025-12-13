@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Detail Sengketa Persil</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('sengketa_persil.index') }}">Data Sengketa</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            {{-- KIRI: INFORMASI UTAMA SENGKETA --}}
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informasi Sengketa</h4>

                        {{-- Menggunakan $sengketa (dari Controller) --}}
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th style="width: 35%">Persil Terkait</th>
                                        <td>:
                                            @if ($sengketa->persil)
                                                <span class="fw-bold">{{ $sengketa->persil->kode_persil }}</span>
                                                <span class="d-block text-muted small">Pemilik: {{ $sengketa->persil->warga->nama ?? 'Tidak Diketahui' }}</span>
                                            @else
                                                <span class="text-danger">Persil Tidak Ditemukan</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Pihak 1 (Pelapor)</th>
                                        <td>: <span class="fw-bold">{{ $sengketa->pihak_1 }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Pihak 2 (Terlapor)</th>
                                        <td>: {{ $sengketa->pihak_2 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Sengketa</th>
                                        <td>: {{ $sengketa->created_at->format('d F Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>:
                                            @php
                                                $badge = match($sengketa->status) {
                                                    'diterima' => 'bg-success',
                                                    'ditolak' => 'bg-danger',
                                                    default => 'bg-warning text-dark',
                                                };
                                            @endphp
                                            <span class="badge rounded-pill {{ $badge }}">{{ ucfirst($sengketa->status) }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Kronologi</th>
                                        <td>: {{ $sengketa->kronologi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Penyelesaian</th>
                                        <td>: {{ $sengketa->penyelesaian ?? 'Belum Ada Keputusan' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            @if (Auth::check() && Auth::user()->role === 'Admin')
                                <a href="{{ route('sengketa_persil.edit', $sengketa->sengketa_id) }}" class="btn btn-warning btn-sm">Edit Data</a>
                            @endif
                            <a href="{{ route('sengketa_persil.index') }}" class="btn btn-light btn-sm">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KANAN: LAMPIRAN FILE --}}
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Bukti & File Lampiran</h4>
                        <p class="card-description">
                            Total file: {{ $sengketa->attachments->count() }}
                        </p>

                        @if ($sengketa->attachments->count() > 0)
                            <div class="row">
                                @foreach ($sengketa->attachments as $media)
                                    <div class="col-md-6 mb-4">
                                        <div class="border p-2 rounded text-center h-100">

                                            {{-- TAMPILAN GAMBAR / ICON --}}
                                            @if (str_contains($media->mime_type, 'image'))
                                                {{-- GAMBAR --}}
                                                <img src="{{ asset('storage/uploads/sengketa_persil/' . $media->file_name) }}"
                                                    class="img-fluid rounded mb-2"
                                                    style="max-height: 120px; object-fit: cover; width: 100%;"
                                                    alt="{{ $media->caption }}"
                                                    onerror="this.onerror=null;this.src='https://via.placeholder.com/150?text=Gambar+Rusak';">
                                            @else
                                                {{-- DOKUMEN --}}
                                                <div class="py-4 text-primary">
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
                                                <a href="{{ asset('storage/uploads/sengketa_persil/' . $media->file_name) }}"
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
                                <i class="mdi mdi-file-multiple-outline mdi-48px text-muted mb-3"></i>
                                <h6 class="text-muted fw-bold">Tidak Ada Lampiran</h6>
                                <p class="text-muted small">Tidak ada bukti atau file yang dilampirkan.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
