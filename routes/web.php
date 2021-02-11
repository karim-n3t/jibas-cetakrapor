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
Route::get('Raport/Sementara/{kelas}/', 'Raport@cetakrapor')->name('Cetak Rapor Sementara');
Route::get('Raport/Remidi/{kelas}', 'Raport@tampilremidi')->name('Daftar Siswa Remidi');
Route::get('Raport/Cover/{kelas}', 'Raport@cetakcover')->name('Cetak Cover Rapor');
Route::get('Raport/{kelas}/{nis}', 'Raport@tampilrapor')->name('Cetak Raport');
Route::get('Raport/{kelas}', 'Raport@listsiswa')->name('Daftar Siswa Raport');
Route::get('Raport', 'Raport@daftarkelas')->name('Daftar Kelas Raport');
Route::get('PresensiRekap', 'Presensi@rekap')->name('PresensiRekap');
Route::post('PresensiRekap', 'Presensi@rekap');
Route::get('PresensiHarian', 'Presensi@harian')->name('PresensiHarian');
Route::post('PresensiHarian', 'Presensi@harian');
Route::get('PresensiPersonal', 'Presensi@personal')->name('PresensiPersonal');
Route::post('PresensiPersonal', 'Presensi@personal');
Route::post('PresensiPerorangan', 'Presensi@perorangan')->name('PresensiPeroranganPost');
Route::get('PresensiPerorangan', 'Presensi@perorangan')->name('PresensiPerorangan');
Route::get('PresensiPerorangan/{nip?}/{tahun?}-{bulan?}', 'Presensi@perorangan');
Route::get('PresensiPengaturan', 'Presensi@pengaturan')->name('PresensiPengaturan');
Route::post('PresensiLangsung', 'Presensi@langsung');
Route::get('PresensiLangsung', 'Presensi@langsung');
Route::get('PresensiLangsung/{nip?}/{tahun?}-{bulan?}', 'Presensi@langsung');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
