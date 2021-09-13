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
use App\Http\Controllers\TypeOfContractController;

Route::prefix('employee')->group(function () {
    Route::get('/', [EmployeeController::class, 'findEmployees'])->name('Employee.FindEmployees');
    Route::put('/change_status', [EmployeeController::class, 'changeStatus'])->name('Employee.change_status');
    Route::delete('/delete', [EmployeeController::class, 'delete'])->name('Employee.delete');
    Route::post('/save', [EmployeeController::class, 'save'])->name('Employee.save');
});

Route::prefix('type_of_contract')->group(function () {
    Route::get('/', [TypeOfContractController::class, 'findTypeOfContracts']);
});

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
