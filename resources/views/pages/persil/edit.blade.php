@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Data Persil</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('persil.index') }}">Data Persil</a></li>
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
                        <p class="card-description">Ubah data teks atau tambahkan file baru.</p>

                        {{-- JANGAN LUPA: enctype="multipart/form-data" --}}
                        <form action="{{ route('persil.update', $dataPersil->persil_id) }}" method="POST"
                            class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Kode Persil --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kode Persil</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control bg-light" name="kode_persil"
                                        value="{{ old('kode_persil', $dataPersil->kode_persil) }}" readonly>
                                </div>
                            </div>

                            {{-- Pemilik --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pemilik</label>
                                <div class="col-sm-9">
                                    <select name="pemilik_warga_id" class="form-select" required>
                                        <option value="">-- Pilih Pemilik --</option>
                                        @foreach ($dataWarga as $warga)
                                            <option value="{{ $warga->warga_id }}"
                                                {{ old('pemilik_warga_id', $dataPersil->pemilik_warga_id) == $warga->warga_id ? 'selected' : '' }}>
                                                {{ $warga->nama }} - {{ $warga->no_ktp }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Luas & Penggunaan --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Luas (m²)</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="luas_m2"
                                        value="{{ old('luas_m2', $dataPersil->luas_m2) }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Penggunaan</label>
                                <div class="col-sm-9">
                                    <select name="penggunaan" class="form-select" required>
                                        <option value="">-- Pilih Penggunaan --</option>
                                        @foreach (['Sawah', 'Kebun', 'Perumahan', 'Ruko', 'Lahan Kosong'] as $opsi)
                                            <option value="{{ $opsi }}"
                                                {{ old('penggunaan', $dataPersil->penggunaan) == $opsi ? 'selected' : '' }}>
                                                {{ $opsi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Alamat, RT, RW --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="alamat_lahan" rows="2" required>{{ old('alamat_lahan', $dataPersil->alamat_lahan) }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">RT / RW</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="rt"
                                        value="{{ old('rt', $dataPersil->rt) }}" placeholder="RT">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="rw"
                                        value="{{ old('rw', $dataPersil->rw) }}" placeholder="RW">
                                </div>
                            </div>

                            {{-- INPUT FILE BARU --}}
                            <div class="form-group row highlight-addon">
                                <label class="col-sm-3 col-form-label text-primary font-weight-bold">Tambah File
                                    Baru</label>
                                <div class="col-sm-9">
                                    <input type="file" name="files[]" class="form-control" multiple>
                                    <small class="text-muted">Biarkan kosong jika tidak ingin menambah file.</small>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-gradient-primary me-2">Simpan Perubahan</button>
                            <a href="{{ route('persil.index') }}" class="btn btn-light">Batal</a>
                        </form>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: List File Lama (Management) --}}
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">File Terlampir</h4>
                        <p class="card-description">Kelola file yang sudah ada.</p>

                        @if ($dataPersil->attachments->count() > 0)
                            <div class="list-wrapper">
                                <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                                    @foreach ($dataPersil->attachments as $media)
                                        <li class="d-block mb-3 border-bottom pb-2">
                                            <div class="d-flex align-items-center justify-content-between mb-2">

                                                {{-- Preview Nama File (Klik untuk lihat) --}}
                                                <a href="{{ asset('storage/uploads/persil/' . $media->file_name) }}"
                                                    target="_blank"
                                                    class="text-decoration-none text-dark d-flex align-items-center">
                                                    @if (str_contains($media->mime_type, 'image'))
                                                        <i class="mdi mdi-image text-success me-2 icon-md"></i>
                                                    @else
                                                        <i class="mdi mdi-file-document text-info me-2 icon-md"></i>
                                                    @endif
                                                    <div class="text-truncate" style="max-width: 150px;"
                                                        title="{{ $media->caption }}">
                                                        {{ $media->caption }}
                                                    </div>
                                                </a>

                                                {{-- Tombol Hapus (Panggil MediaController) --}}
                                                {{-- Kita gunakan form kecil terpisah agar file langsung terhapus --}}
                                                <form action="{{ route('persil.deleteMedia', $media->media_id) }}"
                                                    method="POST" onsubmit="return confirm('Yakin hapus file ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm p-2">
                                                        <i class="mdi mdi-close"></i>
                                                </form>

                                                {{-- Preview Gambar Kecil jika itu gambar --}}
                                                @if (str_contains($media->mime_type, 'image'))
                                                    <img src="{{ asset('storage/uploads/persil/' . $media->file_name) }}"
                                                        class="img-thumbnail mt-1" style="height: 60px;">
                                                @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <div class="alert alert-secondary text-center">Belum ada file.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
