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
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', function () {
        return view('login');
    });
});

Route::get('login', 'AuthController@getLogin')->name('login');
Route::post('login', 'AuthController@postLogin')->name('postLogin');
Route::get('logout', [
    'uses'  => 'AuthController@getLogout',
    'as'    => 'logout',
]);

Route::get('/', 'KtpController@index')->name('ktp.index');
Route::get('/create', 'KtpController@create')->name('ktp.create');
Route::post('/', 'KtpController@store')->name('ktp.store');
Route::get('/edit/{nik}', 'KtpController@edit')->name('ktp.edit');
Route::get('/{nik}', 'KtpController@show')->name('ktp.show');
Route::put('/update/{nik}', 'KtpController@update')->name('ktp.update');
Route::delete('/hapus/{nik}', 'KtpController@destroy')->name('ktp.destroy');
