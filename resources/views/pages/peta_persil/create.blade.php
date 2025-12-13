@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Form Input Data Peta Persil</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('peta_persil.index') }}">Data Peta</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Input Peta</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Input Data Peta</h4>
                        <p class="card-description">Silahkan isi data dimensi atau upload GeoJSON/Scan Peta</p>

                        <form action="{{ route('peta_persil.store') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                            @csrf

                            {{-- PERSIL_ID (FK) --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Persil (Lahan) Terkait</label>
                                <div class="col-sm-9">
                                    <select name="persil_id" class="form-select @error('persil_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Persil yang Belum Dipetakan --</option>
                                        @foreach ($dataPersil as $p)
                                            <option value="{{ $p->persil_id }}" {{ old('persil_id') == $p->persil_id ? 'selected' : '' }}>
                                                {{ $p->kode_persil ?? 'N/A' }} - {{ $p->warga->nama ?? 'Pemilik Tidak Diketahui' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('persil_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if ($dataPersil->isEmpty())
                                        <small class="text-info d-block mt-1">Semua Persil sudah memiliki data peta. Silahkan edit data yang sudah ada.</small>
                                    @endif
                                </div>
                            </div>

                            <hr class="my-4">
                            <h6 class="card-subtitle mb-3">Dimensi Fisik (Opsional)</h6>

                            {{-- PANJANG M --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Panjang (m)</label>
                                <div class="col-sm-9">
                                    <input type="number" step="0.01" name="panjang_m" class="form-control @error('panjang_m') is-invalid @enderror"
                                        placeholder="Panjang dalam meter" value="{{ old('panjang_m') }}">
                                    @error('panjang_m')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- LEBAR M --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Lebar (m)</label>
                                <div class="col-sm-9">
                                    <input type="number" step="0.01" name="lebar_m" class="form-control @error('lebar_m') is-invalid @enderror"
                                        placeholder="Lebar dalam meter" value="{{ old('lebar_m') }}">
                                    @error('lebar_m')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr class="my-4">
                            <h6 class="card-subtitle mb-3">Data Geospasial & Lampiran</h6>

                            {{-- GEOJSON (JSON) --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Data GeoJSON</label>
                                <div class="col-sm-9">
                                    <textarea name="geojson" class="form-control @error('geojson') is-invalid @enderror" rows="5"
                                        placeholder="Paste data GeoJSON di sini (misal: koordinat Polygon)">{{ old('geojson') }}</textarea>
                                    <small class="text-muted d-block mt-1">Format JSON wajib benar. Biarkan kosong jika tidak ada data geospasial.</small>
                                    @error('geojson')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- INPUT FILE (Scan Peta) --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Upload Scan Peta/Bukti</label>
                                <div class="col-sm-9">
                                    <input type="file" name="files[]" class="form-control" multiple>
                                    <small class="text-muted d-block mt-1">Bisa pilih banyak file sekaligus. Format: JPG, PNG, PDF. Max 5MB.</small>
                                </div>
                            </div>

                            {{-- Tombol --}}
                            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                            <a href="{{ route('peta_persil.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
