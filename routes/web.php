<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Update;

//Product_Routes
Route::get('/Product-Invoice',[InvoiceController::class,'invoice'])->name('invoice')->middleware('AdminIsValid');
Route::get('/AML-Beverage',[MainController::class,'beverages'])->name('beverages')->middleware('AdminIsValid');
Route::get('/AML-Dredging',[MainController::class,'dredgings'])->name('dredgings')->middleware('AdminIsValid');
Route::get('/IGLOO-Dairy',[MainController::class,'dairys'])->name('dairys')->middleware('AdminIsValid');
Route::get('/AML-Bran-Oil',[MainController::class,'branOils'])->name('branOils')->middleware('AdminIsValid');
Route::get('/IGLOO-Foods',[MainController::class,'foods'])->name('foods')->middleware('AdminIsValid');
Route::get('/IT-Store',[MainController::class,'Itcus'])->name('Itcus')->middleware('AdminIsValid');
Route::get('/AML-Construction',[MainController::class,'constructions'])->name('constructions')->middleware('AdminIsValid');
Route::get('/AML-Sugar',[MainController::class,'sugers'])->name('sugers')->middleware('AdminIsValid');
Route::get('/IGLOO-Ice-Cream',[MainController::class,'index'])->name('Igloo_CHO')->middleware('AdminIsValid');
//User_Routes
Route::get('/Admin/User_list', function () {return view('User.userlist');})->name('userlist')->middleware('AdminIsValid');
//Admin_Routes Admin_list
Route::get('/Admin/Activity_log', function () {return view('activity-log');})->name('ActivityLog')->middleware('SAdminIsValid');
Route::get('/Admin/Admin_list', function () {return view('admin-list');})->name('AdminList')->middleware('SAdminIsValid');
Route::get('/Admin/Change_Password', function () {return view('Admin.ChangePass');})->name('AdminCPass')->middleware('SAdminIsValid');
Route::post('/Admin/Change_Password',[AdminController::class, 'AdminCpass'])->name('AdminPassC')->middleware('SAdminIsValid');
Route::get('/Admin/Admin_Create', function () {return view('Admin.AdminCreate');})->name('AdminCreate')->middleware('SAdminIsValid');
Route::post('/Admin/Admin_Create',[AdminController::class, 'AdminCreateSubmit'])->name('AdminCreated')->middleware('SAdminIsValid');
Route::get('/Admin/Login', function () {return view('Admin.Login');})->name('AdminLogin')->middleware('LoginIsValid');
Route::get('/', function () {return view('Admin.Dashboard');})->name('home')->middleware('AdminIsValid');
Route::post('/Admin/Logged_in',[AdminController::class, 'AdminLogSubmit'])->name('AdminLog')->middleware('LoginIsValid');
Route::get('/Admin/LogOut',[AdminController::class, 'logout'])->name('AdminLogout')->middleware('AdminIsValid');
//Ip_Routes
Route::get('/Admin/Ip_list', function () {return view('Ip.ipaddress');})->name('ipaddress')->middleware('AdminIsValid');
//Vpn_Routes
Route::get('/Admin/Vpn_list', function () {return view('Vpn.vpn');})->name('vpn')->middleware('AdminIsValid');
