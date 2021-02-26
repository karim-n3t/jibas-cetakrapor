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
    Route::get('Rekap', 'Presensi@rekap')->name('PresensiRekap');
    Route::post('Rekap', 'Presensi@rekap');
    Route::get('Harian', 'Presensi@harian')->name('PresensiHarian');
    Route::post('Harian', 'Presensi@harian');
    Route::get('Personal', 'Presensi@personal')->name('PresensiPersonal');
    Route::post('Personal', 'Presensi@personal');
    Route::post('Perorangan', 'Presensi@perorangan')->name('PresensiPeroranganPost');
    Route::get('Perorangan', 'Presensi@perorangan')->name('PresensiPerorangan');
    Route::get('Perorangan/{nip?}/{tahun?}-{bulan?}', 'Presensi@perorangan');
    Route::get('Pengaturan', 'Presensi@pengaturan')->name('PresensiPengaturan');
    Route::post('Langsung', 'Presensi@langsung');
    Route::get('Langsung', 'Presensi@langsung');
    Route::get('Langsung/{nip?}/{tahun?}-{bulan?}', 'Presensi@langsung');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
