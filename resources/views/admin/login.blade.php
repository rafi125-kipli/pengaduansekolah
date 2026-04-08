@extends('layouts.app')

@section('title', 'Login Admin')

@section('content')
<div class="card">
    <h1>Login Admin</h1>

    @if ($errors->any())
    <div class="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="{{ old('username') }}" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Masuk</button>
    </form>
</div>
@endsection