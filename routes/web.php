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

Auth::routes(['verify' => true]);

Route::get('/', [CopypastaController::class, 'getIndexPage'])->name('index');
Route::get('/home',  [CopypastaController::class, 'getHomePage'])->middleware(['auth', 'verified'])->name('home');
Route::get('/create', [CopypastaController::class, 'getCreatePage'])->name('create');
Route::get('/paste/{code}', [CopypastaController::class, 'getPaste'])->name('get.paste');

Route::post('/create', [CopypastaController::class, 'postCreate'])->name('post.create');