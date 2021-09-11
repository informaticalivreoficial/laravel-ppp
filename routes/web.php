<?php

use App\Http\Controllers\ACL\PermissaoController;
use App\Http\Controllers\ACL\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DetailPlanController;
use App\Http\Controllers\Admin\PlanoController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group( function(){

    /** Perfis */
    Route::delete('profiles/deleteon', [ProfileController::class, 'deleteon'])->name('profiles.deleteon');
    Route::get('profiles/delete', [ProfileController::class, 'delete'])->name('profiles.delete');
    Route::put('profiles/{profile}', [ProfileController::class, 'update'])->name('profiles.update');
    Route::get('profiles/{profile}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
    Route::get('profiles/create', [ProfileController::class, 'create'])->name('profiles.create');
    Route::post('profiles/store', [ProfileController::class, 'store'])->name('profiles.store');
    Route::get('profiles', [ProfileController::class, 'index'])->name('profiles.index');

    /** Permissões */ 
    Route::delete('permissoes/deleteon', [PermissaoController::class, 'deleteon'])->name('permissoes.deleteon');
    Route::get('permissoes/delete', [PermissaoController::class, 'delete'])->name('permissoes.delete');
    Route::put('permissoes/{permissao}', [PermissaoController::class, 'update'])->name('permissoes.update');
    Route::get('permissoes/{permissao}/edit', [PermissaoController::class, 'edit'])->name('permissoes.edit');
    Route::get('permissoes/create', [PermissaoController::class, 'create'])->name('permissoes.create');
    Route::post('permissoes/store', [PermissaoController::class, 'store'])->name('permissoes.store');
    Route::get('permissoes', [PermissaoController::class, 'index'])->name('permissoes.index');

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
    Route::put('planos/plano/{id}', [PlanoController::class, 'update'])->name('planos.update');
    Route::get('planos/plano/{id}/edit', [PlanoController::class, 'edit'])->name('planos.edit');
    Route::get('planos/create', [PlanoController::class, 'create'])->name('planos.create');
    Route::post('planos/store', [PlanoController::class, 'store'])->name('planos.store');
    Route::get('planos', [PlanoController::class, 'index'])->name('planos.index');

    Route::get('/', [AdminController::class, 'home'])->name('home');
});

