<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('{any}', function () {
    return view('home');
})->where('any','.*');