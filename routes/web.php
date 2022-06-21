<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
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

Route::get('/', [MainController::class, 'default'])->name('main')->middleware('admin');

Route::get('/auth', [LoginController::class, 'index'])->name('auth');
Route::post('/auth', [LoginController::class, 'store'])->name('auth.store');


// Auth::routes();
Route::get('/category', [App\Http\Controllers\categorycontroller::class, 'index'])->name('categoryIndex');
Route::get('/category/create', [App\Http\Controllers\categorycontroller::class, 'create'])->name('categoryCreate');
Route::post('/category/store', [App\Http\Controllers\categorycontroller::class, 'store'])->name('categoryStore');

Route::get('/tactic', [App\Http\Controllers\tactic::class, 'index'])->name('tacticIndex');
Route::get('/tactic/create', [App\Http\Controllers\tactic::class, 'create'])->name('tacticCreate');
Route::post('/tactic/store', [App\Http\Controllers\tactic::class, 'store'])->name('tacticStore');


Route::get('/project', [App\Http\Controllers\meropriyatia::class, 'index'])->name('projectIndex');
Route::get('/project/create', [App\Http\Controllers\meropriyatia::class, 'create'])->name('projectCreate');
Route::post('/project/store', [App\Http\Controllers\meropriyatia::class, 'store'])->name('projectStore');

Route::get('/member', [App\Http\Controllers\x4::class, 'index'])->name('memberIndex');
Route::get('/member/create', [App\Http\Controllers\x4::class, 'create'])->name('memberCreate');
Route::post('/member/store', [App\Http\Controllers\x4::class, 'store'])->name('memberStore');

Route::get('/strategy', [App\Http\Controllers\strategy::class, 'index'])->name('strategyIndex');
Route::get('/strategy/create', [App\Http\Controllers\strategy::class, 'create'])->name('strategyCreate');
Route::post('/strategy/store', [App\Http\Controllers\strategy::class, 'store'])->name('strategyStore');

Route::resource('category', 'App\Http\Controllers\categorycontroller');
Route::resource('PhotoController', 'App\Http\Controllers\PhotoController');
Route::resource('MailController', 'App\Http\Controllers\MailController');
Route::resource('viewpanel', 'App\Http\Controllers\viewpanel');
// Route::resource('tactic', 'App\Http\Controllers\tactic');
// Route::resource('strategy', 'App\Http\Controllers\strategy');
Route::resource('meropriyatia', 'App\Http\Controllers\meropriyatia');

Route::resource('x1', 'App\Http\Controllers\x1');
Route::resource('x2', 'App\Http\Controllers\x2');
Route::resource('x3', 'App\Http\Controllers\x3');
Route::resource('x4', 'App\Http\Controllers\x4');
Route::resource('x5', 'App\Http\Controllers\x5');

Route::get('MainController', [App\Http\Controllers\MainController::class, 'default'])->name('home');

Route::get('/item/{id}', [App\Http\Controllers\MainController::class, 'getPage'])->name('page');

Route::post('/add', [App\Http\Controllers\MainController::class, 'addNote']);

Route::post('/list', [App\Http\Controllers\MainController::class, 'getList']);

Route::post('/update-matrix', [App\Http\Controllers\MainController::class, 'updateMatrix']);
