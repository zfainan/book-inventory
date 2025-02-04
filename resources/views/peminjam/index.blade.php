@extends('layout.tamplate')
@section('title')
    Data Peminjam
@endsection
@section('titleform')
    Data Peminjam
@endsection
@section('content')
    <div class="col">
        <a href="/peminjam/register" type="button" class="btn btn-primary btn-sm mb-4">Tambah Data <span
                data-feather="file-plus"></span></a>
    </div>
    <div class="table-responsive">
        <table id="datatables" class="table-hover me-3 mt-3 table text-gray-800">
            <thead>
                <tr class="bg-primary">
                    <th scope="col">NO</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nama</th>
                    <th scope="col">No Whatsapp</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Update</th>
                    @can('admin')
                        <th scope="col">Aksi</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @if ($peminjam->count() > 0)
                    @foreach ($peminjam as $items => $item)
                        @csrf
                        <tr>
                            <input type="hidden" class="delete_id" value="{{ $item->id }}">
                            <th>{{ $items + $peminjam->firstItem() }}</th>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->no_wa }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->updated_at }}</td>
                            @can('admin')
                                <td>
                                    <a href="peminjam/{{ $item->id }}/edit" class="badge bg-primary border-0"><span
                                            data-feather="edit-3"></a>
                                    <form action="{{ route('peminjam.destroy', $item->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="badge bg-danger btndelete border-0"><span
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
                                url: 'peminjam/' + deleteid,
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
