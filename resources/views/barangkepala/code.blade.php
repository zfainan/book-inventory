@extends('layoutkepala.tamplate')
@section('title')
    Form Data Buku
@endsection
@section('titleform')
    Data Buku
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">Kode Barang</p>
                    <h5>{{ $buku->kode_barang }}</h5>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">Nama Barang</p>
                    <h5>{{ $buku->nama_barang }}</h5>
                </div>
            </div>
        </div>

        @if ($buku->pengarang)
            <div class="col-lg-3 col-6">
                <div class="card">
                    <div class="card-body">
                        <p class="mb-0">Pengarang</p>
                        <h5>{{ $buku->pengarang }}</h5>
                    </div>
                </div>
            </div>
        @endif

        @if ($buku->penerbit)
            <div class="col-lg-3 col-6">
                <div class="card">
                    <div class="card-body">
                        <p class="mb-0">Penerbit</p>
                        <h5>{{ $buku->penerbit }}</h5>
                    </div>
                </div>
            </div>
        @endif

        @if ($buku->asal)
            <div class="col-lg-3 col-6">
                <div class="card">
                    <div class="card-body">
                        <p class="mb-0">Asal</p>
                        <h5>{{ $buku->asal }}</h5>
                    </div>
                </div>
            </div>
        @endif

        @if ($buku->jenis_buku)
            <div class="col-lg-3 col-6">
                <div class="card">
                    <div class="card-body">
                        <p class="mb-0">Jenis Buku</p>
                        <h5>{{ $buku->jenis_buku }}</h5>
                    </div>
                </div>
            </div>
        @endif

        @if ($buku->type)
            <div class="col-lg-3 col-6">
                <div class="card">
                    <div class="card-body">
                        <p class="mb-0">Type</p>
                        <h5>{{ $buku->type }}</h5>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-lg-3 col-6">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">Jumlah Total</p>
                    <h5>{{ $stock }}</h5>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">Jumlah Rusak</p>
                    <h5>{{ $damaged }}</h5>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">Tersedia</p>
                    <h5>{{ $stock - $damaged }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id="datatables" class="table-hover me-3 mt-3 table text-gray-800">
            <thead>
                <tr class="bg-primary">
                    <th scope="col">No</th>
                    <th scope="col">Kode Barang</th>
                    <th scope="col">Kondisi Barang</th>
                    <th scope="col">Status</th>
                    <th scope="col">Last Update</th>
                </tr>
            </thead>
            <tbody>
                @if ($data->count() > 0)
                    @foreach ($data as $items => $item)
                        @csrf
                        <tr>
                            <input type="hidden" class="delete_id" value="{{ $item->id }}">
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $item->inventory_code ?: '-' }}</td>
                            <td>{{ $item->rusak ? 'Rusak' : 'Baik' }}</td>
                            <td>{{ $item->peminjaman?->id ? 'Dipinjam' : 'Tersedia' }}</td>
                            <td>{{ $item->updated_at ?: '-' }}</td>
                        </tr>
                    @endforeach
            </tbody>
            @endif
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
@endsection
