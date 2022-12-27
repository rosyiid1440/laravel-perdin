<?php

use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return redirect('login');
});

Route::get('/login',[App\Http\Controllers\Auth\LoginController::class,'index'])->name('login');
Route::post('/login',[App\Http\Controllers\Auth\LoginController::class,'login']);
Route::get('/logout',[App\Http\Controllers\Auth\LoginController::class,'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('welcome');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth','role:1']], function(){
    Route::resource('user', App\Http\Controllers\Admin\UserController::class);
    Route::post('user/reset-password/{id}', [App\Http\Controllers\Admin\UserController::class,'reset_password']);
    Route::resource('master-kota', App\Http\Controllers\Admin\MasterKotaController::class);
});

Route::group(['prefix' => 'pegawai', 'middleware' => ['auth','role:3']], function(){
    Route::resource('pengajuan-perdin', App\Http\Controllers\Pegawai\PengajuanPerdinController::class);
});

Route::group(['prefix' => 'sdm', 'middleware' => ['auth','role:2']], function(){
    Route::resource('pengajuan-perdin', App\Http\Controllers\Sdm\PengajuanPerdinController::class);
    Route::patch('pengajuan-perdin/approve/{id}', [App\Http\Controllers\Sdm\PengajuanPerdinController::class,'approve']);
    Route::patch('pengajuan-perdin/reject/{id}', [App\Http\Controllers\Sdm\PengajuanPerdinController::class,'reject']);
});