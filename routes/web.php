<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PlanoController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group( function(){

    /** Planos */
    Route::match(['get', 'post'], 'planos/pesquisa', [PlanoController::class, 'search'])->name('planos.search');
    Route::get('planos/set-status', [PlanoController::class, 'planoSetStatus'])->name('planos.planoSetStatus');
    Route::delete('planos/deleteon', [PlanoController::class, 'deleteon'])->name('planos.deleteon');
    Route::get('planos/delete', [PlanoController::class, 'delete'])->name('planos.delete');
    Route::resource('planos', PlanoController::class);

    Route::get('/', [AdminController::class, 'home'])->name('home');

    // Route::get('/', function () {
    //     return view('admin.dashboard');
    // })->name('admin.home');

});

