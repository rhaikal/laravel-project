@extends('dashboard.layouts.app')

@section('content')
@if ($pesanans->isNotEmpty())
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pesanan</h1>
    </div>

    <div class="table-responsive col-lg-9">
        <table class="table table-stripped">
            <thead>
                <th scope="col">#</th>
                <th scope="col">Kode Unik</th>
                <th scope="col">Nama Pemesan</th>
                <th scope="col">Tanggal Pesan</th>
                <th scope="col">Harga Keseluruhan</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </thead>
            <tbody>
                @foreach ($pesanans as $pesanan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pesanan->code }}</td>
                    <td>{{ $pesanan->user->name }}</td>
                    <td>{{ $pesanan->ordered_at }}</td>
                    <td>{{ $pesanan->total_price }}</td>
                    <td>
                        @if($pesanan->status === '1') 
                            Belum Dibayar
                        @else
                            Sudah Dibayar 
                        @endif
                    </td>
                    <td>
                        <a href="/dashboard/pesanans/{{ $pesanan->code }}" class="badge bg-info"><span data-feather="eye"></span></a>
                        <form action="/dashboard/pesanans/{{ $pesanan->code }}" method="post" class="d-inline">
                            @method('put')
                            @csrf
                            <button class="badge @if($pesanan->status === '1') bg-success @else bg-warning @endif border-0" onclick="return confirm('Apakah anda yakin?')">
                                @if($pesanan->status === '1') 
                                    <span data-feather="check-circle"></span>
                                @else
                                    <span data-feather="minus-circle"></span> 
                                @endif
                            </button>
                        </form>
                        <form action="/dashboard/pesanans/{{ $pesanan->code }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')">
                                <span data-feather="trash-2"></span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="position-absolute top-50 start-50 translate-middle">
        <h1>Tidak ada pesanan</h1>
    </div>
@endif
@endsection