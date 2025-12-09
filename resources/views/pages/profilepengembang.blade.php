@extends('layouts.admin.app')
@section('content')
<section class="container my-5">
    <div class="text-center mb-4">
        <h4 class="fw-bold">Identitas Pengembang</h4>
        <p class="text-muted">Informasi singkat mengenai pengembang aplikasi Pertanahan Admin.</p>
    </div>

    <div class="d-flex flex-column align-items-center">
        <img src="{{ asset('assets/assets-admin/images/profile.jpg') }}"
             alt="Foto Profile"
             class="rounded-circle mb-3"
             style="width: 140px; height: 140px; object-fit: cover;">

        <h5 class="fw-bold mb-1">Nama: Nabil Sahendra</h5>
        <p class="text-muted mb-1">NIM: 2457301102</p>
        <p class="text-muted mb-3">Program Studi: Sistem Informasi</p>

        <div>
            <a href="http://linkedin.com/in/nabil-sahendra-106875393/" class="mx-2 text-decoration-none">LinkedIn</a>
            <a href="https://github.com/nabil24si" class="mx-2 text-decoration-none">GitHub</a>
            <a href="https://www.instagram.com/nbil_sh20?igsh=b2s5bW5naWdtMHVu&utm_source=qr" class="mx-2 text-decoration-none">Instagram</a>
        </div>
    </div>
</section>
@endsection