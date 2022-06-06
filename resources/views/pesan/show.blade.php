@extends('layouts.app')

@section('content')
<div class="container">
    @if ($barang->stock > 0) 
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ $barang->item_name }}</li>
            </ol>
        </nav>
        <div class="card">
            <div class="row">
                <div class="col-md-4">
                    <img src="/img/{{ $barang->image }}.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-md-8 my-auto">
                    <div class="card-body">
                        <h3 class="card-title logo-color">{{ $barang->item_name }}</h3>
                        <form action="/pesan/{{ $barang->id }}" method="post">
                            @csrf
                            <input type="hidden" name="barang_id" value="{{ $barang->id }}">
                            <table class="table">
                                <tr>
                                    <input type="hidden" name="price" value="{{ $barang->price }}">
                                    <th scope="row">Harga</th>
                                    <td>:</td>
                                    <td>Rp {{ number_format($barang->price, 0 , ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="stock" value="{{ $barang->stock }}">
                                    <th scope="row">Stok</th>
                                    <td>:</td>
                                    <td>{{ $barang->stock }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Size</th>
                                    <td>:</td>
                                    <td>{{ $barang->size }}</td>
                                </tr>
                                <tr>
                                    <th scope="row"><label for="quantity">Jumlah Pesan</label></th>
                                    <td>:</td>
                                    <td><input type="number" name="quantity" id="quantity" min="1" max="{{ $barang->stock }}" ></td>
                                </tr>
                            </table>
                            <div class="d-flex justify-content-center text-center">
                                <button type="submit" class="btn btn-secondary"><i class="bi bi-bag-fill"></i> Masukkan Ke Keranjang</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection