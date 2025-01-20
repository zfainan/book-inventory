@extends('layout.tamplate')
@section('title')
Form Data Buku
@endsection
@section('titleform')
Data Buku
@endsection
@section('content')
@can('admin')    
<a href="/barang/create" type="button" class="btn btn-primary btn-sm mb-4">Tambah Data <span data-feather="file-plus"></span></a>
@endcan
<a href="{{ route('cetakBarang') }}" target="_blank" type="button" class="btn btn-primary btn-sm mb-4">Print Data <span data-feather="file-plus"></span></a>

<div class="table-responsive">
    <table id="datatables" class="table table-hover mt-3 me-3 text-gray-800">
        <thead>
            <tr class="bg-primary">
                <th scope="col">NO</th>
                <th scope="col">KODE Barang</th>
                <th scope="col">NAMA Barang</th>
                <th scope="col">JUMLAH</th>
                <th scope="col">JUMLAH RUSAK</th>
                <th scope="col">PENGARANG</th>
                <th scope="col">PENERBIT</th>
                <th scope="col">ASAL</th>
                <th scope="col">JENIS BUKU</th>
                <th scope="col">Type</th>
                <th scope="col">UPDATE</th>
                @can('admin')                  
                <th scope="col">AKSI</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @if ($data->count()>0)                  
            @foreach ($data as $items => $item)
            @csrf
            <tr>
                <input type="hidden" class="delete_id" value="{{ $item->id }}">
                <th>{{ $items + $data->firstItem() }}</th>
                <td>{{ $item->kode_barang ?: '-' }}</td>                    
                <td>{{ $item->nama_barang ?: '-' }}</td>                    
                <td>{{ $item->qty ?: '-' }}</td> 
                <td>{{ $item->qty_rusak ?? '-' }}</td>
                <td>{{ $item->pengarang ?: '-' }}</td> 
                <td>{{ $item->penerbit ?: '-' }}</td> 
                <td>{{ $item->asal ?: '-' }}</td>  
                <td>{{ $item->jenis_buku ?: '-' }}</td>
                <td>{{ $item->type ?: '-' }}</td>                                          
                <td>{{ $item->updated_at ?: '-' }}</td>                    
                @can('admin')                    
                <td>
                    <a href="barang/{{ $item->id }}/edit" class="badge bg-primary border-0"><span data-feather="edit-3"></span></a>
                    <form action="{{ route('barang.destroy',$item->id) }}" method="post" class="d-inline">
                      @csrf
                      @method('delete')
                    <button class="badge bg-danger border-0 btndelete"><span data-feather="x-circle"></span></button>
                    </form>
                  </td>
                @endcan
            </tr>
            @endforeach  
        </tbody>
        @endif
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btndelete').click(function (e) {
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
                            url: 'barang/' + deleteid,
                            data: data,
                            success: function (response) {
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
