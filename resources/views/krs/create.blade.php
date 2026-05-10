@extends('layouts.app')
@section('title', 'Tambah KRS')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Tambah KRS</h1>

<div class="card form-max">
    <div class="card-header">Form Tambah Data KRS</div>
    <div class="card-body">
        <form action="{{ route('krs.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="npm">Mahasiswa</label>
                <select id="npm" name="npm" class="{{ $errors->has('npm') ? 'is-invalid' : '' }}">
                    <option value="">-- Pilih Mahasiswa --</option>
                    @foreach($mahasiswas as $mhs)
                        <option value="{{ $mhs->npm }}" {{ old('npm') == $mhs->npm ? 'selected' : '' }}>
                            {{ $mhs->npm }} - {{ $mhs->nama }}
                        </option>
                    @endforeach
                </select>
                @error('npm')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
