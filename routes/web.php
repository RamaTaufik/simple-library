<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/book', [BookController::class, 'index'])->name('admin.book');
Route::post('/admin/book/create', [BookController::class, 'create'])->name('admin.book-create');
Route::post('/admin/book/activate', [BookController::class, 'activate'])->name('admin.book-activate');
Route::post('/admin/book/inactivate', [BookController::class, 'inactivate'])->name('admin.book-inactivate');
Route::put('/admin/book/update/{id}', [BookController::class, 'update'])->name('admin.book-update');
Route::delete('/admin/book/delete{id}', [BookController::class, 'destroy'])->name('admin.book-delete');
