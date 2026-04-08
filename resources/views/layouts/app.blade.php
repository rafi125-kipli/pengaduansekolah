<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pengaduan Sekolah')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            color: #222;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 24px;
        }

        header {
            background: #1f2937;
            color: #fff;
            padding: 16px 24px;
        }

        header nav a {
            color: #d1d5db;
            margin-right: 16px;
            text-decoration: none;
        }

        header nav a:hover {
            color: #fff;
        }

        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }

        input[type=text],
        input[type=password],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 14px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
        }

        button {
            background: #2563eb;
            border: none;
            color: white;
            padding: 12px 18px;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .alert {
            padding: 12px 16px;
            background: #fde68a;
            color: #92400e;
            border-radius: 6px;
            margin-bottom: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        th,
        td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background: #f8fafc;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
        }

        .badge-warning {
            background: #fbbf24;
            color: #92400e;
        }

        .badge-info {
            background: #60a5fa;
            color: #1d4ed8;
        }

        .badge-success {
            background: #4ade80;
            color: #166534;
        }

        .actions a,
        .actions form {
            display: inline-block;
            margin-right: 8px;
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <nav>
                <a href="{{ url('/') }}">Beranda</a>
                <a href="{{ route('aspirasi.create') }}">Kirim Aspirasi</a>
                <a href="{{ route('siswa.history') }}">Histori Siswa</a>
                <a href="{{ route('admin.login') }}">Login Admin</a>
                @if(session()->has('admin_id'))
                <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                @endif
            </nav>
        </div>
    </header>
    <div class="container">
        @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</body>

</html>