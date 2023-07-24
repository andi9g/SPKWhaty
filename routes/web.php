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


Route::get('/', 'indexC@root');

//halaman user
Route::get('/welcome', 'indexC@index');
Route::get('/proses_kembali', 'indexC@indexkembali')->name('back.welcome');
Route::post('/welcome', 'indexC@cari')->name('cari.data');
// Route::post('/welcome', 'indexC@cari2')->name('cari.data');
Route::get('/cetak/laporan', 'indexC@cetak')->name('cetak.laporan');


Route::get('login', 'loginC@index');
Route::get('logout', 'loginC@logout');
Route::post('login', 'loginC@proses')->name('proses.login');
Route::get('daftar', 'loginC@daftar');
Route::post('daftar', 'loginC@prosesdaftar')->name('proses.daftar');

Route::get('reset', 'loginC@reset');
Route::post('reset', 'loginC@datareset')->name('reset.data');
Route::post('reset/password/{id}', 'loginC@resetpassword')->name('reset.password');
// Route::post('reset//', 'loginC@daftar');



Route::middleware(['GerbangAdmin'])->group(function () {
    //home
    Route::get('home', 'homeC@index');

    Route::resource('satuan', 'satuanC');

    //kriteria
    Route::get('kriteria', 'konfigurasiC@kriteria');
    Route::post('kriteria/tambah', 'konfigurasiC@tambahkriteria')->name('tambah.kriteria');
    Route::put('kriteria/ubah/{idkriteria}', 'konfigurasiC@ubahkriteria')->name('ubah.kriteria');
    Route::DELETE('kriteria/hapus/{idkriteria}', 'konfigurasiC@hapuskriteria')->name('hapus.kriteria');

    //nilai
    Route::get('nilai', 'konfigurasiC@nilai');
    Route::post('nilai/tambah/{idkriteria}', 'konfigurasiC@tambahnilai')->name('tambah.nilai');
    Route::delete('nilai/hapus/{idnilai}', 'konfigurasiC@hapusnilai')->name('hapus.nilai');
    Route::post('nilai/ubah/{idnilai}', 'konfigurasiC@ubahnilai')->name('ubah.nilai');

    //toko
    Route::get('toko', 'instansiC@index');
    Route::post('toko', 'instansiC@store')->name('tambah.toko');
    Route::put('toko/{idlaptop}/ubah', 'instansiC@update')->name('ubah.toko');
    Route::delete('toko/{idlaptop}/hapus', 'instansiC@destroy')->name('hapus.toko');

    Route::get('toko/{idlaptop}/laptop', 'instansiC@laptop')->name('lihat.laptop');
    Route::post('toko/{idlaptop}/laptop/tambah', 'instansiC@tambahlaptop')->name('tambah.laptop');
    Route::put('toko/{idlaptop}/ubah/laptop', 'instansiC@ubahlaptop')->name('ubah.laptop');
    Route::delete('toko/{idlaptop}/hapus/laptop', 'instansiC@hapuslaptop')->name('hapus.laptop');

    //admin
    Route::resource('admin', 'aksesC');

    //pengunjung
    Route::get('pengunjung', 'aksesC@pengunjung');
    Route::DELETE('pengunjung/hapus/{id}', 'aksesC@hapuspengunjung')->name('hapus.pengunjung');

});
