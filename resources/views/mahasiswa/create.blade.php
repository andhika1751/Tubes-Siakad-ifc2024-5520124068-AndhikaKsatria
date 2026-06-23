@extends('layouts.app')
@section('title', 'Tambah Mahasiswa')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Tambah Mahasiswa</h1>

<div class="card form-max">
    <div class="card-header">Form Tambah Data Mahasiswa</div>
    <div class="card-body">
        <form action="{{ route('mahasiswa.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="npm">NPM <small style="color:#999">(10 karakter)</small></label>
                <input type="text" id="npm" name="npm" value="{{ old('npm') }}"
                       placeholder="Contoh: 2210101001" maxlength="10"
                       class="{{ $errors->has('npm') ? 'is-invalid' : '' }}">
                @error('npm')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="nama">Nama Mahasiswa</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                       placeholder="Masukkan nama lengkap"
                       class="{{ $errors->has('nama') ? 'is-invalid' : '' }}">
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="email">Email Login SIAKAD</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                       placeholder="Contoh: andi@gmail.com"
                       class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
                <small style="color:#777;">Email ini akan dipakai mahasiswa untuk login. Password default = NPM mahasiswa.</small>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="nidn">Dosen Wali</label>
                <select id="nidn" name="nidn" class="{{ $errors->has('nidn') ? 'is-invalid' : '' }}">
                    <option value="">-- Pilih Dosen --</option>
                    @foreach($dosens as $dosen)
                        <option value="{{ $dosen->nidn }}" {{ old('nidn') == $dosen->nidn ? 'selected' : '' }}>
                            {{ $dosen->nidn }} - {{ $dosen->nama }}
                        </option>
                    @endforeach
                </select>
                @error('nidn')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
