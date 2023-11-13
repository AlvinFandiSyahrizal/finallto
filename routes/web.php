<?php

use Illuminate\Support\Facades\Route;


Route::resource('/line0s', \App\Http\Controllers\Line0Controller::class);
Route::resource('/line2s', \App\Http\Controllers\Line2Controller::class);
Route::resource('/line3s', \App\Http\Controllers\Line3Controller::class);
Route::resource('/line4s', \App\Http\Controllers\Line4Controller::class);

use App\Http\Controllers\JadwalLineController;

Route::resource('/jadwalline', JadwalLineController::class);
Route::post('/simpanJadwalLine', [JadwalLineController::class, 'simpanJadwalLine'])->name('simpanJadwalLine');



Route::resource('jadwalline2', \App\Http\Controllers\JadwalLine2Controller::class);


Route::resource('/jadwalline3', \App\Http\Controllers\JadwalLine3Controller::class);
Route::resource('/jadwalline4', \App\Http\Controllers\JadwalLine4Controller::class);
Route::resource('/inputs', \App\Http\Controllers\InputController::class);

Route::resource('schedule', \App\Http\Controllers\ScheduleController::class);
Route::resource('tanggal', \App\Http\Controllers\TanggalController::class);

Route::resource('test', \App\Http\Controllers\TestController::class);

