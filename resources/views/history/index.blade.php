@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.breadcrumb')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="bi bi-clock-history"></i> History</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Jumlah Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesanans as $pesanan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pesanan->ordered_at }}</td>
                                        <td>
                                            @if ($pesanan->status == 1)
                                                Belum Dibayar
                                            @else
                                                Sudah Dibayar
                                            @endif
                                        </td>
                                        <td>Rp {{ number_format($pesanan->total_price, 0 , ',', '.') }}</td>
                                        <td>
                                            <a href="/history/{{ $pesanan->code }}" class="btn btn-sm btn-primary px-1 py-0"><i class="bi bi-info-circle" style="font-size: 0.8rem"> </i>Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>    
            </div>
        </div>
    </div>
@endsection