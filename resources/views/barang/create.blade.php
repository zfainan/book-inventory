@extends('layout.tamplate')

@section('title')
    Form Tambah Data Barang
@endsection

@section('content')
    @include('sweetalert::alert')

    <form action="/barang" method="post" enctype="multipart/form-data">
        @csrf

        <!-- Dropdown Jenis Barang -->
        <div class="mb-3">
            <label for="jenis_barang" class="col-form-label">Jenis Barang:</label>
            <select class="form-control @error('jenis_barang') is-invalid @enderror" name="jenis_barang" id="jenis_barang">
                <option value="">-- Pilih Jenis Barang --</option>
                <option value="Buku" {{ old('jenis_barang') == 'Buku' ? 'selected' : '' }}>Buku</option>
                <option value="Elektronik" {{ old('jenis_barang') == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                <option value="Pemeliharaan" {{ old('jenis_barang') == 'Pemeliharaan' ? 'selected' : '' }}>Pemeliharaan
                </option>
                <option value="Praktik" {{ old('jenis_barang') == 'Praktik' ? 'selected' : '' }}>Praktik</option>
            </select>
            @error('jenis_barang')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Kode Barang -->
        <div class="mb-3">
            <label for="kode_barang" class="col-form-label">Kode Barang:</label>
            <input autocomplete="off" onkeyup="this.value = this.value.toUpperCase()" type="text"
                class="form-control @error('kode_barang') is-invalid @enderror" id="kode_barang" name="kode_barang"
                value="{{ old('kode_barang') }}">
            @error('kode_barang')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Nama Barang -->
        <div class="mb-3">
            <label for="nama_barang" class="col-form-label">Nama Barang:</label>
            <input autocomplete="off" onkeyup="this.value = this.value.toUpperCase()" type="text"
                class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang"
                value="{{ old('nama_barang') }}">
            @error('nama_barang')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Input Dinamis untuk Buku -->
        <div id="form-buku">
            <div class="mb-3">
                <label for="pengarang" class="col-form-label">Nama Pengarang:</label>
                <input autocomplete="off" onkeyup="this.value = this.value.toUpperCase()" type="text"
                    class="form-control @error('pengarang') is-invalid @enderror" name="pengarang"
                    value="{{ old('pengarang') }}">
                @error('pengarang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="penerbit" class="col-form-label">Nama Penerbit:</label>
                <input autocomplete="off" onkeyup="this.value = this.value.toUpperCase()" type="text"
                    class="form-control @error('penerbit') is-invalid @enderror" name="penerbit"
                    value="{{ old('penerbit') }}">
                @error('penerbit')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jenis_buku" class="col-form-label">Jenis Buku:</label>
                <select class="form-control @error('jenis_buku') is-invalid @enderror" name="jenis_buku" id="jenis_buku">
                    <option value="">-- Pilih Jenis Buku --</option>
                    <option value="Sastra" {{ old('jenis_buku') == 'Sastra' ? 'selected' : '' }}>Sastra</option>
                    <option value="RPL" {{ old('jenis_buku') == 'RPL' ? 'selected' : '' }}>RPL</option>
                    <option value="Akutansi" {{ old('jenis_buku') == 'Akutansi' ? 'selected' : '' }}>Akutansi</option>
                    <option value="Farmasi" {{ old('jenis_buku') == 'Farmasi' ? 'selected' : '' }}>Farmasi</option>
                    <option value="Bacaan" {{ old('jenis_buku') == 'Bacaan' ? 'selected' : '' }}>Bacaan</option>
                </select>
                @error('jenis_buku')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- Input Dinamis untuk Elektronik -->
        <div id="form-elektronik">
            <div class="mb-3">
                <label for="type" class="col-form-label">Type:</label>
                <input autocomplete="off" onkeyup="this.value = this.value.toUpperCase()" type="text"
                    class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}">
                @error('type')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- Jumlah Barang -->
        <div class="mb-3">
            <label for="qty" class="col-form-label">Jumlah:</label>
            <input autocomplete="off" type="number" class="form-control @error('qty') is-invalid @enderror" name="qty"
                value="{{ old('qty') }}">
            @error('qty')
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
                <option value="Hadiah" {{ old('asal') == 'Hadiah' ? 'selected' : '' }}>Hadiah</option>
                <option value="Beli" {{ old('asal') == 'Beli' ? 'selected' : '' }}>Beli</option>
                <option value="Lain-lain" {{ old('asal') == 'Lain-lain' ? 'selected' : '' }}>Lain-lain
                </option>
            </select>
            @error('asal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Tombol Aksi -->
        <div class="modal-footer">
            <a href="/barang" type="button" class="btn btn-secondary">Close</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jenisBarang = document.getElementById('jenis_barang');
            const formBuku = document.getElementById('form-buku');
            const formElektronik = document.getElementById('form-elektronik');

            function toggleForms() {
                formBuku.style.display = jenisBarang.value === 'Buku' ? 'block' : 'none';
                formElektronik.style.display = jenisBarang.value === 'Elektronik' ? 'block' : 'none';
            }

            jenisBarang.addEventListener('change', toggleForms);
            toggleForms(); // Panggil saat halaman pertama kali dimuat
        });
    </script>
@endsection
