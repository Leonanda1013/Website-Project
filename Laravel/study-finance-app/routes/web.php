<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController; //ini import nya
use App\Http\Controllers\StudyScheduleController; //ini import nya
use App\Http\Controllers\DailyActivityController; //ini import nya
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
    return view('welcome');
});

Route::get('dashboard', [DashboardController::class, 'index']);

// Satu baris ini otomatis membuat 7 route sekaligus!
Route::resource('schedules', StudyScheduleController::class);

// CRUD biasa
Route::resource('activities', DailyActivityController::class);

// Route tambahan khusus untuk toggle status
// Tidak ada di resource default, jadi kita daftarkan manual
Route::patch('activities/{activity}/toggle', [DailyActivityController::class, 'toggle'])
     ->name('activities.toggle');
//    ↑
// PATCH = update sebagian data (bukan seluruh data seperti PUT)


