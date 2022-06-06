@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-4">
            <img class="img-fluid mx-auto d-block" src="img/logo.png" width="700" alt="">
        </div>
        <div class="row justify-content-center">
            @foreach ($barangs as $barang)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <img src="img/{{ $barang->image }}.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title logo-color">{{ $barang->item_name }}</h5>
                            <p class="card-text">
                                <strong>Harga </strong>: Rp {{ number_format($barang->price, 0 , ',', '.') }} <br>
                                <strong>Stok </strong>: {{ $barang->stock }} <br>
                                <hr>
                                <strong>Keterangan</strong> <br>
                                <p class="text-muted">Ukuran Batik : {{ $barang->size }}</p>
                            </p>
                            <a href="/pesan/{{ $barang->id }}" class="btn btn-primary d-block justify-content-center text-center"><i class="bi bi-bag-fill"></i> Pesan</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
