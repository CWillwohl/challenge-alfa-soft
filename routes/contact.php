<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->prefix('/contact')->as('contacts.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::get('/create', [ContactController::class, 'create'])->name('create');
    Route::get('/edit/{contact}', [ContactController::class, 'edit'])->name('edit');
    Route::get('/show/{contact}', [ContactController::class, 'show'])->name('show');

    Route::post('/store', [ContactController::class, 'store'])->name('store');
    Route::put('/update/{contact}', [ContactController::class, 'update'])->name('update');
    Route::delete('/destroy/{contact}', [ContactController::class, 'destroy'])->name('destroy');

});
