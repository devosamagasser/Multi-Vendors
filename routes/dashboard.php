<?php


use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('Dashboard/index');
})->middleware(['auth', 'verified'])->name('index');

Route::resource('categories',App\Http\Controllers\Dashboard\CategoriesController::class);
