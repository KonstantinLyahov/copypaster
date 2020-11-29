<?php

use App\Http\Controllers\CopypastaController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [CopypastaController::class, 'getIndexPage'])->name('index');
Route::get('/home',  [CopypastaController::class, 'getHomePage'])->middleware(['auth'])->name('home');
Route::get('/create', [CopypastaController::class, 'getCreatePage'])->name('create');
Route::get('/mypastes', [CopypastaController::class, 'getUserPastes'])->middleware(['auth'])->name('user.pastes');
Route::get('/changepaste/{code}', [CopypastaController::class, 'getPasteChange'])->middleware(['auth'])->name('paste.change');
Route::get('/paste/{code}', [CopypastaController::class, 'getPasteRedirect'])->name('get.paste');
Route::get('/deletepaste/{code}', [CopypastaController::class, 'deletePaste'])->middleware(['auth'])->name('paste.delete');
Route::get('/trash', [CopypastaController::class, 'getTrash'])->middleware(['auth'])->name('trash');
Route::get('/forcedelete/{code}', [CopypastaController::class, 'forceDelete'])->middleware(['auth'])->name('force-delete');
Route::get('/restore/{code}', [CopypastaController::class, 'restore'])->middleware(['auth'])->name('restore');

Route::post('/paste/{code}', [CopypastaController::class, 'getPaste'])->name('post.paste');
Route::post('/changepaste/{code}', [CopypastaController::class, 'postPasteChange'])->middleware(['auth'])->name('post.paste.change');
Route::post('/create', [CopypastaController::class, 'postCreate'])->name('post.create');