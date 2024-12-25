@extends('layouts.app')

@section('title', 'Edit Produk')

@section('contents')
    <hr />
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row mb-3">
            <div class="col">
                <label class="form-label" for="name">Nama</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Nama Produk" value="{{ $product->name }}" required>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label class="form-label" for="price">Harga</label>
                <input type="number" name="price" id="price" class="form-control" placeholder="Harga" value="{{ $product->price }}" required>
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col">
                <label for="category_id" class="form-label">Kategori</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label class="form-label" for="stock">Stok</label>
                <input type="number" name="stock" id="stock" class="form-control" placeholder="Stok" value="{{ $product->stock }}" required>
                @error('stock')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col">
                <label class="form-label" for="description">Deskripsi</label>
                <textarea class="form-control" name="description" id="description" placeholder="Deskripsi" required>{{ $product->description }}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label" for="image">Gambar</label>
                <input type="file" name="image" id="image" class="form-control" placeholder="Gambar">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
 
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
@endsection