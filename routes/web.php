<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Update;

//Product_Routes
Route::get('/',[MainController::class,'index'])->name('home');
Route::get('/Product-Invoice',[InvoiceController::class,'invoice'])->name('invoice')->middleware('AdminIsValid');
Route::get('/AML-Beverage',[MainController::class,'beverages'])->name('beverages')->middleware('AdminIsValid');
Route::get('/AML-Dredging',[MainController::class,'dredgings'])->name('dredgings')->middleware('AdminIsValid');
Route::get('/IGLOO-Dairy',[MainController::class,'dairys'])->name('dairys')->middleware('AdminIsValid');
Route::get('/AML-Bran-Oil',[MainController::class,'branOils'])->name('branOils')->middleware('AdminIsValid');
Route::get('/IGLOO-Foods',[MainController::class,'foods'])->name('foods')->middleware('AdminIsValid');
// Route::get('/custudy-Igloo',[MainController::class,'cusIgloo'])->name('cusIgloo');
Route::get('/IT-Store',[MainController::class,'Itcus'])->name('Itcus')->middleware('AdminIsValid');
Route::get('/AML-Construction',[MainController::class,'constructions'])->name('constructions')->middleware('AdminIsValid');
Route::get('/AML-Sugar',[MainController::class,'sugers'])->name('sugers')->middleware('AdminIsValid');
// Route::get('/HR-Admin-Procurement-MIS',[MainController::class,'hmp'])->name('hmp');
Route::get('/IGLOO-Ice-Cream',[MainController::class,'index'])->name('Igloo_CHO')->middleware('AdminIsValid');
// Route::get('/It-custudy-construction',[MainController::class,'CusCon'])->name('CusCon');
Route::post('/update-Igloo',[Update::class,'updateIgloo'])->name('updateIgloo')->middleware('AdminIsValid');
Route::post('/update-Sugar',[Update::class,'updateSugar'])->name('updateSugar')->middleware('AdminIsValid');
Route::post('/update-Construction',[Update::class,'updateCons'])->name('updateCons')->middleware('AdminIsValid');
Route::post('/update-Hr',[Update::class,'updateHr'])->name('updateHr')->middleware('AdminIsValid');
Route::post('/update-Mis',[Update::class,'updateMis'])->name('updateMis')->middleware('AdminIsValid');
Route::post('/update-Procurement',[Update::class,'updateProc'])->name('updateProc')->middleware('AdminIsValid');
Route::post('/update-Foods',[Update::class,'updateFoods'])->name('updatefoods')->middleware('AdminIsValid');
Route::post('/update-Dairy',[Update::class,'updateDairy'])->name('updateDairy')->middleware('AdminIsValid');
Route::post('/update-Dredging',[Update::class,'updateDredging'])->name('updateDredging')->middleware('AdminIsValid');
Route::post('/update-BranOil',[Update::class,'updateBoil'])->name('updateBoil')->middleware('AdminIsValid');
Route::post('/update-Beverage',[Update::class,'updateBev'])->name('updateBev')->middleware('AdminIsValid');
Route::post('/update-It-custudy-Igloo',[Update::class,'updatecusIgloo'])->name('updatecusIgloo')->middleware('AdminIsValid');
Route::post('/update-It-custudy-construction',[Update::class,'updatecusCon'])->name('updatecusCon')->middleware('AdminIsValid');
Route::post('/update-It-custudy-Beverage',[Update::class,'updatecusBeve'])->name('updatecusBeve')->middleware('AdminIsValid');
Route::post('/update-It-custudy',[Update::class,'updateItcus'])->name('updateItcus')->middleware('AdminIsValid');
Route::get('/dept',[MainController::class,'dept'])->name('dept');

//Admin_Routes
Route::get('/Admin/Login', function () {return view('Admin.Login');})->name('AdminLogin');
Route::get('/Admin/Dashboard', function () {return view('Admin.Dashboard');})->name('AdminDash');
Route::post('/Admin/Logged_in',[AdminController::class, 'AdminLogSubmit'])->name('AdminLog');
Route::get('/Admin/LogOut',[AdminController::class, 'logout'])->name('AdminLogout');


