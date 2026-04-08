@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')
<div class="card">
    <h1>Selamat Datang di Sistem Pengaduan Sekolah</h1>
    <p>Gunakan form aspirasi ini untuk melaporkan masalah atau saran yang ada di lingkungan sekolah</p>
    <p>
        <a href="{{ route('aspirasi.create') }}"><button>Kirim Aspirasi</button></a>
        <a href="{{ route('siswa.history') }}"><button style="background:#f59e0b;">Histori Siswa</button></a>
        <a href="{{ route('admin.login') }}"><button style="background:#10b981;">Login Admin</button></a>
    </p>
</div>
@endsection