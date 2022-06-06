@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">Home</a></li>
                  <li class="breadcrumb-item"><a href="/history">History</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
            <div class="col-md-12">
                @if($pesanan->status == 1)
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Konfirmasi Berhasil</h3>
                            <h5>Pesanan anda sudah dikonfirmasi, selanjutnya lakukan pembayaran di rekening <strong>Bank BRI Nomer Rekening : 32113-821312-123</strong> dengan nominal yang tertera di bawah</h5>
                        </div>
                    </div>
                @endif

                <div class="card mt-2">
                    <div class="card-body">
                        <h3 class="card-title"><i class="bi bi-cart-check-fill"></i> Detail Pemesanan</h3>
                        <p class="text-muted text-date-end">Tanggal : {{ $pesanan->ordered_at }}</p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Status</th>
                                    <th>Jumlah Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesanan->pesananDetail as $pesanan_detail)    
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pesanan_detail->barang->item_name }}</td>
                                        <td>{{ $pesanan_detail->amount }} kain</td>
                                        <td>Rp  {{ number_format($pesanan->total_price + $pesanan->total_price * 2 / 100, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3">Harga Keseluruhan Barang</th>
                                    <th>: Rp {{ number_format($pesanan->total_price, 0, ',', '.') }}</th>
                                </tr>
                                <tr>
                                    <th colspan="3">Pajak</th>
                                    <th>: Rp  {{ number_format($pesanan->total_price * 2 / 100, 0, ',', '.') }}</th>
                                </tr>
                                <tr>
                                    <th colspan="3">Total yang harus ditranfer</th>
                                    <th>: Rp  {{ number_format($pesanan->total_price + $pesanan->total_price * 2 / 100, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>    
            </div>
        </div>
    </div>
@endsection