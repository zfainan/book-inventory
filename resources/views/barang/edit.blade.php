@extends('layout.tamplate')
@section('title')
    Form Edit Data Buku
@endsection
@section('content')
    <form action="/barang/detail/{{ $barang->kode_barang }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <!-- Kode Buku -->
        <div class="mb-3">
            <label for="kode_barang" class="col-form-label">Kode Buku:</label>
            <input autocomplete="off" onkeyup="this.value = this.value.toUpperCase()" type="text"
                class="form-control @error('kode_barang') is-invalid @enderror" id="kode_barang" name="kode_barang" autofocus
                value="{{ old('kode_barang', $barang->kode_barang) }}">
            @error('kode_barang')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Nama Buku -->
        <div class="mb-3">
            <label for="nama_barang" class="col-form-label">Nama Buku:</label>
            <input autocomplete="off" onkeyup="this.value = this.value.toUpperCase()" type="text"
                class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" autofocus
                value="{{ old('nama_barang', $barang->nama_barang) }}">
            @error('nama_barang')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Nama Pengarang -->
        <div class="mb-3">
            <label for="pengarang" class="col-form-label">Nama Pengarang:</label>
            <input autocomplete="off" onkeyup="this.value = this.value.toUpperCase()" type="text"
                class="form-control @error('pengarang') is-invalid @enderror" name="pengarang" autofocus
                value="{{ old('pengarang', $barang->pengarang) }}">
            @error('pengarang')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Nama Penerbit -->
        <div class="mb-3">
            <label for="penerbit" class="col-form-label">Nama Penerbit:</label>
            <input autocomplete="off" onkeyup="this.value = this.value.toUpperCase()" type="text"
                class="form-control @error('penerbit') is-invalid @enderror" name="penerbit" autofocus
                value="{{ old('penerbit', $barang->penerbit) }}">
            @error('penerbit')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Dropdown untuk Asal -->
        <div class="mb-3">
            <label for="asal" class="col-form-label">Asal:</label>
            <select class="form-control @error('asal') is-invalid @enderror" name="asal" id="asal">
                <option value="">-- Pilih Asal --</option>
                <option value="Hadiah" {{ old('asal', $barang->asal) == 'Hadiah' ? 'selected' : '' }}>Hadiah</option>
                <option value="Beli" {{ old('asal', $barang->asal) == 'Beli' ? 'selected' : '' }}>Beli</option>
                <option value="Lain-lain" {{ old('asal', $barang->asal) == 'Lain-lain' ? 'selected' : '' }}>Lain-lain
                </option>
            </select>
            @error('asal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Dropdown untuk Jenis Buku -->
        <div class="mb-3">
            <label for="jenis_buku" class="col-form-label">Jenis Buku:</label>
            <select class="form-control @error('jenis_buku') is-invalid @enderror" name="jenis_buku" id="jenis_buku">
                <option value="">-- Pilih Jenis Buku --</option>
                <option value="Sastra" {{ old('jenis_buku', $barang->jenis_buku) == 'Sastra' ? 'selected' : '' }}>Sastra
                </option>
                <option value="RPL" {{ old('jenis_buku', $barang->jenis_buku) == 'RPL' ? 'selected' : '' }}>RPL</option>
                <option value="Akutansi" {{ old('jenis_buku', $barang->jenis_buku) == 'Akutansi' ? 'selected' : '' }}>
                    Akutansi</option>
                <option value="Farmasi" {{ old('jenis_buku', $barang->jenis_buku) == 'Farmasi' ? 'selected' : '' }}>Farmasi
                </option>
                <option value="Bacaan" {{ old('jenis_buku', $barang->jenis_buku) == 'Bacaan' ? 'selected' : '' }}>Bacaan
                </option>
            </select>
            @error('jenis_buku')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Tombol -->
        <div class="modal-footer">
            <a href="/barang/detail/{{ $barang->kode_barang }}" type="button" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection
