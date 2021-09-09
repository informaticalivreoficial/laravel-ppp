<?php

use App\Http\Controllers\Admin\PlanoController;
use Illuminate\Support\Facades\Route;


Route::resource('admin/planos', PlanoController::class);

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.home');
