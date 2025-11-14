@extends('layouts.admin.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Data Persil</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Data Persil</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Form Edit Data Persil</h4>
                        <p class="card-description">Silakan ubah data di bawah ini</p>

                        <form action="{{ route('persil.update', $dataPersil->persil_id) }}" method="POST" class="forms-sample">
                            @csrf
                            @method('PUT')

                            {{-- Kode Persil --}}
                            <div class="form-group row">
                                <label for="kode_persil" class="col-sm-3 col-form-label">Kode Persil</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="kode_persil" name="kode_persil"
                                        value="{{ old('kode_persil', $dataPersil->kode_persil) }}" readonly>
                                </div>
                            </div>

                            {{-- Pemilik (Warga) --}}
                            <div class="form-group row align-items-center">
                                <label for="pemilik_warga_id" class="col-sm-3 col-form-label">Pemilik</label>
                                <div class="col-sm-9">
                                    <select id="pemilik_warga_id" name="pemilik_warga_id" class="form-select" required>
                                        <option value="">-- Pilih Pemilik --</option>
                                        @foreach ($dataWarga as $warga)
                                            <option value="{{ $warga->warga_id }}"
                                                {{ old('pemilik_warga_id', $dataPersil->pemilik_warga_id) == $warga->warga_id ? 'selected' : '' }}>
                                                {{ $warga->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Luas Tanah --}}
                            <div class="form-group row">
                                <label for="luas_m2" class="col-sm-3 col-form-label">Luas (m²)</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="luas_m2" name="luas_m2"
                                        value="{{ old('luas_m2', $dataPersil->luas_m2) }}" step="0.01" required>
                                </div>
                            </div>

                            {{-- Penggunaan --}}
                            <div class="form-group row">
                                <label for="penggunaan" class="col-sm-3 col-form-label">Penggunaan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="penggunaan" name="penggunaan"
                                        value="{{ old('penggunaan', $dataPersil->penggunaan) }}" placeholder="Contoh: Sawah, Kebun, Rumah" required>
                                </div>
                            </div>

                            {{-- Alamat Lahan --}}
                            <div class="form-group row">
                                <label for="alamat_lahan" class="col-sm-3 col-form-label">Alamat Lahan</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="alamat_lahan" name="alamat_lahan" rows="3" required>{{ old('alamat_lahan', $dataPersil->alamat_lahan) }}</textarea>
                                </div>
                            </div>

                            {{-- RT & RW --}}
                            <div class="form-group row">
                                <label for="rt" class="col-sm-3 col-form-label">RT</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="rt" name="rt"
                                        value="{{ old('rt', $dataPersil->rt) }}" required>
                                </div>

                                <label for="rw" class="col-sm-2 col-form-label text-center">RW</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="rw" name="rw"
                                        value="{{ old('rw', $dataPersil->rw) }}" required>
                                </div>
                            </div>

                            {{-- Tombol --}}
                            <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                            <a href="{{ route('persil.index') }}" class="btn btn-light">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
