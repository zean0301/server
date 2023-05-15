<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessageBoardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [MessageBoardController::class, 'getData'])->name('index');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/updateData', [MessageBoardController::class, 'updateData'])->name('update');
    Route::post('/deleteData', [MessageBoardController::class, 'deleteData'])->name('delete');
    Route::post('/sendMessage', [MessageBoardController::class, 'insertData']);
});

require __DIR__.'/auth.php';
