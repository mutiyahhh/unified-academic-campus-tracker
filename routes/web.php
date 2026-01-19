<?php

use App\Http\Controllers\AkreditasController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PmbController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('akreditas', AkreditasController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('pmb', PmbController::class);
    Route::resource('alumni', AlumniController::class);
    Route::resource('user', UserController::class);
    Route::resource('pegawai', EmployeeController::class);
});

// API untuk FrontEnd Web
Route::get('/api/web/akreditas', [AkreditasController::class, 'data'])->name('api.akreditas.index');
Route::get('/api/web/mahasiswa', [MahasiswaController::class, 'data'])->name('api.mahasiswa.index');
Route::get('/api/web/pmb', [PmbController::class, 'data'])->name('api.pmb.index');
Route::get('/api/web/alumni', [AlumniController::class, 'data'])->name('api.alumni.index');
Route::get('/api/web/user', [UserController::class, 'data'])->name('api.user.index');
Route::get('/api/web/pegawai', [EmployeeController::class, 'data'])->name('api.pegawai.index');

require __DIR__ . '/auth.php';
