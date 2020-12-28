<?php

use App\Http\Controllers\listaController;
use App\Http\Controllers\produtoController;
use App\Http\Controllers\itemController;
use Illuminate\Support\Facades\Route;


Route::get('/lista/create', [listaController::class, 'create']);
Route::get('/lista/update/{lista}', [listaController::class, 'update']);
Route::get('/lista/delete/{lista}', [listaController::class, 'destroy']);
Route::get('/', [listaController::class, 'index'])->name('lista_index');

Route::get('/produtos',[produtoController::class, 'index'])->name('produto_index');
Route::get('/produtos/create',[produtoController::class, 'create']);
Route::get('/produtos/update/{produto}',[produtoController::class, 'update']);
Route::get('/produtos/delete/{produto}',[produtoController::class, 'destroy']);
Route::get('/produtos/periodo',[produtoController::class, 'listByPeriod']);


Route::get('/items/delete/{lista}/{produto}',[itemController::class, 'destroy']);







