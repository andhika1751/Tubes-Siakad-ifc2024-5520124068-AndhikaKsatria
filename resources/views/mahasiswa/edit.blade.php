@extends('layouts.app')
@section('title', 'Edit Mahasiswa')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Edit Mahasiswa</h1>

<div class="card form-max">
    <div class="card-header">Form Edit Data Mahasiswa</div>
    <div class="card-body">
        <form action="{{ route('mahasiswa.update', $mahasiswa->npm) }}" method="POST">
            @csrf @method('PUT')

            <div class="form-group">
                <label>NPM</label>
                <input type="text" value="{{ $mahasiswa->npm }}" disabled
                       style="background:#f0f0f0;color:#888;cursor:not-allowed;">
            </div>

            <div class="form-group">
                <label for="nama">Nama Mahasiswa</label>
                <input type="text" id="nama" name="nama"
                       value="{{ old('nama', $mahasiswa->nama) }}"
                       placeholder="Masukkan nama lengkap"
                       class="{{ $errors->has('nama') ? 'is-invalid' : '' }}">
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="email">Email Login SIAKAD</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email', $mahasiswa->user->email ?? '') }}"
                       placeholder="Contoh: andi@gmail.com"
                       class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
                <small style="color:#777;">Ubah email login mahasiswa ini di sini.</small>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="nidn">Dosen Wali</label>
                <select id="nidn" name="nidn" class="{{ $errors->has('nidn') ? 'is-invalid' : '' }}">
                    <option value="">-- Pilih Dosen --</option>
                    @foreach($dosens as $dosen)
                        <option value="{{ $dosen->nidn }}"
                            {{ old('nidn', $mahasiswa->nidn) == $dosen->nidn ? 'selected' : '' }}>
                            {{ $dosen->nidn }} - {{ $dosen->nama }}
                        </option>
                    @endforeach
                </select>
                @error('nidn')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-warning">Update</button>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
