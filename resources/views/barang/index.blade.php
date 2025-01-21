@extends('layout.tamplate')
@section('title')
    Form Data Buku
@endsection
@section('titleform')
    Data Buku
@endsection
@section('content')
    @can('admin')
        <a href="/barang/create" type="button" class="btn btn-primary btn-sm mb-4">Tambah Data <span
                data-feather="file-plus"></span></a>
    @endcan

    <a href="{{ route('cetakBarang') }}" target="_blank" type="button" class="btn btn-primary btn-sm mb-4">Print Data <span
            data-feather="file-plus"></span></a>

    <div class="table-responsive">
        <table id="datatables" class="table-hover me-3 mt-3 table text-gray-800">
            <thead>
                <tr class="bg-primary">
                    <th scope="col">NO</th>
                    <th scope="col">KODE Barang</th>
                    <th scope="col">NAMA Barang</th>
                    <th scope="col">JUMLAH</th>
                    <th scope="col">PENGARANG</th>
                    <th scope="col">PENERBIT</th>
                    <th scope="col">ASAL</th>
                    <th scope="col">JENIS BUKU</th>
                    <th scope="col">TYPE</th>
                    @can('admin')
                        <th scope="col">AKSI</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @if ($data->count() > 0)
                    @foreach ($data as $items => $item)
                        @csrf
                        <tr>
                            <input type="hidden" class="delete_id" value="{{ $item->id }}">
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $item->kode_barang ?: '-' }}</td>
                            <td>{{ $item->nama_barang ?: '-' }}</td>
                            <td>{{ $item->qty ?: '-' }}</td>
                            <td>{{ $item->pengarang ?: '-' }}</td>
                            <td>{{ $item->penerbit ?: '-' }}</td>
                            <td>{{ $item->asal ?: '-' }}</td>
                            <td>{{ $item->jenis_buku ?: '-' }}</td>
                            <td>{{ $item->type ?: '-' }}</td>
                            @can('admin')
                                <td>
                                    <a href="{{ route('barang.code', ['code' => $item->kode_barang]) }}"
                                        class="badge bg-primary border-0"><span data-feather="eye"></span></a>
                                </td>
                            @endcan
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
