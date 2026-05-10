@extends('layouts.app')
@section('title', 'Tambah Jadwal')
@push('styles') @include('partials.crud-styles') @endpush

@section('content')
<h1 class="page-title">Tambah Jadwal</h1>

<div class="card form-max">
    <div class="card-header">Form Tambah Data Jadwal</div>
    <div class="card-body">
        <form action="{{ route('jadwal.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="kode_matakuliah">Matakuliah</label>
                <select id="kode_matakuliah" name="kode_matakuliah"
                        class="{{ $errors->has('kode_matakuliah') ? 'is-invalid' : '' }}">
                    <option value="">-- Pilih Matakuliah --</option>
                    @foreach($matakuliahs as $mk)
                        <option value="{{ $mk->kode_matakuliah }}"
                            {{ old('kode_matakuliah') == $mk->kode_matakuliah ? 'selected' : '' }}>
                            {{ $mk->kode_matakuliah }} - {{ $mk->nama_matakuliah }}
                        </option>
                    @endforeach
                </select>
                @error('kode_matakuliah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="nidn">Dosen</label>
                <select id="nidn" name="nidn" class="{{ $errors->has('nidn') ? 'is-invalid' : '' }}">
                    <option value="">-- Pilih Dosen --</option>
                    @foreach($dosens as $dosen)
                        <option value="{{ $dosen->nidn }}"
                            {{ old('nidn') == $dosen->nidn ? 'selected' : '' }}>
                            {{ $dosen->nidn }} - {{ $dosen->nama }}
                        </option>
                    @endforeach
                </select>
                @error('nidn')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="kelas">Kelas</label>
                <select id="kelas" name="kelas" class="{{ $errors->has('kelas') ? 'is-invalid' : '' }}">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach(['A','B','C','D','E'] as $k)
                        <option value="{{ $k }}" {{ old('kelas') == $k ? 'selected' : '' }}>{{ $k }}</option>
                    @endforeach
                </select>
                @error('kelas')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="hari">Hari</label>
                <select id="hari" name="hari" class="{{ $errors->has('hari') ? 'is-invalid' : '' }}">
                    <option value="">-- Pilih Hari --</option>
                    @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h)
                        <option value="{{ $h }}" {{ old('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
                    @endforeach
                </select>
                @error('hari')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="jam">Jam Mulai</label>
                <input type="time" id="jam" name="jam" value="{{ old('jam') }}"
                       class="{{ $errors->has('jam') ? 'is-invalid' : '' }}">
                @error('jam')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
