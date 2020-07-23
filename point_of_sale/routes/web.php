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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/device_submission','DeviceController@index')->name('device_submission');
Route::post('/device_submission','DeviceController@store');
Route::post('/device_type','DeviceController@deviceType');

Route::get('/delivered_device_submission','DeviceController@deliveredList')->name('delivered_device_submission');
Route::post('/device_deliver/{id}','DeviceController@storeDeliver');
Route::get('/mobile_deliver_device/{id}','DeviceController@deliverDevice');
Route::get('/device_submission_form','DeviceController@deviceSubmission')->name('device_submission_form');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/device/{id}', 'DeviceController@show');
Route::get('/delivered_device/{id}', 'DeviceController@showDeliveredDevice');

Route::get('/gallery/water_damage', 'GalleryController@waterDamage')->name('water_damage');
Route::get('/gallery/physical_damage', 'GalleryController@physicalDamage')->name('physical_damage');

Route::get('/invoice/{id}', 'InvoiceController@store');
Route::get('/invoices', 'InvoiceController@index')->name('invoices');
Route::get('/invoice_details/{id}', 'InvoiceController@show');

Route::get('mail/send', 'MailController@send');

Route::get('send','BulkSmsController@sendSms');
