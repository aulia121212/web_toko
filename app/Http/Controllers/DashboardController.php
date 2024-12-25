<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class DashboardController extends Controller
{
    public function index()
{
    \Log::info('Entering DashboardController@index');

    $totalStock = Product::sum('stock');
    \Log::info('Total Stock: ' . $totalStock);

    $totalProduct = Product::count();
    \Log::info('Total Product: ' . $totalProduct);

    $totalCategory = Category::count();
    \Log::info('Total Category: ' . $totalCategory);

    return view('dashboard', compact('totalStock','totalProduct', 'totalCategory'));
}

    public function api()
    {
        $newestProducts = Product::orderBy('created_at', 'desc')->take(5)->get();
        $categories = Category::withCount('products')->take(3)->get();

        return response()->json([
            'newestProducts' => $newestProducts,
            'categories' => $categories,
        ]);
    }
}
