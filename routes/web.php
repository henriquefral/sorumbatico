<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\MangaController;
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
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->get('/books',[BookController::class, 'index'])->name('books');
Route::middleware(['auth:sanctum', 'verified'])->post('/books',[BookController::class, 'store'])->name('books.store');
Route::middleware(['auth:sanctum', 'verified'])->delete('/books/{id}',[BookController::class, 'destroy'])->name('books.destroy');
Route::middleware(['auth:sanctum', 'verified'])->patch('/books/{id}',[BookController::class, 'update'])->name('books.update');


Route::middleware(['auth:sanctum', 'verified'])->get('/mangas',[MangaController::class, 'index'])->name('mangas');
Route::middleware(['auth:sanctum', 'verified'])->post('/mangas',[MangaController::class, 'store'])->name('mangas.store');
Route::middleware(['auth:sanctum', 'verified'])->delete('/mangas/{id}',[MangaController::class, 'destroy'])->name('mangas.destroy');
Route::middleware(['auth:sanctum', 'verified'])->patch('/mangas/{id}',[MangaController::class, 'update'])->name('mangas.update');