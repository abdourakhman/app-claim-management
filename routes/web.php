<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;

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

Auth::routes();
//admin
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/admin/createUser', [AdminController::class, 'createUser'])->name('admin.user.create');
Route::get('/admin/deleteUser', [AdminController::class, 'deleteUser'])->name('admin.user.delete');
Route::get('/admin/deleteUser/{user}', [AdminController::class, 'removeUser'])->name('admin.user.remove');
Route::get('/admin/listUser', [AdminController::class, 'listUser'])->name('admin.user.list');
Route::get('/admin/editUser', [AdminController::class, 'editUser'])->name('admin.user.edit');
Route::get('/admin/editUser/{user}', [AdminController::class, 'editUserform'])->name('admin.user.edit.form');
Route::post('/admin/saveUser', [AdminController::class, 'saveUser'])->name('admin.user.save');
Route::post('/admin/updateUser', [AdminController::class, 'updateUser'])->name('admin.user.update');

//
Route::get('/customer/claims', [CustomerController::class, 'getDepositClaim'])->name('customer.claim.deposit');
Route::get('/customer/claims/processed', [CustomerController::class, 'getProcessedClaim'])->name('customer.claim.processed');
Route::get('/customer/newClaim', [CustomerController::class, 'createClaim'])->name('customer.claim.create');
Route::post('/customer/saveClaim', [CustomerController::class, 'saveClaim'])->name('customer.claim.save');






