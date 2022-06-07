@extends('dashboard.layouts.app')

@section('content')    
    <div class="container">
        <div class="row my-3">
            <div class="col-lg-12">
                <a href="/dashboard/barangs" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
                <a href="/dashboard/barangs/{{ $barang->id }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>
                <form action="/dashboard/barangs/{{ $barang->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Hapus</button>
                </form>
            </div>
            @if($barang->image)
                <div class="col-lg-4 mt-3" style="max-height: 204px; overflow:hidden">
                    <img src="/img/{{ $barang->image }}.jpg" class="img-fluid" alt="">
                </div>
            @endif
            <div class="@if($barang->image) col-lg-8 @else col-md-12 @endif mt-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title logo-color">{{ $barang->item_name }}</h3>
                        <table class="table table">
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
