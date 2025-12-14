\@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Form Input Data Persil</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Form Input Persil</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Input Data Persil</h4>
                        <p class="card-description">Silahkan isi form berikut untuk menambahkan data persil</p>

                        {{-- PENTING: enctype="multipart/form-data" WAJIB ADA untuk upload file --}}
                        <form action="{{ route('persil.store') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                            @csrf

                            {{-- Kode Persil --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kode Persil</label>
                                <div class="col-sm-9">
                                    <input type="text" name="kode_persil" class="form-control" placeholder="Kode Persil"
                                        value="{{ old('kode_persil') }}" required>
                                </div>
                            </div>

                            {{-- Pemilik (Relasi ke warga) --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pemilik Warga</label>
                                <div class="col-sm-9">
                                    <select name="pemilik_warga_id" class="form-select" required>
                                        <option value="">-- Pilih Pemilik --</option>
                                        @foreach ($dataWarga as $w)
                                            <option value="{{ $w->warga_id }}" {{ old('pemilik_warga_id') == $w->warga_id ? 'selected' : '' }}>
                                                {{ $w->nama }} - {{ $w->no_ktp }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Luas Tanah --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Luas (m²)</label>
                                <div class="col-sm-9">
                                    <input type="number" name="luas_m2" class="form-control" placeholder="Contoh: 150"
                                        value="{{ old('luas_m2') }}" required>
                                </div>
                            </div>

                            {{-- PENGGUNAAN --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Jenis Penggunaan</label>
                                <div class="col-sm-9">
                                    <select name="penggunaan_id" class="form-select" required>
                                        <option value="">-- Pilih Penggunaan --</option>
                                        @foreach ($dataJenis as $j)
                                            <option value="{{ $j->jenis_id }}" {{ old('penggunaan_id') == $j->jenis_id ? 'selected' : '' }}>
                                                {{ $j->nama_penggunaan }} 
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Alamat Lahan --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Alamat Lahan</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat_lahan" class="form-control" rows="2" placeholder="Masukkan alamat lahan" required>{{ old('alamat_lahan') }}</textarea>
                                </div>
                            </div>

                            {{-- RT --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">RT</label>
                                <div class="col-sm-9">
                                    <input type="text" name="rt" class="form-control" placeholder="RT"
                                        value="{{ old('rt') }}">
                                </div>
                            </div>

                            {{-- RW --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">RW</label>
                                <div class="col-sm-9">
                                    <input type="text" name="rw" class="form-control" placeholder="RW"
                                        value="{{ old('rw') }}">
                                </div>
                            </div>

                            {{-- INPUT FILE (Dikembalikan Sesuai Request) --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Upload Foto/Dokumen</label>
                                <div class="col-sm-9">
                                    <input type="file" name="files[]" class="form-control" multiple>
                                    <small class="text-muted d-block mt-1">Bisa pilih banyak file sekaligus. Format: JPG, PNG, PDF. Max 5MB.</small>
                                </div>
                            </div>

                            {{-- Tombol --}}
                            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                            <a href="{{ route('persil.index') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
