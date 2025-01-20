@extends('layout.tamplate')
@section('title')
    Form Transaksi Peminjaman
@endsection
@section('content')
    @if ($errors->has('Error'))
        <div class="alert alert-danger">
            {{ $errors->first('Error') }}
        </div>
    @endif
    <form action="/peminjaman" method="post" class="needs-validation" novalidate>
        @csrf
        <div class="mb-3">
            <label for="id_peminjam" class="col-form-label">Nama Peminjam:</label>
            <select class="form-control @error('id_peminjam') is-invalid @enderror" name="id_peminjam" id="nama_select"
                data-placeholder="Pilih Nama Peminjam">
                <option value="">Masukan Nama</option>
                @foreach ($peminjam as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
            @error('id_peminjam')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="id_barang" class="col-form-label">Nama Barang:</label>
            <select class="form-control @error('id_barang') is-invalid @enderror" name="id_barang" id="barang"
                name="id_barang" value="{{ old('id_barang') }}" data-placeholder="Pilih Barang">
                <option value="">Pilih Nama Barang</option>

                @foreach ($data as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_barang }} ({{ $item->qty }})</option>
                @endforeach
            </select>
            @error('id_barang')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="jumlah_pinjam" class="col-form-label">Jumlah Pinjam:</label>
            <input min="1" onkeyup="this.value = this.value.toUpperCase()" type="number"
                class="form-control @error('jumlah_pinjam') is-invalid @enderror" name="jumlah_pinjam"
                value="{{ old('jumlah_pinjam') }}" required>
            @error('jumlah_pinjam')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="keperluan" class="col-form-label">keperluan :</label>
            <input autocomplete="off" onkeyup="this.value = this.value.toUpperCase()" type="text"
                class="form-control @error('keperluan') is-invalid @enderror" name="keperluan"
                value="{{ old('keperluan') }}" required>
            @error('keperluan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="modal-footer">
            <a href="/peminjaman" type="button" class="btn btn-secondary">Close</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection
