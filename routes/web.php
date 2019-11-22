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

// Route::get('/', function () {
//     return view('welcome');
// });
// check api json
Route::get('/', 'GetCompanyAPI@getAPI');
Route::post('/', 'GetCompanyAPI@getAPI');
Route::post('/check', 'GetCompanyAPI@checkExit');
// export pdf
Route::get('/exportpdf','importExportController@exportpdf');
//import excel
Route::post('/importExcel','importExportController@importExcel');
// export excel
Route::post('/exportExcel','importExportController@exportExcel');
// view import , export excel
Route::get('/viewImportExportExcel','importExportController@viewImportExportExcel');
// add more row
Route::get('json','moreRowController@index');
Route::post('store-json','moreRowController@store')->name('store-json');
// scan qr code
Route::get('/qrcode', 'GetCompanyAPI@qrcode');
Route::post('/getqrcode', 'GetCompanyAPI@getqrcode');
// momo
Route::get('/viewcheckout', 'integrateController@viewcheckout');
Route::get('/getPaymentMethods', 'integrateController@getPaymentMethods');
Route::get('/getMomoDataApi', 'integrateController@getMomoDataApi');
//upload images
Route::get('/viewImage', 'imageController@viewImage');
Route::post('/uploadOneImage', 'imageController@uploadOneImage');
Route::post('/uploadMultiImage', 'imageController@uploadMultiImage');
