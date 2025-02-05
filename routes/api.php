<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MoleculeController;
use App\Http\Controllers\DraftProductController;

Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/me', [UserController::class, 'me']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/categories', [CategoryController::class, 'createCategory'])->name('createCategory');
    Route::get('/categories', [CategoryController::class, 'getAllCategory'])->name('getAllCategory');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/molecules', [MoleculeController::class, 'createMolecule'])->name('createMolecule');
    Route::put('/molecules/{id}', [MoleculeController::class, 'updateMolecule'])->name('updateMolecule');
    Route::delete('/molecules/{id}', [MoleculeController::class, 'deleteMolecule'])->name('deleteMolecule');
    Route::get('/molecules', [MoleculeController::class, 'getAllMolecules'])->name('getAllMolecules');
});


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/draftproducts', [DraftProductController::class, 'store']);  // Create DraftProduct
    Route::put('/draftproducts/{id}', [DraftProductController::class, 'update']);  // Update DraftProduct
});

