<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/Dataset',[MainController::class,'index']);

