<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TechnicienController;

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

//customer
Route::get('/customer/claims', [CustomerController::class, 'getDepositClaim'])->name('customer.claim.deposit');
Route::get('/customer/claims/processed', [CustomerController::class, 'getProcessedClaim'])->name('customer.claim.processed');
Route::get('/customer/claims/aborted', [CustomerController::class, 'getAbortedClaim'])->name('customer.claim.aborted');
Route::get('/customer/claims/aborted/{id}', [CustomerController::class, 'abortClaim'])->name('customer.claim.abort')->where('id', '[0-9]+');
Route::get('/customer/newClaim', [CustomerController::class, 'createClaim'])->name('customer.claim.create');
Route::post('/customer/saveClaim', [CustomerController::class, 'saveClaim'])->name('customer.claim.save');

//manager
Route::get('/manager/claims', [ManagerController::class, 'getClaims'])->name('manager.claim.getAll');
Route::get('/manager/claims/affected', [ManagerController::class, 'getAffectedClaims'])->name('manager.claim.affected');
Route::get('/manager/claims/pending', [ManagerController::class, 'getPendingClaims'])->name('manager.claim.pending'); //en attente
Route::get('/manager/claims/affected/{id}', [ManagerController::class, 'getFormAffectClaim'])->name('manager.claim.getFormAffect')->where('id', '[0-9]+');
Route::post('/manager/affectClaim', [ManagerController::class, 'affectClaim'])->name('manager.claim.affect');

//manager-technicien
Route::get('/manager/techniciens', [ManagerController::class, 'getListTechniciens'])->name('manager.technicien.list');
Route::get('/manager/techniciens/disponible', [ManagerController::class, 'getTechniciensDisponible'])->name('manager.technicien.disponible');
Route::get('/manager/techniciens/indisponible', [ManagerController::class, 'getTechniciensIndisponible'])->name('manager.technicien.indisponible');

//technicien
Route::get('/technicien/interventions', [TechnicienController::class, 'getInterventions'])->name('technicien.list.interventions');
Route::get('/technicien/interventions/solved', [TechnicienController::class, 'getSolvedInterventions'])->name('technicien.interventions.solved');
Route::get('/technicien/interventions/pending', [TechnicienController::class, 'getPendingInterventions'])->name('technicien.interventions.pending');
Route::get('/technicien/solveClaim/{id}', [TechnicienController::class, 'solveClaim'])->name('technicien.claim.solve')->where('id', '[0-9]+');








