<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
        return view('welcome');
    });

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::middleware(['role:Admin'])->group(function () {
        Route::get('users/export/pdf', [UserController::class, 'exportPdf'])
            ->name('users.export.pdf');
        Route::get('users/export/excel', [UserController::class, 'exportExcel'])
            ->name('users.export.excel');

        Route::resource('users', UserController::class);
    });

    Route::middleware(['role:Admin,Staff'])->group(function () {
        Route::get('categories/export/pdf', [CategoryController::class, 'exportPdf'])
            ->name('categories.export.pdf');
        Route::get('categories/export/excel', [CategoryController::class, 'exportExcel'])
            ->name('categories.export.excel');

        Route::get('products/export/pdf', [ProductController::class, 'exportPdf'])
            ->name('products.export.pdf');
        Route::get('products/export/excel', [ProductController::class, 'exportExcel'])
            ->name('products.export.excel');

        Route::get('borrowings/export/pdf', [BorrowingController::class, 'exportPdf'])
            ->name('borrowings.export.pdf');
        Route::get('borrowings/export/excel', [BorrowingController::class, 'exportExcel'])
            ->name('borrowings.export.excel');

        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('borrowings', BorrowingController::class);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
