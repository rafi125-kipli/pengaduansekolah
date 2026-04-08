@extends('layouts.app')

@section('title', 'Terima Kasih')

@section('content')
<div class="card">
    <h1>Terima kasih!</h1>
    <p>Aspirasi Anda telah berhasil dikirim. Admin akan memproses laporan sesegera mungkin.</p>
    <a href="{{ route('aspirasi.create') }}"><button>Kirim Aspirasi Lagi</button></a>
</div>
@endsection