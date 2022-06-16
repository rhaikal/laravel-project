@extends('dashboard.layouts.app')

@section('content')
    <a href="/dashboard/pesanans" class="btn btn-info"><span data-feather="arrow-left"></span> Kembali</a>
    <form action="/dashboard/pesanans/{{ $pesanan->code }}" method="post" class="d-inline">
        @method('put')
        @csrf
        <button class="btn @if($pesanan->status === '1') btn-success @else btn-warning @endif border-0" onclick="return confirm('Apakah anda yakin?')">
            @if($pesanan->status === '1') 
                <span data-feather="check-circle"></span> Konfirmasi Pesanan
            @else
                <span data-feather="minus-circle"></span> Hapus Konfirmasi
            @endif
        </button>
    </form>
    <form action="/dashboard/pesanans/{{ $pesanan->code }}" method="post" class="d-inline">
        @method('delete')
        @csrf
        <button class="btn btn-danger border-0" onclick="return confirm('Apakah anda yakin?')">
            <span data-feather="trash-2"></span> Hapus Pesanan
        </button>
    </form>

    <div class="card mt-2">
        <div class="card-body">
            <h3 class="card-title border-bottom border-secondary"><i class="bi bi-cart-check-fill"></i> Detail Pemesanan</h3>
            <p class="card-text">
                <strong>Nama Pemesan : </strong>{{ $pesanan->user->name }} <br />
                <strong>Status : </strong> 
                @if ($pesanan->status === '1')
                    Belum Dibayar
                @else
                    Sudah Dibayar
                @endif
            </p>
            <p class="text-muted text-date-end">Tanggal : {{ $pesanan->ordered_at }}</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Gambar</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Kain</th>
                        <th>Jumlah Harga</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($pesanan->pesananDetail as $pesanan_detail)    
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center"><img width="100" src="{{ asset('storage/' . $pesanan_detail->barang->image) }}" alt=""></td>
                            <td>{{ $pesanan_detail->barang->item_name }}</td>
                            <td>{{ $pesanan_detail->amount }} kain</td>
                            <td>Rp  {{ number_format($pesanan->total_price + $pesanan->total_price * 2 / 100, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Harga Keseluruhan Barang</th>
                        <th>: Rp {{ number_format($pesanan->total_price, 0, ',', '.') }}</th>
                    </tr>
                    <tr>
                        <th colspan="4">Pajak</th>
                        <th>: Rp  {{ number_format($pesanan->total_price * 2 / 100, 0, ',', '.') }}</th>
                    </tr>
                    <tr>
                        <th colspan="4">Total yang harus ditranfer</th>
                        <th>: Rp  {{ number_format($pesanan->total_price + $pesanan->total_price * 2 / 100, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection