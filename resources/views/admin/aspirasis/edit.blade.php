@extends('layouts.app')

@section('title', 'Proses Aspirasi')

@section('content')
<div class="card">
    <div class="flex justify-between items-center">
        <div>
            <h1>Proses Aspirasi</h1>
            <p>Perbarui status dan feedback aspirasi.</p>
        </div>
    </div>

    <div style="margin-top:16px;">
        <p><strong>NIS:</strong> {{ $aspirasi->inputAspirasi->nis }}</p>
        <p><strong>Kelas:</strong> {{ $aspirasi->inputAspirasi->siswa->kelas ?? '-' }}</p>
        <p><strong>Kategori:</strong> {{ $aspirasi->inputAspirasi->kategori->ket_kategori ?? '-' }}</p>
        <p><strong>Lokasi:</strong> {{ $aspirasi->inputAspirasi->lokasi }}</p>
        <p><strong>Keterangan:</strong> {{ $aspirasi->inputAspirasi->ket }}</p>
        <p><strong>Bukti Foto:</strong>
            @if($aspirasi->inputAspirasi->foto)
        <div style="margin-top: 8px;">
            <a href="{{ asset('storage/aspirasi/' . $aspirasi->inputAspirasi->foto) }}" target="_blank">
                <img src="{{ asset('storage/aspirasi/' . $aspirasi->inputAspirasi->foto) }}" alt="Bukti Foto" style="max-width: 300px; max-height: 300px; border: 1px solid #ddd; border-radius: 4px;">
            </a>
        </div>
        @else
        -
        @endif
        </p>
    </div>

    <form method="POST" action="{{ route('admin.aspirasi.update', $aspirasi->id_aspirasi) }}" style="margin-top:16px;">
        @csrf

        @if ($errors->any())
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <label for="status">Status</label>
        <select name="status" id="status" required>
            <option value="Menunggu" {{ $aspirasi->status === 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
            <option value="Proses" {{ $aspirasi->status === 'Proses' ? 'selected' : '' }}>Proses</option>
            <option value="Selesai" {{ $aspirasi->status === 'Selesai' ? 'selected' : '' }}>Selesai</option>
        </select>

        <label for="feedback">Feedback Guru</label>
        <textarea name="feedback" id="feedback" rows="4">{{ old('feedback', $aspirasi->feedback) }}</textarea>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <div style="margin-top:16px;">
        <a href="{{ route('admin.dashboard') }}"><button style="background:#2563eb;">Kembali ke Dashboard</button></a>
    </div>
</div>
@endsection