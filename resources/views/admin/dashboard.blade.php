@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="card">
    <div class="flex justify-between items-center">
        <div>
            <h1>Dashboard Admin</h1>
            <p>Selamat datang, {{ session('admin_username') }}.</p>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <p>Gunakan halaman kategori untuk menambahkan kategori, lalu proses aspirasi di daftar berikut.</p>

    <div class="actions" style="margin-top:16px;">
        <a href="{{ route('admin.kategoris.index') }}"><button style="background:#10b981;">Kelola Kategori</button></a>
    </div>

    <div style="margin-top:16px;">
        <form method="GET" action="{{ route('admin.dashboard') }}" style="display:flex; flex-wrap:wrap; gap:12px; align-items:flex-end;">
            <div style="min-width:180px;">
                <label for="status">Filter Status</label>
                <select name="status" id="status">
                    <option value="">Semua Status</option>
                    <option value="Menunggu" {{ ($filterStatus ?? '') === 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="Proses" {{ ($filterStatus ?? '') === 'Proses' ? 'selected' : '' }}>Proses</option>
                    <option value="Selesai" {{ ($filterStatus ?? '') === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div style="min-width:180px;">
                <label for="id_kategori">Filter Kategori</label>
                <select name="id_kategori" id="id_kategori">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id_kategori }}" {{ ($filterKategori ?? '') == $kategori->id_kategori ? 'selected' : '' }}>{{ $kategori->ket_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div style="min-width:180px;">
                <label for="nis">Cari NIS</label>
                <input type="text" name="nis" id="nis" value="{{ $filterNis ?? '' }}" placeholder="1234567890">
            </div>
            <div style="min-width:180px;">
                <label for="start_date">Dari Tanggal</label>
                <input type="date" name="start_date" id="start_date" value="{{ $filterStartDate ?? '' }}">
            </div>
            <div style="min-width:180px;">
                <label for="end_date">Sampai Tanggal</label>
                <input type="date" name="end_date" id="end_date" value="{{ $filterEndDate ?? '' }}">
            </div>
            <div>
                <button type="submit">Terapkan</button>
            </div>
            <div>
                <a href="{{ route('admin.dashboard') }}"><button type="button" style="background:#6b7280;">Reset</button></a>
            </div>
        </form>
    </div>

    <div style="margin-top:16px; display:flex; flex-wrap:wrap; gap:12px;">
        <div class="card" style="background:#f8fafc; color:#111; min-width:140px;">
            <strong>Menunggu</strong>
            <div>{{ $statusCounts['Menunggu'] ?? 0 }}</div>
        </div>
        <div class="card" style="background:#e0f2fe; color:#111; min-width:140px;">
            <strong>Proses</strong>
            <div>{{ $statusCounts['Proses'] ?? 0 }}</div>
        </div>
        <div class="card" style="background:#dcfce7; color:#111; min-width:140px;">
            <strong>Selesai</strong>
            <div>{{ $statusCounts['Selesai'] ?? 0 }}</div>
        </div>
    </div>

    @if($aspirasis->isEmpty())
    <div class="alert" style="margin-top:16px;">Belum ada aspirasi masuk.</div>
    @else
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Kelas</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Keterangan</th>
                <th>Foto</th>
                <th>Status</th>
                <th>Feedback</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aspirasis as $aspirasi)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $aspirasi->inputAspirasi->nis }}</td>
                <td>{{ $aspirasi->inputAspirasi->siswa->kelas ?? '-' }}</td>
                <td>{{ $aspirasi->inputAspirasi->kategori->ket_kategori ?? '-' }}</td>
                <td>{{ $aspirasi->inputAspirasi->lokasi }}</td>
                <td>{{ $aspirasi->inputAspirasi->ket }}</td>
                <td>
                    @if($aspirasi->inputAspirasi->foto)
                    <a href="{{ asset('storage/aspirasi/' . $aspirasi->inputAspirasi->foto) }}" target="_blank" class="link">
                        <img src="{{ asset('storage/aspirasi/' . $aspirasi->inputAspirasi->foto) }}" alt="Bukti Foto" style="max-width: 50px; max-height: 50px; cursor: pointer;">
                    </a>
                    @else
                    <span style="color: #999;">-</span>
                    @endif
                </td>
                <td>
                    <span class="badge {{ $aspirasi->status === 'Selesai' ? 'badge-success' : ($aspirasi->status === 'Proses' ? 'badge-info' : 'badge-warning') }}">
                        {{ $aspirasi->status }}
                    </span>
                </td>
                <td>{{ $aspirasi->feedback ?? '-' }}</td>
                <td><a href="{{ route('admin.aspirasi.edit', $aspirasi->id_aspirasi) }}">Edit</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection