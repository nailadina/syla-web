@extends('layout.base')

@section('content')
<div class="card mb-4">
    <div class="formcreate m-5">
        <form action="{{url('dashboard')}}/product/{{$product->id}}" enctype="multipart/form-data" method="POST">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label>Nama Produk</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{$product->name}}">
            </div>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label>Masukkan Kategori Produk</label>
                <br>
                <select name="category_id">
                    <option disabled>-- Pilih Kategori Produk --</option>
                    @foreach ($category as $item)
                    @if ($item->id === $product->category_id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                    @else 
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            @error('category')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label>Stock</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="stock" value="{{$product->stock}}">
            </div>
            @error('stock')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label>Deskripsi Produk</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="description" value="{{$product->description}}">
            </div>
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label>Gambar Produk</label>
                <input type="file" class="form-control" id="exampleInputPassword1" name="picture" value="{{ $product->picture }}">
            </div>
            @error('picture')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label>Harga Produk</label>
                <input type="number" class="form-control" id="exampleInputPassword1" name="price" value="{{ $product->price }}">
            </div>
            @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection