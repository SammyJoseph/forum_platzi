<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ThreadsController;
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

// Route::get('/', App\Http\Livewire\ShowThreads::class)->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/', [ThreadsController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/thread/{thread}', App\Http\Livewire\ShowThread::class)->middleware(['auth', 'verified'])->name('thread');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('threads', ThreadController::class)->except(['index', 'show', 'destroy']); // trabajar con todas las rutas menos las indicadas
});

require __DIR__.'/auth.php';
