@extends('dashboard.layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New Post</h1>
    </div>

    <div class="col-lg-8">
        <form action="/dashboard/barangs" method="post" class="mb-5">
            @csrf
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input type="text" class="form-control @error('image') is-invalid @enderror" id="image" name="image" autofocus value="{{ old('image') }}">
                @error('image')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="item_name" class="form-label">Nama Barang</label>
                <input type="text" class="form-control @error('item_name') is-invalid @enderror" id="item_name" name="item_name" required autofocus value="{{ old('item_name') }}">
                @error('item_name')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price"  pattern="(Rp\.\s*)\d{1,3}(\.\d{3})*" required autofocus value="{{ old('price') }}">
                @error('price')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" min="1" required autofocus value="{{ old('stock') }}">
                @error('stock')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="size" class="form-label">Ukuran</label>
                <input type="text" class="form-control @error('size') is-invalid @enderror" id="size" name="size" required autofocus value="{{ old('size') }}">
                @error('size')
                    <div class="invalid-feedback">
                    {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Buat Barang</button>
        </form>
    </div>
@endsection