<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $queryProducts = Product::orderBy('created_at', 'DESC')->with('category');
        $search = $request->input('search');
        if (!empty($search)) {
            $queryProducts->where('name', 'like', '%' . $search . '%');
        }
        $products = $queryProducts->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required',
            'description' => 'required',
        ]);

        // Mengupload gambar
        $image = $request->file('image');
        $filename = date('Y-m-d') . '-' . time() . '-' . $image->getClientOriginalName();
        $path = 'image-products/' . $filename;

        // Simpan gambar ke storage
        Storage::disk('public')->put($path, file_get_contents($image));

        // Simpan produk ke database dengan nama file gambar
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image' => $path, // Simpan path gambar yang benar
        ]);

        return redirect()->route('products')->with('success', 'Berhasil menambah produk');
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        $category = Category::find($product->category_id);
        return view('products.show', compact('product', 'category'));
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048', // Gambar bersifat opsional saat update
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required',
            'description' => 'required',
        ]);

        $product = Product::findOrFail($id);

        // Jika ada gambar baru yang diupload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = date('Y-m-d') . '-' . time() . '-' . $image->getClientOriginalName();
            $path = 'image-products/' . $filename;

            // Simpan gambar ke storage
            Storage::disk('public')->put($path, file_get_contents($image));

            // Update produk dengan path gambar yang baru
            $product->image = $path;
        }

        // Update data produk lainnya
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->description = $request->description;

        $product->save();

        return redirect()->route('products')->with('success', 'Berhasil mengupdate produk');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products')->with('success', 'Berhasil menghapus produk');
    }
}