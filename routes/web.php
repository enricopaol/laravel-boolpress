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

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {

        Route::get('/', 'HomeController@index')->name('home');

        Route::resource('posts', 'PostController');
        
    }
);

// Route Pubbliche
Route::get('/', 'HomeController@index')->name('home');

Route::get('/blog', 'PostController@index')->name('index');
Route::get('blog/{slug}', 'PostController@show')->name('show');

Route::get('/categories', 'CategoryController@index')->name('categories.index');
Route::get('/categories/{slug}', 'CategoryController@show')->name('categories.show');

Route::get('/tags/{slug}', 'TagController@show')->name('tags.show');

Route::get('/vue-posts', 'Postcontroller@vuePosts')->name('vue.posts');
