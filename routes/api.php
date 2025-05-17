<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//importar controladores
use App\Http\Controllers\paraleloController;
use App\Http\Controllers\estudianteController;

//Paralelo
route::get('/paralelos',[paraleloController::class ,'index']);
route::post('/paralelos',[paraleloController::class ,'store']);
route::get('/paralelos/{id}',[paraleloController::class ,'show']);
route::put('/paralelos/{id}',[paraleloController::class ,'update']);
route::delete('/paralelos/{id}',[paraleloController::class ,'destroy']);

//Estudiante
route::get('/estudiantes',[estudianteController::class ,'index']);
route::post('/estudiantes',[estudianteController::class ,'store']);
route::get('/estudiantes/{id}',[estudianteController::class ,'show']);
route::put('/estudiantes/{id}',[estudianteController::class ,'update']);
route::delete('/estudiantes/{id}',[estudianteController::class ,'destroy']);
Route::apiResource('estudiantes', EstudianteController::class);

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */




