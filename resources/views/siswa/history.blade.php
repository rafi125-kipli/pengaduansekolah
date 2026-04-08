@extends('layouts.app')

@section('title', 'Histori Aspirasi Siswa')

@section('content')
<div class="card">
    <h1>Histori Aspirasi Siswa</h1>
    <p>Masukkan NIS untuk melihat status, feedback, dan histori aspirasi.</p>

    <form method="GET" action="{{ route('siswa.history') }}">
        <label for="nis">NIS</label>
        <input type="text" name="nis" id="nis" value="{{ old('nis', $nis ?? '') }}" maxlength="10" placeholder="1234567890" required>
        <button type="submit">Cari Histori</button>
    </form>

    @if(isset($aspirasis))
    <div style="margin-top:24px;">
        @if($aspirasis->isEmpty())
        <div class="alert">Tidak ditemukan aspirasi untuk NIS {{ $nis }}.</div>
        @else
        <h2>Hasil Histori</h2>
        <p><strong>NIS:</strong> {{ $nis }}</p>
        @if($siswa)
        <p><strong>Kelas:</strong> {{ $siswa->kelas }}</p>
        @endif

        <div style="display:flex; gap:16px; flex-wrap:wrap; margin:16px 0;">
            <div class="card" style="background:#f8fafc; min-width:130px;">
                <strong>Total Aspirasi</strong>
                <div>{{ $aspirasis->count() }}</div>
            </div>
            <div class="card" style="background:#fde68a; min-width:130px;">
                <strong>Menunggu</strong>
                <div>{{ $statusCounts['Menunggu'] ?? 0 }}</div>
            </div>
            <div class="card" style="background:#bfdbfe; min-width:130px;">
                <strong>Proses</strong>
                <div>{{ $statusCounts['Proses'] ?? 0 }}</div>
            </div>
            <div class="card" style="background:#dcfce7; min-width:130px;">
                <strong>Selesai</strong>
                <div>{{ $statusCounts['Selesai'] ?? 0 }}</div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Feedback</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($aspirasis as $aspirasi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $aspirasi->inputAspirasi->kategori->ket_kategori ?? '-' }}</td>
                    <td>{{ $aspirasi->inputAspirasi->lokasi }}</td>
                    <td>{{ $aspirasi->inputAspirasi->ket }}</td>
                    <td>
                        <span class="badge {{ $aspirasi->status === 'Selesai' ? 'badge-success' : ($aspirasi->status === 'Proses' ? 'badge-info' : 'badge-warning') }}">
                            {{ $aspirasi->status }}
                        </span>
                    </td>
                    <td>{{ $aspirasi->feedback ?? '-' }}</td>
                    <td>{{ $aspirasi->created_at?->format('Y-m-d') ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    @endif
</div>
@endsection