<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetStoreController;



Route::get('/', [PetStoreController::class, 'index'])->name('pet.index');
Route::get('/pet/showAll', [PetStoreController::class, 'getAllByStatus'])->name('pet.show.all');
Route::get('/pet/create', [PetStoreController::class, 'create'])->name('pet.create');
Route::get('/pet/edit/{id}', [PetStoreController::class, 'edit'])->name('pet.edit');

Route::put('/pet/{id}', [PetStoreController::class, 'update'])->name('pet.update');
Route::delete('/pet/{id}', [PetStoreController::class, 'destroy'])->name('pet.destroy');
Route::post('/pet', [PetStoreController::class, 'store'])->name('pet.store');

