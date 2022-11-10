<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Update;
Route::get('/',[MainController::class,'index'])->name('home');
Route::get('/invoice',[InvoiceController::class,'invoice'])->name('invoice');
Route::get('/Beverages',[MainController::class,'beverages'])->name('beverages');
Route::get('/AML-Dredging',[MainController::class,'dredgings'])->name('dredgings');
Route::get('/Igloo-Dairy',[MainController::class,'dairys'])->name('dairys');
Route::get('/AML-BranOil',[MainController::class,'branOils'])->name('branOils');
Route::get('/Igloo-Foods',[MainController::class,'foods'])->name('foods');
Route::get('/custudy-Igloo',[MainController::class,'cusIgloo'])->name('cusIgloo');
Route::get('/It-custudy',[MainController::class,'Itcus'])->name('Itcus');
Route::get('/Constructions',[MainController::class,'constructions'])->name('constructions');
Route::get('/Sugars',[MainController::class,'sugers'])->name('sugers');
Route::get('/HR-Admin-Procurement-MIS',[MainController::class,'hmp'])->name('hmp');
Route::get('/Igloo-CHO',[MainController::class,'index'])->name('Igloo_CHO');
Route::get('/It-custudy-construction',[MainController::class,'CusCon'])->name('CusCon');
Route::post('/update-Igloo',[Update::class,'updateIgloo'])->name('updateIgloo');
Route::post('/update-Sugar',[Update::class,'updateSugar'])->name('updateSugar');
Route::post('/update-Construction',[Update::class,'updateCons'])->name('updateCons');
Route::post('/update-Hr',[Update::class,'updateHr'])->name('updateHr');
Route::post('/update-Mis',[Update::class,'updateMis'])->name('updateMis');
Route::post('/update-Procurement',[Update::class,'updateProc'])->name('updateProc');
Route::post('/update-Foods',[Update::class,'updateFoods'])->name('updatefoods');
Route::post('/update-Dairy',[Update::class,'updateDairy'])->name('updateDairy');
Route::post('/update-Dredging',[Update::class,'updateDredging'])->name('updateDredging');
Route::post('/update-BranOil',[Update::class,'updateBoil'])->name('updateBoil');
Route::post('/update-Beverage',[Update::class,'updateBev'])->name('updateBev');
Route::post('/update-It-custudy-Igloo',[Update::class,'updatecusIgloo'])->name('updatecusIgloo');
Route::post('/update-It-custudy-construction',[Update::class,'updatecusCon'])->name('updatecusCon');
Route::post('/update-It-custudy-Beverage',[Update::class,'updatecusBeve'])->name('updatecusBeve');
Route::post('/update-It-custudy',[Update::class,'updateItcus'])->name('updateItcus');
Route::get('/dept',[MainController::class,'dept'])->name('dept');
Route::get('/nav', function () {return view('navbar');})->name('nav');




