<?php


use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('Dashboard/index');
})->middleware(['auth', 'verified'])->name('index');


Route::namespace('\App\Http\Controllers\Dashboard\\')->group(function (){

    Route::resource('categories',CategoriesController::class)->where(['category'=>'[0-9]+']);
    Route::group(['controller'=>CategoriesController::class,'as'=>'categories.','prefix'=>'categories'],function () {
        Route::get('trash','trash')->name('trash');
        Route::put('{category}/restore','restore')->name('restore');
        Route::delete('/{category}/kill','kill')->name('kill');
    });

    Route::resource('products',ProductsController::class)->except('show');
    Route::group(['controller'=> ProductsController::class,'as'=>'products.','prefix'=>'products'],function () {
        Route::get('trash','trash')->name('trash');
        Route::put('{product}/restore','restore')->name('restore');
        Route::delete('/{product}/kill','kill')->name('kill');
    });

});
