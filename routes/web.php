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

Auth::routes();

// Route::prefix('admin')
//     ->namespace('Admin')
//     ->middelware('auth')
//     ->name('admin.')
//     ->group(function() {

//         Route::get('/', 'HomeController@index')->name('home');

//     }
// );

Route::get('/', 'HomeController@index')->name('home');

Route::get('/blog', 'HomeController@blog')->name('blog');

Route::get('blog/{slug}', 'HomeController@post')->name('post');