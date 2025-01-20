@extends('layout.tamplate')
@section('title')
Form Tambah Data Barang
@endsection
@section('content')
<form action="/peminjam/store" method="POST">
                @csrf
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-1">
                  <h3 class="text-primary"><strong>Daftar Data Peminjaman Barang</strong></h3>  
                </div>
              <p class="mb-4"><strong>Pastikan data yang anda masukan benar, Kesalahan data bisa mempengaruhi proses peminjaman !</strong></p>
              
                <!-- Email input -->
                <div class="form-outline mb-2">
                  <label class="form-label" for="email">E-mail :</label>
                  <input maxlength="50" autocomplete="off" placeholder="Masukan E-mail" type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" autofocus value="{{ old('email') }}"/>
                  @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
                </div>
              
                <!-- nama input -->
                <div class="form-outline mb-2">
                  <label class="form-label" for="nama">Nama Lengkap :</label>
                  <input maxlength="50" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" placeholder="Masukan Nama Lengkap" type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" autofocus value="{{ old('nama') }}"/>
                  @error('nama')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
                </div>
              
                <!-- no-wa input -->
                <div class="form-outline mb-2">
                  <label class="form-label" for="no_wa">No Whatshap (aktif) :</label>
                  <input onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" placeholder="Masukan No Whatshap" type="number" name="no_wa" id="no_wa" class="form-control @error('no_wa') is-invalid @enderror" autofocus value="{{ old('no_wa') }}" />
                  @error('no_wa')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
                </div>
              
                <div class="form-outline mb-4">
                  <label class="form-label" for="alamat">Alamat :</label>
                  <input maxlength="120" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" placeholder="Masukan No Alamat" type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" autofocus value="{{ old('alamat') }}" />
                  @error('alamat')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
                </div>
                
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">
                  Daftar
              </form>
@endsection


