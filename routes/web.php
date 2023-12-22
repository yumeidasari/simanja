<?php

//use Illuminate\Support\Facades\Route;

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
//Route::get('/form-aset', function () {
//    return view('form-aset');
//})->name('form-aset');

Route::get('/form-aset',[App\Http\Controllers\AsetUmumController::class, 'formAset'])->name('form-aset');
Route::post('/form-aset',[App\Http\Controllers\AsetUmumController::class, 'store'])->name('simpanAsetUmum');

Auth::routes();

//Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
	
	
});


Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	//Route::resource('user', App\Http\Controllers\UserController::class)->name('*', 'user');
	Route::delete('/user/{id}', 'UserController@destroy');
	
	Route::get('/opd/export', 'App\Http\Controllers\OpdController@processExport')->name('opd.export');
	Route::get('/opd/import', 'App\Http\Controllers\OpdController@import');
	Route::post('/opd/import', 'App\Http\Controllers\OpdController@processImport')->name('opd.import');
	Route::resource('opd', 'App\Http\Controllers\OpdController', ['except' => ['show']]);
	
	Route::resource('tes-wifi', 'App\Http\Controllers\TesWifiController', ['except' => ['show']]);
	//-------------
	Route::get('/aplikasi/export', 'App\Http\Controllers\AplikasiController@processExport')->name('aplikasi.export');
	Route::post('/aplikasi/import', 'App\Http\Controllers\AplikasiController@processImport')->name('aplikasi.import');
	//Route::get('/aplikasi', 'App\Http\Controllers\AplikasiController@index')->name('aplikasi.index');
	//Route::post('/aplikasi', 'App\Http\Controllers\AplikasiController@store');
	//Route::put('/aplikasi/{id}/edit', 'App\Http\Controllers\AplikasiController@update');
	//Route::delete('/aplikasi/{id}', 'App\Http\Controllers\AplikasiController@destroy');
	Route::resource('aplikasi', 'App\Http\Controllers\AplikasiController', ['except' => ['show']]);
	
	Route::get('/alat/export', 'App\Http\Controllers\AlatController@processExport')->name('alat.export');
	Route::post('/alat/import', 'App\Http\Controllers\AlatController@processImport')->name('alat.import');
	Route::any('/alat/detail2/{id}', [App\Http\Controllers\AlatController::class, 'detailAlat'])->name('detailAlat');
	Route::any('/alat/detail/updt/{id}', [App\Http\Controllers\AlatController::class, 'updateDetail'])->name('updateDetail');
	Route::any('/alat/detail/del/{id}', [App\Http\Controllers\AlatController::class, 'hapusDetail'])->name('hapusDetail');
	Route::get('/alat/detail/export',[App\Http\Controllers\AlatController::class, 'exportDetail'])->name('exportDetail');
	Route::post('/alat/detail/simpan',[App\Http\Controllers\AlatController::class,'storeDetail'])->name('simpanDetailAlat');
	Route::resource('alat', 'App\Http\Controllers\AlatController', ['except' => ['show']]);
	
	Route::get('/jaringan-opd/export', 'App\Http\Controllers\JaringanOpdController@processExport')->name('jaringan-opd.export');
	Route::post('/jaringan-opd/import', 'App\Http\Controllers\JaringanOpdController@processImport')->name('jaringan-opd.import');
	Route::resource('jaringan-opd', 'App\Http\Controllers\JaringanOpdController', ['except' => ['show']]);
	
	Route::get('/perangkat-jaringan-tes/{id}/destroy', 'App\Http\Controllers\TesPerangkatJaringanController@destroy');
	Route::resource('perangkat-jaringan-tes', 'App\Http\Controllers\TesPerangkatJaringanController', ['except' => ['show']]);
	//-----------
	Route::get('/wireless/export', 'App\Http\Controllers\WirelessController@processExport')->name('wireless.export');
	Route::get('/wireless/import', 'App\Http\Controllers\WirelessController@import');
	Route::post('/wireless/import', 'App\Http\Controllers\WirelessController@processImport')->name('wireless.import');
	Route::resource('wireless', 'App\Http\Controllers\WirelessController', ['except' => ['show']]);
	
	//-------------
	Route::get('/vm/export', 'App\Http\Controllers\VmController@processExport')->name('vm.export');
	Route::post('/vm/import', 'App\Http\Controllers\VmController@processImport')->name('vm.import');
	Route::resource('vm', 'App\Http\Controllers\VmController', ['except' => ['show']]);
	
	Route::any('/aset-umum/detail/{id}', [App\Http\Controllers\AsetUmumController::class, 'detailAsetUmum'])->name('detailAsetUmum');
	Route::any('/aset-umum/update/{id}', [App\Http\Controllers\AsetUmumController::class, 'updateAsetUmum'])->name('updateAsetUmum');
	Route::resource('aset-umum', 'App\Http\Controllers\AsetUmumController', ['except' => ['show']]);
	
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

