@extends('layout.tamplate')
@section('title')
    Form Data Buku
@endsection
@section('titleform')
    Data Buku
@endsection
@section('content')
    <div class="d-flex">
        <a href="{{ route('barang.bulk-code-edit', ['code' => $buku->kode_barang]) }}"
            class="btn btn-primary mb-3 ms-auto ms-auto">Edit Data</a>
    </div>
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
                            <td>{{ $item->inventory_code ?: '-' }}</td>
                            <td>{{ $item->rusak ? 'Rusak' : 'Baik' }}</td>
                            <td>{{ $item->peminjaman?->id ? 'Dipinjam' : 'Tersedia' }}</td>
                            <td>{{ $item->updated_at ?: '-' }}</td>
                            @can('admin')
                                <td>
                                    <button class="badge bg-primary btnedit border-0" data-bs-toggle="modal"
                                        data-bs-target="#editModal"><span data-feather="edit-3"></span></button>

                                    <form id="delete-form-{{ $item->id }}"
                                        action="{{ route('barang.destroy', $item->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="badge bg-danger btndelete border-0"><span
                                                data-feather="x-circle"></span></button>
                                    </form>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
            </tbody>
            @endif
        </table>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formEdit" action="" method="post" class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit</h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @method('put')
                    @csrf

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
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.btndelete').click(function(e) {
                e.preventDefault();
                const deleteid = $(this).closest("tr").find('.delete_id').val();
                const form = $(`#delete-form-${deleteid}`);

                swal({
                        title: "Apakah anda yakin akan menghapus data?",
                        text: "Setelah dihapus, data tidak dapat dipulihkan lagi!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        }
                    });
            });

            $('.btnedit').click(function(e) {
                const row = $(this).closest('tr');
                const id = row.find('.delete_id').val();
                const code = row.find('td').eq(0).text();
                const rusak = row.find('td').eq(1).text() ===
                    'Rusak';

                $('#editModalLabel').text(`Edit ${code}`);

                $('#formEdit').attr('action', `/barang/${id}`);
                if (rusak) {
                    $('#not_oke').prop('checked', true);
                } else {
                    $('#ok').prop('checked', true);
                }
            });
        });
    </script>
@endsection
