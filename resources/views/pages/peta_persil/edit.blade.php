@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Data Peta Persil</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('peta_persil.index') }}">Data Peta</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            {{-- KOLOM KIRI: Form Edit Data --}}
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Edit Data & Tambah File</h4>
                        <p class="card-description">Ubah data dimensi atau GeoJSON, dan tambahkan scan peta baru.</p>

                        <form action="{{ route('peta_persil.update', $dataPeta->peta_id) }}" method="POST"
                            class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- PERSIL_ID (FK) --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Persil Terkait</label>
                                <div class="col-sm-9">
                                    <select name="persil_id" class="form-select @error('persil_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Persil --</option>
                                        @foreach ($dataPersil as $p)
                                            <option value="{{ $p->persil_id }}"
                                                {{ old('persil_id', $dataPeta->persil_id) == $p->persil_id ? 'selected' : '' }}>
                                                {{ $p->kode_persil ?? 'N/A' }} - {{ $p->warga->nama ?? 'Pemilik Tidak Diketahui' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('persil_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr class="my-4">
                            <h6 class="card-subtitle mb-3">Dimensi Fisik (Opsional)</h6>

                            {{-- PANJANG M --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Panjang (m)</label>
                                <div class="col-sm-9">
                                    <input type="number" step="0.01" name="panjang_m" class="form-control @error('panjang_m') is-invalid @enderror"
                                        value="{{ old('panjang_m', $dataPeta->panjang_m) }}">
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
                                        value="{{ old('lebar_m', $dataPeta->lebar_m) }}">
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
                                        placeholder="Paste data GeoJSON di sini (misal: koordinat Polygon)">{{ old('geojson', json_encode($dataPeta->geojson)) }}</textarea>
                                    <small class="text-muted d-block mt-1">Format JSON wajib benar.</small>
                                    @error('geojson')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- INPUT FILE BARU --}}
                            <div class="form-group row highlight-addon">
                                <label class="col-sm-3 col-form-label text-primary font-weight-bold">Tambah Scan/File
                                    Baru</label>
                                <div class="col-sm-9">
                                    <input type="file" name="files[]" class="form-control" multiple>
                                    <small class="text-muted">Biarkan kosong jika tidak ingin menambah file.</small>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-gradient-primary me-2">Simpan Perubahan</button>
                            <a href="{{ route('peta_persil.index') }}" class="btn btn-light">Batal</a>
                        </form>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: List File Lama (Management) --}}
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">File Scan Peta Terlampir</h4>
                        <p class="card-description">Kelola file yang sudah ada.</p>

                        @if ($dataPeta->attachments->count() > 0)
                            <div class="list-wrapper">
                                <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                                    @foreach ($dataPeta->attachments as $media)
                                        <li class="d-block mb-3 border-bottom pb-2">
                                            <div class="d-flex align-items-center justify-content-between mb-2">

                                                {{-- Preview Nama File (Klik untuk lihat) --}}
                                                <a href="{{ asset('storage/uploads/peta_persil/' . $media->file_name) }}"
                                                    target="_blank"
                                                    class="text-decoration-none text-dark d-flex align-items-center">
                                                    @if (str_contains($media->mime_type, 'image'))
                                                        <i class="mdi mdi-image text-success me-2 icon-md"></i>
                                                    @else
                                                        <i class="mdi mdi-file-document text-info me-2 icon-md"></i>
                                                    @endif
                                                    <div class="text-truncate" style="max-width: 100px;"
                                                        title="{{ $media->caption }}">
                                                        {{ $media->caption }}
                                                    </div>
                                                </a>

                                                {{-- Tombol Hapus --}}
                                                <form action="{{ route('peta_persil.deleteMedia', $media->media_id) }}"
                                                    method="POST" onsubmit="return confirm('Yakin hapus file ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm p-2">
                                                        <i class="mdi mdi-close"></i>
                                                    </button>
                                                </form>

                                                {{-- Preview Gambar Kecil --}}
                                                @if (str_contains($media->mime_type, 'image'))
                                                    <img src="{{ asset('storage/uploads/peta_persil/' . $media->file_name) }}"
                                                        class="img-thumbnail mt-1" style="height: 60px;">
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <div class="alert alert-secondary text-center">Belum ada file terlampir.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
