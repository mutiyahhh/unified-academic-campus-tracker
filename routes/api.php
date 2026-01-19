<?php

use App\Http\Controllers\API\AkreditasController;
use App\Http\Controllers\API\AlumniController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\MahasiswaController;
use App\Http\Controllers\API\PmbController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
 
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);

Route::middleware('jwt.auth')->group(function () {
    Route::resource('akreditas', AkreditasController::class)->names('api.akreditas');
    Route::resource('mahasiswa', MahasiswaController::class)->names('api.mahasiswa');
    Route::resource('pmb', PmbController::class)->names('api.pmb');
    Route::resource('alumni', AlumniController::class)->names('api.alumni');
    Route::resource('user', UserController::class)->names('api.user');
    Route::resource('pegawai', EmployeeController::class)->names('api.pegawai');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('api.dashboard');
});




