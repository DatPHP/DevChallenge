<?php

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

use App\Http\Controllers\UserController;

Route::get('user/create', 'App\Http\Controllers\UserController@showRegisterForm')->name('user.create');
Route::post('user/create', 'App\Http\Controllers\UserController@storeUser');
Route::get('user/list', 'App\Http\Controllers\UserController@getlist')->name('user.list');
Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');  // declare new style of route 
Route::get('user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');  // declare new style of route 
