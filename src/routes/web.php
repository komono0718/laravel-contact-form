<?php

use App\Http\Controllers\AdminController;
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

Route::get('/', [ContactController::class, 'index']);

Route::post('/confirm', [ContactController::class, 'confirm'])->name('confirm');
Route::post('/thanks', [ContactController::class, 'store'])->name('thanks');
Route::post('/back', [ContactController::class, 'back'])->name('back');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/search', [AdminController::class, 'search'])->name('admin.search');
Route::get('/reset', [AdminController::class, 'reset'])->name('admin.reset');
Route::post('/delete', [AdminController::class, 'destroy'])->name('admin.delete');

Route::get('/admin/detail/{id}', [AdminController::class, 'detail'])->name('admin.detail');

Route::get('/export', [AdminController::class, 'export'])->name('admin.export');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});
