@extends('layouts.admin.app')

@section('content')
<div class="content-wrapper">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-account-lock"></i>
            </span>
            Data User
        </h3>
        <nav aria-label="breadcrumb">
            <a href="{{ route('user.create') }}" class="btn btn-gradient-primary btn-icon-text">
                <i class="mdi mdi-account-plus btn-icon-prepend"></i> Tambah User
            </a>
        </nav>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card shadow-sm">
                <div class="card-body">

                    <form method="GET" action="{{ route('user.index') }}" class="mb-4">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="mdi mdi-magnify text-primary"></i>
                                    </span>
                                    <input type="text" name="search" class="form-control border-start-0"
                                        placeholder="Cari nama atau email..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-gradient-primary">Cari</button>
                                </div>
                            </div>

                            @if (request('search'))
                            <div class="col-md-2">
                                <a href="{{ route('user.index') }}" class="btn btn-inverse-secondary btn-sm">
                                    <i class="mdi mdi-refresh"></i> Reset
                                </a>
                            </div>
                            @endif
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama User</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Password</th>
                                    @if (Auth::check() && Auth::user()->role === 'Admin')
                                        <th class="text-center" width="200px">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataUser as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-gradient-success text-white rounded-circle d-flex justify-content-center align-items-center me-2" style="width:35px; height:35px; font-weight:bold;">
                                                    {{ strtoupper(substr($item->name, 0, 1)) }}
                                                </div>
                                                <span class="fw-bold">{{ $item->name }}</span>
                                            </div>
                                        </td>
                                        <td class="text-muted">{{ $item->email }}</td>

                                        <td>
                                            @if($item->role === 'Admin')
                                                <span class="badge rounded-pill bg-primary text-white">
                                                    <i class="mdi mdi-shield-crown me-1"></i> Admin
                                                </span>
                                            @else
                                                <span class="badge rounded-pill bg-secondary text-dark">
                                                    <i class="mdi mdi-account me-1"></i> Pegawai
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-muted">{{ $item->password }}</td>

                                        @if (Auth::check() && Auth::user()->role === 'Admin')
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('user.edit', $item->id) }}"
                                                       class="btn btn-sm btn-warning text-dark d-flex align-items-center"
                                                       title="Edit User">
                                                        <i class="mdi mdi-pencil me-1"></i> Edit
                                                    </a>

                                                    <form action="{{ route('user.destroy', $item->id) }}"
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn btn-sm btn-danger d-flex align-items-center"
                                                                onclick="return confirm('Yakin ingin menghapus user {{ $item->name }}?')">
                                                            <i class="mdi mdi-delete me-1"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            <i class="mdi mdi-account-off display-4 d-block mb-2"></i>
                                            Data user tidak ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 d-flex justify-content-end">
                        {{ $dataUser->withQueryString()->links('pagination::simple-bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
