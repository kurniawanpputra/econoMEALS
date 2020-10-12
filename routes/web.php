<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Foods;
use App\Http\Livewire\Index;
use App\Http\Livewire\Orders;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect('/index');
})->name('dashboard');

Route::group(['middleware' => 'seller'], function () {
    Route::get('foods', Foods::class)->name('foods');
    Route::get('orders', Orders::class)->name('orders');
});

Route::get('index', Index::class)->name('index');
