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
    return redirect('page/1');
});

Route::get('page/{id}', function ($id) {
    return view('page', ['page_uid' => $id]);
});

Route::resource('data', 'App\Http\Controllers\DataController');
