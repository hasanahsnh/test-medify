<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController as Home;
use App\Http\Controllers\MasterItemsController as MasterItem;
use App\Http\Controllers\CategoryItemController as CategoryItem;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// route master item
Route::get('/home', [Home::class, 'index'])->name('home');
Route::get('/', [Home::class, 'index'])->name('home');
Route::get('/master-items', [MasterItem::class, 'index']);
Route::get('/master-items/search', [MasterItem::class, 'search']);
Route::get('/master-items/form/{method}/{id?}', [MasterItem::class, 'formView']);
Route::post('/master-items/form/{method}/{id?}', [MasterItem::class, 'formSubmit']);

Route::get('/master-items/view/{kode}', [MasterItem::class, 'singleView']);
Route::get('/master-items/delete/{id}', [MasterItem::class, 'delete']);


Route::get('/master-items/update-random-data', [MasterItem::class, 'updateRandomData']);

// route kategori item
Route::get('/category-items', [CategoryItem::class, 'index'])->name('category');
Route::get('/category-items/form/{method}/{id?}', [CategoryItem::class, 'formView'])->name('category.form');
Route::post('/category-items/form/{method}/{id?}', [CategoryItem::class, 'formSubmit'])->name('category.items.submit');
Route::get('/category-items/search', [CategoryItem::class, 'search']);

Route::get('/category-items/view/{kode}', [CategoryItem::class, 'singleView']);

