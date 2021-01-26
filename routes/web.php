<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\indexPageController;
use App\Http\Controllers\UrlshortenerController;
use App\Http\Controllers\urlFollowerController;


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

/**
 * Used custom controllers to render the output as needed
 */
Route::get('/', [indexPageController::class, 'index']);//return main page
Route::post('/', [UrlshortenerController::class, 'create']);//create the new url

//Custom url follower
Route::get('{endpoint}',[urlFollowerController::class, 'redirect']);
