@extends('layout.tamplate')
@section('title')
Form Pengajuan Buku
@endsection
@section('content')
  <form action="/pengajuan" method="post" class="needs-validation" novalidate>
      @csrf
      <div class="mb-3">
        <label for="judul" class="col-form-label">Judul:</label>
        <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" id="judul" value="{{ old('judul') }}" placeholder="Masukkan Judul Buku" required>
        @error('judul')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="jumlah" class="col-form-label">Jumlah:</label>
        <input type="number" min="1" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" id="jumlah" value="{{ old('jumlah') }}" placeholder="Masukkan Jumlah" required>
        @error('jumlah')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
        <div class="mb-3">
    <label for="jenis" class="col-form-label">Jenis:</label>
    <select class="form-control @error('jenis') is-invalid @enderror" name="jenis" id="jenis" required>
        <option value="">Pilih Jenis</option>
        <option value="Akutansi" {{ old('jenis') == 'Akutansi' ? 'selected' : '' }}>Akutansi</option>
        <option value="Bacaan" {{ old('jenis') == 'Bacaan' ? 'selected' : '' }}>Bacaan</option>
        <option value="Farmasi" {{ old('jenis') == 'Farmasi' ? 'selected' : '' }}>Farmasi</option>
        <option value="RPL" {{ old('jenis') == 'RPL' ? 'selected' : '' }}>RPL</option>
        <option value="Sastra" {{ old('jenis') == 'Sastra' ? 'selected' : '' }}>Sastra</option>
    </select>
    @error('jenis')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>

      <div class="mb-3">
        <label for="penerbit" class="col-form-label">Penerbit:</label>
        <input type="text" class="form-control @error('penerbit') is-invalid @enderror" name="penerbit" id="penerbit" value="{{ old('penerbit') }}" placeholder="Masukkan Nama Penerbit" required>
        @error('penerbit')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="harga" class="col-form-label">Harga:</label>
        <input type="number" min="0" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga" value="{{ old('harga') }}" placeholder="Masukkan Harga Buku" required>
        @error('harga')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="modal-footer">
        <a href="/pengajuan" type="button" class="btn btn-secondary">Close</a>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
  </form>   
@endsection
  