<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DetailPlanController;
use App\Http\Controllers\Admin\PlanoController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group( function(){
    /** Detalhes dos Planos */
    Route::post('planos/{slug}/details', [DetailPlanController::class, 'store'])->name('plan.details.store');
    Route::delete('details/deleteon', [DetailPlanController::class, 'deleteon'])->name('plan.details.deleteon');
    Route::get('details/delete', [DetailPlanController::class, 'delete'])->name('plan.details.delete');
    Route::put('planos/{slug}/details/{id}', [DetailPlanController::class, 'update'])->name('plan.details.update');
    Route::get('planos/{slug}/details/{id}/edit', [DetailPlanController::class, 'edit'])->name('plan.details.edit');
    Route::get('planos/{slug}/details/create', [DetailPlanController::class, 'create'])->name('plan.details.create');
    Route::get('planos/{slug}/details', [DetailPlanController::class, 'index'])->name('plan.details.index');

    /** Planos */
    Route::match(['get', 'post'], 'planos/pesquisa', [PlanoController::class, 'search'])->name('planos.search');
    Route::get('planos/set-status', [PlanoController::class, 'planoSetStatus'])->name('planos.planoSetStatus');
    Route::delete('planos/deleteon', [PlanoController::class, 'deleteon'])->name('planos.deleteon');
    Route::get('planos/delete', [PlanoController::class, 'delete'])->name('planos.delete');
    Route::resource('planos', PlanoController::class);

    Route::get('/', [AdminController::class, 'home'])->name('home');
});

