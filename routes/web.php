<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboardcontroller;
use App\Http\Controllers\Siswacontroller;
use App\Http\Controllers\Projectcontroller;
use App\Http\Controllers\Kontakcontroller;
use App\Http\Controllers\LoginController;


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




// admin

Route::middleware('guest')->group(function(){

Route::get('login',[LoginController::class, 'index'])->name('login');
Route::post('login',[LoginController::class, 'authenticate']);
Route::get('/home', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/projects', function () {
    return view('projects');
});

});






Route::middleware('auth')->group(function(){

Route::resource('dashboard', Dashboardcontroller::class);
Route::get('MasterSiswa/{id_siswa}/hapus', [Siswacontroller::class, 'hapus'])->name('MasterSiswa.hapus');
Route::resource('MasterSiswa', Siswacontroller::class);
 Route::get('MasterKontak/create/{id_siswa}', [Kontakcontroller::class, 'tambah'])->name('MasterKontak.tambah');
    Route::get('MasterKontak/{id_siswa}/hapus', [Kontakcontroller::class, 'hapus'])->name('MasterKontak.hapus');
    Route::resource('MasterKontak', Kontakcontroller::class);
Route::resource('MasterKontak',Kontakcontroller::class);
Route::get('MasterProject/create/{id_siswa}', [Projectcontroller::class, 'tambah'])->name('MasterProject.tambah');
Route::get('MasterProject/{id_siswa}/hapus', [Projectcontroller::class, 'hapus'])->name('MasterProject.hapus');
    Route::post('MasterKontak/storejenis', [Kontakcontroller::class, 'storejenis'])->name('MasterKontak.storejenis');
    Route::put('MasterKontak/updatejenis/{id_jenis_contact}', [Kontakcontroller::class, 'updatejenis'])->name('MasterKontak.updatejenis');
    Route::get('MasterKontak/editjenis/{id_jenis_contact}', [Kontakcontroller::class, 'editjenis'])->name('MasterKontak.editjenis');
    Route::get('MasterKontak/{id_jenis_contact}/hapusjenis', [Kontakcontroller::class, 'hapusjenis'])->name('MasterKontak.hapusjenis');
Route::resource('MasterProject',Projectcontroller::class);
Route::post('logout',[LoginController::class, 'logout']);

});
