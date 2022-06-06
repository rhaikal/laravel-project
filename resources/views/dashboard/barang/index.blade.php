@extends('dashboard.layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Barang</h1>
    </div>
    
    <div class="table-responsive col-lg-9">
        <a href="/dashboard/barangs/create" class="btn btn-primary mb-3">Buat Barang Baru</a>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $barang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $barang->item_name }}</td>
                        <td>{{ $barang->price }}</td>
                        <td>{{ $barang->stock }}</td>
                        <td>
                            <a href="/dashboard/barangs/{{ $barang->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
                            <a href="/dashboard/barangs/{{ $barang->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                            <form action="/dashboard/barangs/{{ $barang->id }}" method="post" class="d-inline">
                              @method('delete')
                              @csrf
                              <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')"><span data-feather="x-circle"></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection