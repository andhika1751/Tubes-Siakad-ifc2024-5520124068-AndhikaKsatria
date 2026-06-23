@extends('layouts.app')
@section('title', 'Tambah KRS')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Ambil Mata Kuliah</h1>

<div class="card form-max">
    <div class="card-header">Form Ambil Mata Kuliah</div>
    <div class="card-body">
        <form action="{{ route('krs.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Mahasiswa</label>
                <input type="text" value="{{ auth()->user()->npm }} - {{ auth()->user()->name }}" disabled
                       style="background:#eee;width:100%;padding:0.5rem;border:1px solid #ccc;border-radius:4px;">
                <small style="color:#777;">Mata kuliah akan diambil atas nama akun Anda yang sedang login.</small>
            </div>

            <div class="form-group">
                <label for="kode_matakuliah">Matakuliah</label>
                <select id="kode_matakuliah" name="kode_matakuliah"
                        class="{{ $errors->has('kode_matakuliah') ? 'is-invalid' : '' }}">
                    <option value="">-- Pilih Matakuliah --</option>
                    @foreach($matakuliahs as $mk)
                        <option value="{{ $mk->kode_matakuliah }}"
                            {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>
                            {{ $mk->kode_matakuliah }} - {{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)
                        </option>
                    @endforeach
                </select>
                @error('kode_matakuliah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('krs.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
