<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\EvaluatorController;
use App\Http\Controllers\AdminController;


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

// LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'auth'])->name('auth');

// GROUP
Route::get('/group/{groupId}', [GroupController::class, 'index'])->name('group');
Route::get('/groupEval/{groupId}', [GroupController::class, 'assignEvaluators'])->name('AssignEvaluators');
Route::post('/group/{projectId}', [GroupController::class, 'edit'])->name('EditProject');


// ADMIN
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::post('/admin', [AdminController::class, 'submitProject'])->name('SubmitProject');
Route::post('/adminEval', [AdminController::class, 'registerEvaluator'])->name('RegisterEvaluator');

// EVALUATOR
Route::get('/evaluatorHome/{evaluatorId}', [EvaluatorController::class, 'index'])->name('evaluator');
Route::get('/evaluator/{evaluatorId}', [EvaluatorController::class, 'assignProjects'])->name('AssignProjects');
Route::post('/evaluatorUpdate/{evaluatorId}', [EvaluatorController::class, 'updateRating'])->name('EvaluateProjects');