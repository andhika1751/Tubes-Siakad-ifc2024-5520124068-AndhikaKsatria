@extends('layouts.app')
@section('title', 'Edit Dosen')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Edit Dosen</h1>

<div class="card form-max">
    <div class="card-header">Form Edit Data Dosen</div>
    <div class="card-body">
        <form action="{{ route('dosen.update', $dosen->nidn) }}" method="POST">
            @csrf @method('PUT')

            <div class="form-group">
                <label>NIDN</label>
                <input type="text" value="{{ $dosen->nidn }}" disabled
                       style="background:#f0f0f0;color:#888;cursor:not-allowed;">
            </div>

            <div class="form-group">
                <label for="nama">Nama Dosen</label>
                <input type="text" id="nama" name="nama"
                       value="{{ old('nama', $dosen->nama) }}"
                       placeholder="Masukkan nama lengkap dosen"
                       class="{{ $errors->has('nama') ? 'is-invalid' : '' }}">
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-warning">Update</button>
                <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
