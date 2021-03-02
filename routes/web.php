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
    return view('dashboard');
})->name('dashboard');
Route::get('RaportDraft', function () {
    return view('RaportDraft');
})->name('RaportDraft');
Route::prefix('Raport')->group(function () {
    Route::get('Sementara/{kelas}/', 'Raport@cetakrapor')->name('Cetak Rapor Sementara');
    Route::get('Remidi/{kelas}', 'Raport@tampilremidi')->name('Daftar Siswa Remidi');
    Route::get('Cover/{kelas}', 'Raport@cetakcover')->name('Cetak Cover Rapor');
    Route::get('{kelas}/{nis}', 'Raport@tampilrapor')->name('Cetak Raport');
    Route::get('{kelas}', 'Raport@listsiswa')->name('Daftar Siswa Raport');
    Route::get('', 'Raport@daftarkelas')->name('Daftar Kelas Raport');
});
Route::prefix('Presensi')->group(function () {
    Route::match(['get','post'], 'Rekap', 'Presensi@rekap')->name('PresensiRekap');
    Route::match(['get','post'], 'Harian', 'Presensi@harian')->name('PresensiHarian');
    Route::match(['get','post'], 'Personal', 'Presensi@personal')->name('PresensiPersonal');
    Route::match(['get', 'post'], 'Perorangan', 'Presensi@perorangan')->name('PresensiPerorangan');
    Route::get('Perorangan/{nip?}/{tahun?}-{bulan?}', 'Presensi@perorangan');
    Route::get('Pengaturan', 'Presensi@pengaturan')->name('PresensiPengaturan');
    Route::post('Langsung', 'Presensi@langsung');
    Route::get('Langsung', 'Presensi@langsung');
    Route::get('Langsung/{nip?}/{tahun?}-{bulan?}', 'Presensi@langsung');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

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
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

