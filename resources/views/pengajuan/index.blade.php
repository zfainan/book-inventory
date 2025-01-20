@extends('layout.tamplate')
@section('title')
    Form Transaksi Pengajuan
@endsection
@section('titleform')
    Form Transaksi Pengajuan
@endsection
@section('content')
    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <a href="/pengajuan/create" type="button" class="btn btn-primary btn-sm mb-3">Tambah Pengajuan <span
                        data-feather="file-plus"></span></a>
            </div>
        </div>
        <table id="datatables" class="table-hover table-responsive-fluid me-3 mt-3 table text-gray-800">
            <thead>
                <tr class="bg-primary">
                    <th scope="col">NO</th>
                    <th scope="col">JUDUL</th>
                    <th scope="col">JUMLAH</th>
                    <th scope="col">JENIS</th>
                    <th scope="col">PENERBIT</th>
                    <th scope="col">HARGA</th>
                    <th scope="col">TOTAL</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @if (count($pengajuan1))
                    @foreach ($pengajuan1 as $items => $item)
                        @csrf
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Menambahkan nomor urut -->
                            <input type="hidden" class="delete_id" value="{{ $item->id }}">
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ $item->jenis }}</td>
                            <td>{{ $item->penerbit }}</td>
                            <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->jumlah * $item->harga, 0, ',', '.') }}</td>
                            <td>{{ $item->status }}</td>
                            <td>
                                <form action="{{ route('pengajuan.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="badge bg-danger btndelete border-0">
                                        <span data-feather="x-circle"></span>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
            </tbody>
            @endif

        </table>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
        </script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>

        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('.btndelete').click(function(e) {
                    e.preventDefault();
                    var deleteid = $(this).closest("tr").find('.delete_id').val();
                    swal({
                            title: "Apakah anda yakin akan menghapus data?",
                            text: "Setelah dihapus, data tidak dapat dipulihkan lagi!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {

                                var data = {
                                    "_token": $('input[name=_token]').val(),
                                    'id': deleteid,
                                };
                                $.ajax({
                                    type: "DELETE",
                                    url: 'pengajuan/' + deleteid,
                                    data: data,
                                    success: function(response) {
                                        swal(response.status, {
                                                icon: "success",
                                            })
                                            .then((result) => {
                                                location.reload();
                                            });
                                    }
                                });
                            }
                        });
                });
            });
        </script>
    @endsection
    @section('content2')
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form ACC</h3>
                    <div class="table-responsive">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('cetakPengajuan') }}" target="_blank" type="button"
                                    class="btn btn-primary btn-sm mb-3">
                                    Print Data <span data-feather="file-plus"></span>
                                </a>
                                <section class="content">
                            </div>
                        </div>
                        <table id="datatables2" class="table-hover table-responsive-fluid mt-3 table text-gray-800">
                            <thead>
                                <tr class="bg-primary text-white">
                                    <th scope="col">NO</th>
                                    <th scope="col">JUDUL</th>
                                    <th scope="col">JUMLAH</th>
                                    <th scope="col">JENIS</th>
                                    <th scope="col">PENERBIT</th>
                                    <th scope="col">HARGA</th>
                                    <th scope="col">TOTAL</th>
                                    <th scope="col">STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($pengajuan))
                                    @foreach ($pengajuan as $items => $item)
                                        @csrf
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <input type="hidden" class="delete_id" value="{{ $item->id }}">
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ $item->jumlah }}</td>
                                            <td>{{ $item->jenis }}</td>
                                            <td>{{ $item->penerbit }}</td>
                                            <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                                            <td>{{ number_format($item->jumlah * $item->harga, 0, ',', '.') }}</td>
                                            <td>{{ $item->status }}</td>
                                            <form action="{{ route('pengajuan.destroy', $item->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                            </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
        </section>
    @endsection
