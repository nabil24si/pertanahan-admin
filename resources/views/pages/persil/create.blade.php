@extends('layouts.admin.app')

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

                        <form action="{{ route('persil.store') }}" method="POST" class="forms-sample">
                            @csrf

                            {{-- Kode Persil --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Kode Persil</label>
                                <div class="col-sm-9">
                                    <input type="text" name="kode_persil" class="form-control" placeholder="Kode Persil"
                                        value="{{ old('kode_persil') }}">
                                </div>
                            </div>

                            {{-- Pemilik (Relasi ke warga) --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Pemilik Warga</label>
                                <div class="col-sm-9">
                                    <select name="pemilik_warga_id" class="form-select">
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
                                        value="{{ old('luas_m2') }}">
                                </div>
                            </div>

                            {{-- PENGGUNAAN (SUDAH DIPERBAIKI MENJADI SELECT) --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Penggunaan</label>
                                <div class="col-sm-9">
                                    <select name="penggunaan" class="form-select"> <option value="">-- Pilih Penggunaan --</option>
                                        <option value="Sawah" {{ old('penggunaan') == 'Sawah' ? 'selected' : '' }}>Sawah</option>
                                        <option value="Kebun" {{ old('penggunaan') == 'Kebun' ? 'selected' : '' }}>Kebun</option>
                                        <option value="Perumahan" {{ old('penggunaan') == 'Perumahan' ? 'selected' : '' }}>Perumahan</option>
                                        <option value="Ruko" {{ old('penggunaan') == 'Ruko' ? 'selected' : '' }}>Ruko</option>
                                        <option value="Lahan Kosong" {{ old('penggunaan') == 'Lahan Kosong' ? 'selected' : '' }}>Lahan Kosong</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Alamat Lahan --}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Alamat Lahan</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat_lahan" class="form-control" rows="2" placeholder="Masukkan alamat lahan">{{ old('alamat_lahan') }}</textarea>
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
