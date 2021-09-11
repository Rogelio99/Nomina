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
use App\Http\Controllers\EmployeeController;

Route::get('/', [EmployeeController::class, 'index'])->name('index');
Route::match(['get', 'post'], 'form', [EmployeeController::class, 'form'])->name('Employeer.form');
Route::get('change_status', [EmployeeController::class, 'change_status'])->name('Employeer.change_status');
Route::post('save/{id}', [EmployeeController::class, 'save'])->name('Employeer.save');
Route::get('detail', [EmployeeController::class, 'show'])->name('Employeer.detail');
