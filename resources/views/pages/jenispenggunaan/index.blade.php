@extends('layouts.admin.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Bina Desa </h3>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <a href="{{ route('jenispenggunaan.create') }}" class="btn btn-gradient-info">Tambah
                        Data</a>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Jenis Penggunaan</h4>
                        <p class="card-description"> Jenis Penggunaan yang terdaftar</p>
                        </p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Penggunaan</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataJenisPenggunaan as $item)
                                    <tr>
                                        <td>{{ $item->nama_penggunaan }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td><a href="{{ route('jenispenggunaan.edit', $item->jenis_id) }}"
                                                class="btn btn-gradient-success">Edit</a>
                                            <form action="{{ route('jenispenggunaan.destroy', $item->jenis_id) }}"
                                                method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-gradient-danger"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    Hapus
                                                </button>
                                            </form>

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $dataJenisPenggunaan->links('pagination::simple-bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
