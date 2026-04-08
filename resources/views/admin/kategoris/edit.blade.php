@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="card">
    <div>
        <h1>Edit Kategori</h1>
        <p>Ubah nama kategori aspirasi siswa.</p>
    </div>

    @if ($errors->any())
    <div class="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.kategoris.update', $kategori->id_kategori) }}" style="margin-top:16px;">
        @csrf
        <label for="ket_kategori">Nama Kategori</label>
        <input type="text" name="ket_kategori" id="ket_kategori" value="{{ old('ket_kategori', $kategori->ket_kategori) }}" maxlength="30" required>
        <button type="submit">Simpan Perubahan</button>
    </form>

    <div style="margin-top:16px;">
        <a href="{{ route('admin.kategoris.index') }}"><button style="background:#6b7280;">Batal</button></a>
    </div>
</div>
@endsection