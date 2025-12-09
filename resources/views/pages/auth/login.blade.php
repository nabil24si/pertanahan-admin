@extends('layouts.auth.applog')

@section('content')
{{-- Tambahkan CSS khusus agar logo rapi --}}
<style>
    .login-logo-wrapper {
        text-align: center;
        margin-bottom: 20px;
    }
    .login-logo {
        width: 180px; /* Atur lebar logo sesuai keinginan */
        height: auto;
        object-fit: contain;
    }
</style>

<div class="left-section wow fadeInLeft" data-wow-delay=".3s">
    {{-- Anda juga bisa menaruh logo besar transparan di sini jika mau --}}
    <h1>Pertanahan Bina Desa</h1>
    <p>Hanya Boleh di Akses oleh Admin.</p>
</div>

<div class="right-section wow fadeInRight" data-wow-delay=".5s">
    <div class="login-box">
        
        {{-- === BAGIAN LOGO === --}}
        <div class="login-logo-wrapper wow fadeInDown" data-wow-delay=".4s">
            {{-- Pastikan file logo ada di public/assets/images/ --}}
            <img src="{{ asset('assets/assets-admin/images/logo.png') }}" 
                 alt="Logo Desa" 
                 class="login-logo"
                 onerror="this.style.display='none'"> {{-- Sembunyikan jika gambar tidak ditemukan --}}
        </div>
        {{-- =================== --}}

        <h2 class="wow fadeInDown" data-wow-delay=".6s">Login</h2>
        <p class="wow fadeInUp" data-wow-delay=".8s">
            Belum punya akun? <a href="{{ route('auth.create') }}">Daftar Sekarang</a>
        </p>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="alert alert-success wow fadeIn" data-wow-delay="1s">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger wow fadeIn" data-wow-delay="1s">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger wow fadeIn" data-wow-delay="1.2s">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="wow fadeInUp" data-wow-delay="1.4s" action="{{ route('auth.store') }}" method="POST">
            @csrf
            <div class="form-group wow fadeInUp" data-wow-delay="1.6s">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group wow fadeInUp" data-wow-delay="1.8s">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="btn-login wow fadeInUp" data-wow-delay="2s" name="login">Masuk</button>
        </form>

    </div>
</div>
@endsection