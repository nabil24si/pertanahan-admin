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
        <div class="table-responsive">
            <form method="GET" action="{{ route('persil.index') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-2">
                        <select name="penggunaan" class="form-select" onchange="this.form.submit()">
                            <option value="">Pilih Penggunaan</option>
                            <option value="Sawah" {{ request('penggunaan') == 'Sawah' ? 'selected' : '' }}>
                                Sawah
                            </option>
                            <option value="Kebun" {{ request('penggunaan') == 'Kebun' ? 'selected' : '' }}>
                                Kebun</option>
                            <option value="Perumahan" {{ request('penggunaan') == 'Perumahan' ? 'selected' : '' }}>
                                Perumahan
                            </option>
                            <option value="Ruko" {{ request('penggunaan') == 'Ruko' ? 'selected' : '' }}>
                                Ruko</option>
                            <option value="Lahan Kosong" {{ request('penggunaan') == 'Lahan Kosong' ? 'selected' : '' }}>
                                Lahan Kosong</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" id="exampleInputIconRight"
                                value="{{ request('search') }}" placeholder="Search" aria-label="Search">
                            <button type="submit" class="input-group-text" id="basic-addon2">
                                <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            @if (request('search'))
                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                    class="btn btn-outline-secondary ml-3" id="clear-search"> Clear</a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
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

                                                <form action="{{ route('persil.destroy', $item->persil_id) }}"
                                                    method="POST" style="display:inline-block">
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
