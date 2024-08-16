<?php

use App\Http\Controllers\StudentController;
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

Route::get('students', [StudentController::class, 'index']);
Route::get('student/{id}', [StudentController::class, 'show']);
Route::post('student', [StudentController::class, 'store']);
Route::put('student/{id}', [StudentController::class, 'update']);
Route::delete('student/{id}', [StudentController::class, 'destroy']);

