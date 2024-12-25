<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VerifikasiController;

 
Route::get('/', function () {
    return view('home');
});
 
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
  
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
  
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});
  
Route::middleware(['auth'])->group(function () {
    Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi');

    Route::controller(DashboardController::class)->prefix('dashboard')->group(function () {
        Route::get('', 'index')->name('dashboard');
        Route::get('/api', 'api')->name('dashboard.api');
    });
 
    Route::controller(ProductController::class)->prefix('products')->group(function () {
        Route::get('', 'index')->name('products');
        Route::get('create', 'create')->name('products.create');
        Route::post('store', 'store')->name('products.store');
        Route::get('show/{id}', 'show')->name('products.show');
        Route::get('edit/{id}', 'edit')->name('products.edit');
        Route::put('edit/{id}', 'update')->name('products.update');
        Route::delete('destroy/{id}', 'destroy')->name('products.destroy');
    });




    Route::middleware(['super_admin'])->group(function () {
        Route::get('/verifikasi', [VerifikasiController::class, 'index']);
    });
    
    

    Route::controller(CategoryController::class)->prefix('categories')->group(function () {
        Route::get('', 'index')->name('categories');
        Route::get('create', 'create')->name('categories.create');
        Route::post('store', 'store')->name('categories.store');
        Route::get('show/{id}', 'show')->name('categories.show');
        Route::get('edit/{id}', 'edit')->name('categories.edit');
        Route::put('edit/{id}', 'update')->name('categories.update');
        Route::delete('destroy/{id}', 'destroy')->name('categories.destroy');
    });
 
    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');

    Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi');

    Route::middleware('super_admin')->group(function () {
        Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi');
    });
    
    Route::get('/verifikasi/create', [VerifikasiController::class, 'create'])->name('verifikasi.create');
Route::post('/verifikasi', [VerifikasiController::class, 'store'])->name('verifikasi.store');



Route::get('/umkm/{id}/edit', [VerifikasiController::class, 'edit'])->name('umkm.edit');
Route::put('/umkm/{id}', [VerifikasiController::class, 'update'])->name('umkm.update');
Route::delete('/umkm/{id}', [VerifikasiController::class, 'destroy'])->name('umkm.destroy');
// ... other routes





});