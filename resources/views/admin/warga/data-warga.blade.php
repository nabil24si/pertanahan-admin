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
                                <a href="{{ route('warga.create') }}" class="btn btn-gradient-info">Tambah Data</a>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data Warga</h4>
                                    <p class="card-description"> Warga yang terdaftar</p>
                                    </p>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No KTP</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Agama</th>
                                                <th>Pekerjaan</th>
                                                <th>No Telepon</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataWarga as $item)
                                                <tr>
                                                    <td>{{ $item->no_ktp }}</td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>{{ $item->jenis_kelamin }}</td>
                                                    <td>{{ $item->agama }}</td>
                                                    <td>{{ $item->pekerjaan }}</td>
                                                    <td>{{ $item->telp }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td><a href="{{ route('warga.edit', $item->warga_id) }}"
                                                            class="btn btn-gradient-success">Edit</a>
                                                        <form action="{{ route('warga.destroy', $item->warga_id) }}"
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
