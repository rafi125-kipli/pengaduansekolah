@extends('layouts.app')

@section('title', 'Kelola Kategori')

@section('content')
<div class="card">
    <div class="flex justify-between items-center">
        <div>
            <h1>Kelola Kategori</h1>
            <p>Tambahkan kategori baru untuk aspirasi siswa.</p>
        </div>
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

    <form method="POST" action="{{ route('admin.kategoris.store') }}" style="margin-top:16px;">
        @csrf
        <label for="ket_kategori">Nama Kategori</label>
        <input type="text" name="ket_kategori" id="ket_kategori" value="{{ old('ket_kategori') }}" maxlength="30" required>
        <button type="submit">Simpan Kategori</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kategoris as $kategori)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kategori->ket_kategori }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="2">Belum ada kategori.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:16px;">
        <a href="{{ route('admin.dashboard') }}"><button style="background:#2563eb;">Kembali ke Dashboard</button></a>
    </div>
</div>
@endsection