<?php

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

Route::get('/', function () {
    $recentList = DB::table('recentten')->get();
    return view('shortener', ['recentList'=>$recentList]);
});

Route::post('/addUrl', function(){
    die('Hello World');
});

Route::get('/help', function () {
    return view('welcome');
});
