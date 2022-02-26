<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[AuthorController::class,'index'])->name('index');
Route::post('/delete-book',[AuthorController::class,'deletebook'])->name('delete-book');
Route::post('/add-book',[AuthorController::class,'addbook'])->name('add-book');
Route::get('/get-book-details',[AuthorController::class,'getbookdetails'])->name('get-book-details');
Route::post('/update-book',[AuthorController::class,'updatebook'])->name('update-book');
Route::post('/search-book',[AuthorController::class,'searchbook'])->name('search-book');
Route::get('/all-book',[AuthorController::class,'allbook'])->name('all-book');
