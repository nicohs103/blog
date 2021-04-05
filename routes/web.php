<?php

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

Route::resource('/', 'WelcomeController');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', function () {
        return redirect('admin/post');
    })->name('home');

    Route::get('admin/post/getPostsDatatable', 'PostController@getPostsDatatable')->name('admin.post.getPostsDatatable');
    Route::resource('admin/post', 'PostController');
});

Auth::routes();
