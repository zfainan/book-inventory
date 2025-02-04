@extends('layout.tamplate')
@section('title')
    Form Transaksi Peminjaman
@endsection
@section('titleform')
    Form Peminjaman Barang
@endsection
@section('content')
    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <a href="/peminjaman/create" type="button" class="btn btn-primary btn-sm mb-3">Tambah Data <span
                        data-feather="file-plus"></span></a>
            </div>
        </div>
        <table id="datatables" class="table-hover table-responsive-fluid me-3 mt-3 table text-gray-800">
            <thead>
                <tr class="bg-primary">
                    <th scope="col">NO</th>
                    <th scope="col">NAMA PEMINJAM</th>
                    <th scope="col">KODE BUKU</th>
                    <th scope="col">JUDUL BUKU</th>
                    <th scope="col">TGL PINJAM</th>
                    <th scope="col">KEPERLUAN</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @if (count($peminjaman))
                    @foreach ($peminjaman as $items => $item)
                        @csrf
                        <tr>
                            <input type="hidden" class="delete_id" value="{{ $item->id }}">
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $item->nama_peminjam }}</td>
                            <td>{{ $item->barang->inventory_code }}</td>
                            <td>{{ $item->barang->nama_barang }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->keperluan }}</td>
                            <td>
                                <span class="bg-warning badge border-0">DI PINJAM</span>
                            </td>
                            <td>
                                <a href="peminjaman/{{ $item->id }}/edit" class="badge bg-success border-0"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $item->id }}"><span
                                        data-feather="check-circle"></a>
                            </td>
                        </tr>
                    @endforeach

            </tbody>
            @endif

        </table><br>
    </div>

    {{-- update barang --}}
    @foreach ($peminjaman as $item)
        <div class="modal fade" id="exampleModal-{{ $item->id }}" tabindex="-1"
            aria-labelledby="exampleModal-{{ $item->id }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <form action="/peminjaman/{{ $item->id }}" method="post" class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModal-{{ $item->id }}">Konfirmasi <span
                                data-feather="alert-circle"></span> </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @method('put')
                        @csrf

                        <p>Apakah anda yakin akan menyelesaikan peminjaman barang {{ $item->barang->inventory_code }}?</p>

                        <!-- Input untuk Jumlah Barang Rusak -->
                        <div class="form-group">
                            <label for="rusak">Kondisi</label>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rusak" id="ok" value="0"
                                    checked>
                                <label class="form-check-label" for="ok">
                                    Baik
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rusak" id="not_oke" value="1">
                                <label class="form-check-label" for="not_oke">
                                    Rusak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Selesaikan</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection

@section('content2')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Pengembalian Selesai</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatables2" class="table-hover table-responsive-fluid me-3 mt-3 table text-gray-800">
                        <thead>
                            <tr class="bg-success">
                                <th scope="col">NO</th>
                                <th scope="col">NAMA PEMINJAM</th>
                                <th scope="col">JUDUL BUKU</th>
                                <th scope="col">JUMLAH PINJAM</th>
                                <th scope="col">TGL PINJAM</th>
                                <th scope="col">TGL KEMBALI</th>
                                <th scope="col">KEPERLUAN</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (count($pengembalian))
                                @foreach ($pengembalian as $items => $item)
                                    <tr>
                                        <input type="hidden" class="delete_id" value="{{ $item->id }}">
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $item->nama_peminjam }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>{{ $item->jumlah_pinjam }}</td>
                                        <td>{{ $item->tgl_pinjam }}</td>
                                        <td>{{ $item->updated_at }} </td>
                                        <td>{{ $item->keperluan }}</td>
                                        <td>
                                            <span class="bg-success badge border-0">SELESAI</span>
                                        </td>
                                        <td>
                                            <form action="{{ route('pengembalian.destroy', ['id' => $item->id]) }}"
                                                method="post" class="delete-form">
                                                @method('delete')
                                                @csrf
                                                <input type="hidden" class="delete_id" value="{{ $item->id }}">
                                                <button type="submit" class="btn btn-danger btndelete">
                                                    <span data-feather="x-circle"></span>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                        </tbody>
                        @endif

                    </table><br>
                </div>
            </div>
            <!-- /.card-body -->

            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            // Set the CSRF token for AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle the click event on the delete button
            $('.btndelete').click(function(e) {
                e.preventDefault(); // Prevent form submission

                // Get the ID to be deleted
                var deleteid = $(this).closest("form").find('.delete_id').val();

                // Show confirmation dialog using SweetAlert
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
                                "_token": $('input[name=_token]').val(), // CSRF token
                                'id': deleteid, // ID to be deleted
                            };

                            // Perform the AJAX request to delete the data
                            $.ajax({
                                type: "DELETE",
                                url: '/pengembalian/destroy/' +
                                    deleteid, // Make sure URL matches the route
                                data: data,
                                success: function(response) {
                                    // Show success message and reload the page
                                    swal(response.status, {
                                        icon: "success",
                                    }).then((result) => {
                                        location
                                            .reload(); // Reload the page after successful deletion
                                    });
                                },
                                error: function() {
                                    // Handle error if the delete fails
                                    swal("Terjadi kesalahan!", "Data gagal dihapus",
                                        "error");
                                }
                            });
                        }
                    });
            });
        });
    </script>

    <script type="text/javascript">
        window.onload = function() {
            jam();
        }

        function jam() {
            var e = document.getElementById('jam'),
                d = new Date(),
                h, m, s;
            h = d.getHours();
            m = set(d.getMinutes());
            s = set(d.getSeconds());

            e.innerHTML = h + ':' + m + ':' + s;

            setTimeout('jam()', 1000);
        }

        function set(e) {
            e = e < 10 ? '0' + e : e;
            return e;
        }
    </script>

@endsection
