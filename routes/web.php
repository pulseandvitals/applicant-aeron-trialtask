<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->prefix('user-records')->name('user-records.')->group(function () {
    Route::get('/',[UserController::class,'index'])->name('index');
    Route::delete('/destroy/{record}',[UserController::class,'destroy'])->name('destroy');
    Route::get('/create',[UserController::class,'create'])->name('create');
    Route::get('/view/{record}',[UserController::class,'show'])->name('show');
    Route::get('/edit/{record}',[UserController::class,'edit'])->name('edit');
    Route::put('/update/{record}',[UserController::class,'update'])->name('update');
});

require __DIR__.'/auth.php';
