@extends('layouts.app')

@section('title', 'Kirim Aspirasi')

@section('content')
<div class="card">
    <h1>Kirim Aspirasi</h1>
    <p>Isi form berikut untuk melaporkan aspirasi atau keluhan.</p>

    @if ($errors->any())
    <div class="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('aspirasi.store') }}" enctype="multipart/form-data">
        @csrf
        <label for="nis">NIS</label>
        <input type="text" name="nis" id="nis" value="{{ old('nis') }}" placeholder="Masukkan NIS 10 digit" maxlength="10" required>

        <label for="kelas">Kelas</label>
        <input type="text" name="kelas" id="kelas" value="{{ old('kelas') }}" placeholder="Contoh: XII RPL 2" maxlength="10" required>

        <label for="id_kategori">Kategori</label>
        <select name="id_kategori" id="id_kategori" required>
            <option value="">Pilih kategori</option>
            @foreach ($kategoris as $kategori)
            <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                {{ $kategori->ket_kategori }}
            </option>
            @endforeach
        </select>

        <label for="lokasi">Lokasi</label>
        <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}" maxlength="50" required>

        <label for="ket">Keterangan</label>
        <textarea name="ket" id="ket" rows="4" maxlength="50" required>{{ old('ket') }}</textarea>

        <label for="foto">Foto Bukti</label>
        <input type="file" name="foto" id="foto" accept="image/*" required>
        <small>Format: JPG, PNG, JPEG. Ukuran maksimal: 2MB</small>

        <button type="submit">Kirim Aspirasi</button>
    </form>
</div>
@endsection