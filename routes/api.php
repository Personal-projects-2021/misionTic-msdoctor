<?php

use App\Http\Controllers\Admin\DoctorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/doctors', [DoctorController::class, 'index'])->name('admin.doctors.index');

// Route::get('/doctors/{user}', [DoctorController::class, 'show'])->name('admin.doctors.show');

// Route::post('/doctors', [DoctorController::class, 'store'])->name('admin.doctors.store');

// Route::put('/doctors/{user}', [DoctorController::class, 'update'])->name('admin.doctors.update');

// Route::delete('/doctors/{user}', [DoctorController::class, 'destroy'])->name('admin.doctors.destroy');

Route::resource('/doctors', DoctorController::class)->names('admin.doctors')->only(['index', 'show', 'store', 'update', 'destroy']);