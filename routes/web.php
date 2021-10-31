<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\MasterDataGuruController; //LOAD CONTROLLER GURU
use App\Http\Controllers\MasterDataSiswaController; //LOAD CONTROLLER SISWA
use App\Http\Controllers\MasterDataKelasController; //LOAD CONTROLLER KELAS

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//GROUPING DENGAN MENGGUNAKAN MIDDLEWARE
Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    //ROUTING UNTUK HALAMAN DASHBOARD
    Route::get('/dashboard', function() {
        return Inertia::render('Dashboard');
    })->name('dashboard');
  
    //RESTFUL ROUTING UNTUK HALAMAN GURU
    Route::resource('masterdata-guru', MasterDataGuruController::class);
    //RESTFUL ROUTING UNTUK HALAMAN SISWA
    Route::resource('masterdata-siswa', MasterDataSiswaController::class);
    //RESTFUL ROUTING UNTUK HALAMAN KELAS
    Route::resource('masterdata-kelas', MasterDataKelasController::class);
});