<?php

use App\Http\Controllers\LoginController;
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

Route::controller(LoginController::class)->group(function() {
    Route::get('/', 'index')->name('data');
    Route::get('/data', 'data')->name('url_data');
    Route::get('/filter/{params}', 'filter')->name('filter');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/', 'login');
    Route::get('/register', 'registerView');
    Route::post('/register', 'store');
});
