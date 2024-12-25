@extends('layouts.app')

@section('title', 'Tambah Data UMKM')

@section('contents')
    <form action="{{ route('verifikasi.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_toko">Nama Toko</label>
            <input type="text" name="nama_toko" id="nama_toko" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nama_pemilik">Nama Pemilik</label>
            <input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="jenis_usaha">Jenis Usaha</label>
            <input type="text" name="jenis_usaha" id="jenis_usaha" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="alamat_usaha">Alamat Usaha</label>
            <textarea name="alamat_usaha" id="alamat_usaha" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="nib">NIB</label>
            <input type="text" name="nib" id="nib" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="no_hp_wa">No. HP/WA</label>
            <input type="text" name="no_hp_wa" id="no_hp_wa" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
