<?php

use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerificaAdm;
use App\Http\Middleware\Localization;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\GraficoController;



Route::get('/locale/{locale}', LocalizationController::class)->name('locale');


Route::middleware(Localization::class) -> group(function(){

    Route::get('/', function () {
        return view('home');
    }) ->name('home');


    Route::middleware('auth','adm')->group(function () {
        Route::resource('aulas', AulaController::class);

        Route::resource('matriculas', MatriculaController::class);
        Route::get('/dashboard',[GraficoController::class,'index'])->name('dashboard');  
            

            

    });
    
        Route::get('/pessoas', function () {
        return view('pessoas');
    }) ->name('pessoas');

    
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';

});