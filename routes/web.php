<?php

use App\Http\Controllers\Admin\PlanoController;
use Illuminate\Support\Facades\Route;

Route::resource('admin/planos', PlanoController::class);

Route::get('/', function () {
    return view('welcome');
});
