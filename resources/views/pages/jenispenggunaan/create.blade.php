@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Form Input Jenis Penggunaan</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Form Elements</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Input Data Jenis Penggunaan</h4>
                        <p class="card-description">Silahkan isi form di bawah ini</p>

                        <form action="{{ route('jenispenggunaan.store') }}" method="POST" class="forms-sample">
                            @csrf

                            <div class="form-group row">
                                <label for="nama_penggunaan" class="col-sm-3 col-form-label">Nama Penggunaan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama_penggunaan" name="nama_penggunaan"
                                        placeholder="Masukkan Nama Penggunaan" value="{{ old('nama_penggunaan') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="keterangan" name="keterangan"
                                        placeholder="Masukkan Keterangan" value="{{ old('keterangan') }}">
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                                <a href="{{ route('jenispenggunaan.index') }}" class="btn btn-light">Cancel</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
