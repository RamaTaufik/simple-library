<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/book', [BookController::class, 'index'])->name('admin.book');
Route::get('/admin/book-inactive', [BookController::class, 'inactiveBooks'])->name('admin.book-inactive');
Route::post('/admin/book/create', [BookController::class, 'create'])->name('admin.book-create');
Route::get('/admin/book/activate/{id}', [BookController::class, 'activate'])->name('admin.book-activate');
Route::get('/admin/book/inactivate/{id}', [BookController::class, 'inactivate'])->name('admin.book-inactivate');
Route::put('/admin/book/update', [BookController::class, 'update'])->name('admin.book-update');
Route::delete('/admin/book/delete/{id}', [BookController::class, 'destroy'])->name('admin.book-delete');
Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category');
Route::post('/admin/category/create', [CategoryController::class, 'create'])->name('admin.category-create');
Route::put('/admin/category/update', [CategoryController::class, 'update'])->name('admin.category-update');
Route::delete('/admin/category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category-delete');
