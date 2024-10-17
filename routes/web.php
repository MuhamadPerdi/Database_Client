<?php

use App\Exports\ClientExport;
use App\Exports\MonitoringExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\MasterdataController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\ConfigurasiController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/





Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout', function() {
    abort(404); 
}); 

Route::middleware(['auth','active'])->group(function () {
    //Client
    Route::resource('clients', ClientController::class);
    Route::get('export-excel-client', function () {
        return Excel::download(new ClientExport, 'client.xlsx');
    })->name('client.export.excel');
    Route::get('/export-csv-client', function () {
        return Excel::download(new ClientExport, 'client.csv', \Maatwebsite\Excel\Excel::CSV);
    })->name('client.export.csv');

    //Monitoring
    Route::resource('monitorings', MonitoringController::class);
    Route::get('export-excel-monitoring', function () {
        return Excel::download(new MonitoringExport, 'monitoring.xlsx');
    })->name('monitoring.export.excel');
    Route::get('/export-csv-monitoring', function () {
        return Excel::download(new MonitoringExport, 'monitoring.csv', \Maatwebsite\Excel\Excel::CSV);
    })->name('monitoring.export.csv');
  
    Route::get('jenis_c', [MasterdataController::class, 'jenis'])->name('jenis.index');
    Route::get('jenis_c/add', [MasterdataController::class, 'addjenis'])->name('jenis.create');
    Route::post('jenis_c', [MasterdataController::class, 'storejenis'])->name('jenis.store');
    Route::get('jenis_c/{id}/edit', [MasterdataController::class, 'editjenis'])->name('jenis.edit');
    Route::put('jenis_c/{id}', [MasterdataController::class, 'updatejenis'])->name('jenis.update');
    Route::delete('/jenis_c/{id}', [MasterdataController::class, 'destroyjenis'])->name('jenis.destroy');

    Route::get('status_c', [MasterdataController::class, 'status'])->name('status.index');
    Route::get('status_c/add', [MasterdataController::class, 'addstatus'])->name('status.create');
    Route::post('status_c', [MasterdataController::class, 'storestatus'])->name('status.store');
    Route::get('status_c/{id}/edit', [MasterdataController::class, 'editstatus'])->name('status.edit');
    Route::put('status_c/{id}', [MasterdataController::class, 'updatestatus'])->name('status.update');
    Route::delete('/status_c/{id}', [MasterdataController::class, 'destroystatus'])->name('status.destroy');

    Route::get('projek_m', [MasterdataController::class, 'projek'])->name('projek.index');
    Route::get('projek_m/add', [MasterdataController::class, 'addprojek'])->name('projek.create');
    Route::post('projek_m', [MasterdataController::class, 'storeprojek'])->name('projek.store');
    Route::get('projek_m/{id}/edit', [MasterdataController::class, 'editprojek'])->name('projek.edit');
    Route::put('projek_m/{id}', [MasterdataController::class, 'updateprojek'])->name('projek.update');
    Route::delete('/projek_m/{id}', [MasterdataController::class, 'destroyprojek'])->name('projek.destroy');

    Route::get('keterangan_m', [MasterdataController::class, 'keterangan'])->name('keterangan.index');
    Route::get('keterangan_m/add', [MasterdataController::class, 'addketerangan'])->name('keterangan.create');
    Route::post('keterangan_m', [MasterdataController::class, 'storeketerangan'])->name('keterangan.store');
    Route::get('keterangan_m/{id}/edit', [MasterdataController::class, 'editketerangan'])->name('keterangan.edit');
    Route::put('keterangan_m/{id}', [MasterdataController::class, 'updateketerangan'])->name('keterangan.update');
    Route::delete('/keterangan_m/{id}', [MasterdataController::class, 'destroyketerangan'])->name('keterangan.destroy');

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users', UserController::class);
    Route::patch('users/{user}/status', [UserController::class, 'updateStatus'])->name('users.updateStatus');}); Route::get('/fitur', [UserController::class, 'Fitur'])->name('fitur.index');
    Route::get('/fitur/create', [UserController::class, 'createFitur'])->name('fitur.create');
    Route::post('/fitur/store', [UserController::class, 'storeFitur'])->name('fitur.store');
    Route::get('/fitur/{roleId}/edit', [UserController::class, 'editFitur'])->name('fitur.edit');
    Route::put('/fitur/{roleId}/update', [UserController::class, 'updateFitur'])->name('fitur.update');
    Route::delete('/fitur/{roleId}', [UserController::class, 'destroyFitur'])->name('fitur.destroy');

    Route::get('/history_crud', [MasterdataController::class, 'history'])->name('history.index');

    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit')->middleware('auth');

    // Rute untuk memproses pembaruan profil
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update')->middleware('auth');

    Route::get('/configurasi', [ConfigurasiController::class, 'configurasi'])->name('configurasi');
    Route::put('/configurasi/{id}', [ConfigurasiController::class, 'configurasi_update'])->name('configurasi.update');

// Rute ini tidak memerlukan autentikasi
// Auth::routes();

