<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SIAKAD')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f5f5; min-height: 100vh; display: flex; flex-direction: column; }
        nav { background: #e53935; padding: 0 2rem; display: flex; align-items: center; justify-content: space-between; height: 56px; position: sticky; top: 0; z-index: 100; box-shadow: 0 2px 6px rgba(0,0,0,0.2); }
        nav .brand { color: #fff; font-size: 1.2rem; font-weight: 700; text-decoration: none; }
        nav ul { list-style: none; display: flex; gap: 1rem; }
        nav ul li a { color: rgba(255,255,255,0.85); text-decoration: none; font-size: 0.88rem; font-weight: 500; padding: 0.3rem 0.5rem; border-radius: 4px; transition: background 0.15s; }
        nav ul li a:hover, nav ul li a.active { background: rgba(255,255,255,0.18); color: #fff; font-weight: 700; }
        main { flex: 1; max-width: 1150px; width: 100%; margin: 2rem auto; padding: 0 1.5rem; }
        footer { background: #222; color: #aaa; text-align: center; padding: 1rem; font-size: 0.82rem; }
        .alert { padding: 0.75rem 1.25rem; border-radius: 4px; margin-bottom: 1rem; font-size: 0.88rem; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger  { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
    @stack('styles')
</head>
<body>
<nav>
    <a href="{{ route('dashboard') }}" class="brand">SIAKAD</a>
    @auth
    <ul>
        <li><a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a></li>
        @if(auth()->user()->isAdmin())
            <li><a href="{{ route('dosen.index') }}"      class="{{ request()->is('dosen*')      ? 'active' : '' }}">Dosen</a></li>
            <li><a href="{{ route('mahasiswa.index') }}"  class="{{ request()->is('mahasiswa*')  ? 'active' : '' }}">Mahasiswa</a></li>
            <li><a href="{{ route('matakuliah.index') }}" class="{{ request()->is('matakuliah*') ? 'active' : '' }}">Matakuliah</a></li>
        @endif
        <li><a href="{{ route('jadwal.index') }}"     class="{{ request()->is('jadwal*')     ? 'active' : '' }}">Jadwal</a></li>
        <li><a href="{{ route('krs.index') }}"        class="{{ request()->is('krs*')        ? 'active' : '' }}">KRS</a></li>
    </ul>
    <form action="{{ route('logout') }}" method="POST" style="margin:0;">
        @csrf
        <button type="submit" style="background:none;border:none;color:#fff;cursor:pointer;font-size:0.88rem;font-weight:500;">
            {{ auth()->user()->name }} (Logout)
        </button>
    </form>
    @endauth
</nav>
<main>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
    @yield('content')
</main>
<footer>&copy;copyright 2026 SIAKAD</footer>
@stack('scripts')
</body>
</html>
