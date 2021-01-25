<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlshortenerController;


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

Route::get('/', [UrlshortenerController::class, 'index']);
Route::post('/', [UrlshortenerController::class, 'create']);

Route::get('/help', function () {
    return view('welcome');
});
