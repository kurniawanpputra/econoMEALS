<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Foods;
use App\Http\Livewire\Index;
use App\Http\Livewire\Orders;
use App\Http\Livewire\Purchases;
use App\Http\Livewire\Calories;
use App\Http\Livewire\Histories;

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
    return redirect('/all-foods');
})->name('dashboard');

Route::group(['middleware' => 'seller'], function () {
    Route::get('manage-foods', Foods::class)->name('foods');
    Route::get('manage-orders', Orders::class)->name('orders');
});

Route::get('all-foods', Index::class)->name('index');
Route::get('my-orders', Purchases::class)->name('purchases');
Route::get('calorie-counter', Calories::class)->name('calories');

Route::group(['middleware' => 'admin'], function () {
    Route::get('orders-history', Histories::class)->name('histories');
});
