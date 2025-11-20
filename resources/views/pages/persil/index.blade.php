@extends('layouts.admin.app')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Data Persil</h3>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <a href="{{ route('persil.create') }}" class="btn btn-gradient-info">Tambah Data</a>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Persil</h4>
                        <p class="card-description">Daftar data persil yang terdaftar</p>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Kode Persil</th>
                                    <th>Pemilik</th>
                                    <th>Luas (m²)</th>
                                    <th>Penggunaan</th>
                                    <th>Alamat Lahan</th>
                                    <th>RT</th>
                                    <th>RW</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataPersil as $item)
                                    <tr>
                                        <td>{{ $item->kode_persil }}</td>
                                        <td>
                                            {{ $item->warga ? $item->warga->nama : '-' }}
                                        </td>
                                        <td>{{ $item->luas_m2 }}</td>
                                        <td>{{ $item->penggunaan }}</td>
                                        <td>{{ $item->alamat_lahan }}</td>
                                        <td>{{ $item->rt }}</td>
                                        <td>{{ $item->rw }}</td>
                                        <td>
                                            <a href="{{ route('persil.edit', $item->persil_id) }}"
                                                class="btn btn-gradient-success btn-sm">Edit</a>

                                            <form action="{{ route('persil.destroy', $item->persil_id) }}" method="POST"
                                                style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-gradient-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada data persil</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $dataPersil->links('pagination::simple-bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
