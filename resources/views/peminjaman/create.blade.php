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
            <select class="form-control @error('id_barang') is-invalid @enderror" name="id_barang[]" id="barang"
                name="id_barang" data-placeholder="Pilih Barang" multiple>
                <option value="">Pilih Nama Barang</option>

                @foreach ($data as $item)
                    <option value="{{ $item->id }}" @selected(in_array($item->id, old('id_barang') ?? []))>{{ $item->inventory_code }} - {{ $item->nama_barang }}</option>
                @endforeach
            </select>
            @error('id_barang')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="keperluan" class="col-form-label">Keperluan :</label>
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
