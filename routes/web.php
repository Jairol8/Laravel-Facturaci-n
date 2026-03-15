<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Admin
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;



// Ventas y Facturas
use App\Http\Controllers\SaleController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ClientController;

/*
|--------------------------------------------------------------------------
| Página principal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Perfil
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Ventas (Usuarios logueados)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // CRUD ventas
    Route::resource('sales', SaleController::class);

    // PDF factura
    Route::get('sales/{id}/pdf', [SaleController::class,'pdf'])
        ->name('sales.pdf');

    // Ver factura simple
    Route::get('/invoice/{id}', [InvoiceController::class,'show']);

    Route::resource('clients', ClientController::class)
    ->only(['index','store','destroy']);

});


/*
|--------------------------------------------------------------------------
| Panel Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','admin'])
    ->prefix('admin')
    ->group(function () {

        // Categorías
        Route::resource('categories', CategoryController::class);

        // Productos
        Route::resource('products', ProductController::class);

});


/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
