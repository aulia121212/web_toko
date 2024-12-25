@extends('layouts.app')

@section('title', 'Produk Detail')

@section('contents')
    <hr />
    <div class="container">
        <h2>Detail Produk</h2>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Nama</th>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>{{ number_format($product->price, 3, '.', '.') }}</td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>{{ $category->name }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $product->description }}</td>
                </tr>
                <tr>
                    <th>Gambar</th>
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="max-width: 200px;">
                        @else
                            <p>Tidak ada gambar tersedia</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $product->created_at->format('d-m-Y H:i:s') }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $product->updated_at->format('d-m-Y H:i:s') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection