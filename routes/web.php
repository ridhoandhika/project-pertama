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
     return view('welcome');
    });

Auth::routes();

// Route::post('/', 'otentikasi\OtentikasiController@login')->name('login');
//  Route::get('/', 'otentikasi\OtentikasiController@index')->name('login');
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/', 'Auth\LoginController@login')->name('login');


// // Route::group(['middleware'=> 'CekLoginMiddleware'], function(){
Route::group(['middleware'=> 'auth'], function(){
    Route::get('/dashboard', function () {
        return view('index');
    })->name('dashboard');
    
    Route::get('crud', 'CrudController@index')->name('crud');
    Route::get('crud/add', 'CrudController@add')->name('crud.add');
    Route::post('crud', 'CrudController@save')->name('crud.save');
    Route::delete('crud/{id}', 'CrudController@delete')->name('crud.delete');
    Route::get('crud/{id}/edit', 'CrudController@edit')->name('crud.edit');
    Route::patch('crud/{id}', 'CrudController@update')->name('crud.update');

    Route::resource('konfigurasi/setup','Konfigurasi\SetupController');

    Route::get('logout', 'otentikasi\OtentikasiController@logout')->name('logout');
});


// Route::get('/home', 'HomeController@index')->name('home');
