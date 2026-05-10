@extends('layouts.app')
@section('title', 'Tambah Matakuliah')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Tambah Matakuliah</h1>

<div class="card form-max">
    <div class="card-header">Form Tambah Data Matakuliah</div>
    <div class="card-body">
        <form action="{{ route('matakuliah.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="kode_matakuliah">Kode Matakuliah <small style="color:#999">(8 karakter)</small></label>
                <input type="text" id="kode_matakuliah" name="kode_matakuliah"
                       value="{{ old('kode_matakuliah') }}"
                       placeholder="Contoh: MK001001" maxlength="8"
                       class="{{ $errors->has('kode_matakuliah') ? 'is-invalid' : '' }}">
                @error('kode_matakuliah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="nama_matakuliah">Nama Matakuliah</label>
                <input type="text" id="nama_matakuliah" name="nama_matakuliah"
                       value="{{ old('nama_matakuliah') }}"
                       placeholder="Masukkan nama matakuliah"
                       class="{{ $errors->has('nama_matakuliah') ? 'is-invalid' : '' }}">
                @error('nama_matakuliah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="sks">SKS</label>
                <input type="number" id="sks" name="sks" value="{{ old('sks') }}"
                       placeholder="Contoh: 3" min="1" max="6"
                       class="{{ $errors->has('sks') ? 'is-invalid' : '' }}">
                @error('sks')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
