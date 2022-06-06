@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.breadcrumb')
        <div class="card">
            <div class="card-header pt-3">
                <h3 class="card-title text-center"><i class="bi bi-cart-fill"></i> Check Out</h3>
            </div>
            <div class="card-body mt-2">
                <div class="row justify-content-center">
                    @if (!empty($pesanan->pesananDetail))
                        <div class="table-responsive col-lg-9">
                            <span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-secondary">{{ $pesanan->ordered_at }}</span>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th class="text-center">Gambar</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Total Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    @foreach ($pesanan->pesananDetail as $pesanan_detail)    
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <img width="100" src="/img/{{ $pesanan_detail->barang->image }}.jpg" alt="">
                                            </td>
                                            <td>{{ $pesanan_detail->barang->item_name }}</td>
                                            <td>{{ $pesanan_detail->amount }} kain</td>
                                            <td>Rp {{ number_format($pesanan_detail->total_price, 0 , ',', '.') }}</td>
                                            <td>
                                                <form action="/pesan/checkout/{{ $pesanan_detail->id }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus pesanan?')" style="padding: .25rem .25rem .0rem .25rem"><i style="width: 0.rem" class="bi bi-trash-fill"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">Harga Keseluruhan :</th>
                                        <td colspan="2">Rp. {{ number_format($pesanan->total_price, 0, ',', '.') }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-lg-9">
                            <a href="/pesan/konfirmasi" class="d-block btn btn-primary" onclick="return confirm('Barang belanjaan sudah sesuai dengan apa yang dibeli?')">Konfirmasi Pesanan</a>
                        </div>
                    @else
                        <h1 class="text-muted text-center">
                            Belum Memesan
                        </h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection