@extends('layouts.app')
@section('title', 'Tambah Dosen')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Tambah Dosen</h1>

<div class="card form-max">
    <div class="card-header">Form Tambah Data Dosen</div>
    <div class="card-body">
        <form action="{{ route('dosen.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nidn">NIDN <small style="color:#999">(10 karakter)</small></label>
                <input type="text" id="nidn" name="nidn" value="{{ old('nidn') }}"
                       placeholder="Contoh: 0101197001" maxlength="10"
                       class="{{ $errors->has('nidn') ? 'is-invalid' : '' }}">
                @error('nidn')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="nama">Nama Dosen</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                       placeholder="Masukkan nama lengkap dosen"
                       class="{{ $errors->has('nama') ? 'is-invalid' : '' }}">
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
