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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'AdminController@index')->name('admin.home');

    Route::resource('book', 'BookController');
    Route::get('/book/trashed', 'BookController@trashed')->name('book.trashed');
    Route::put('/book/{id}/restore', 'BookController@restore')->name('book.restore');
    Route::post('/book/{id}/forceDelete', 'BookController@forceDelete')->name('book.forceDelete');

    Route::resource('bill', 'BillController');
    Route::get('/bill/trashed', 'BillController@trashed')->name('bill.trashed');
    Route::put('/bill/{id}/restore', 'BillController@restore')->name('bill.restore');
    Route::post('/bill/{id}/forceDelete', 'BillController@forceDelete')->name('bill.forceDelete');

    Route::resource('receipt', 'ReceiptController');
    Route::get('/receipt/trashed', 'ReceiptController@trashed')->name('receipt.trashed');
    Route::put('/receipt/{id}/restore', 'ReceiptController@restore')->name('receipt.restore');
    Route::post('/receipt/{id}/forceDelete', 'ReceiptController@forceDelete')->name('receipt.forceDelete');

    Route::resource('reportIn', 'ReportInController');
    Route::resource('reportRebt', 'ReportRebtController');

});