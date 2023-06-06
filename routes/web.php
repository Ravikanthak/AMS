<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EstablishmentArmoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthReqController;


Route::get('/login' , [Controller::class , 'login'] )->name('login');
Route::get('/register' , [Controller::class , 'register'] )->name('register');

Route::get('/dashboard' , [Controller::class , 'dashboard'] )->name('dashboard');

Route::get('/logout' , [Controller::class , 'logout'] )->name('logout');



Route::get('/auth_req_lttr_troops/{id?}' , [AuthReqController::class , 'auth_req_lttr_troops'] )->name('auth_req_lttr_troops');
Route::get('/auth_req_lttr_troops_view' , [AuthReqController::class , 'auth_req_lttr_troops_view'] )->name('auth_req_lttr_troops_view');

Route::post('/auth_req_lttr_troops_form_func' , [AuthReqController::class , 'auth_req_lttr_troops_form_func'] )->name('auth_req_lttr_troops_form_func');
Route::post('/auth_req_lttr_troops_view_func' , [AuthReqController::class , 'auth_req_lttr_troops_view_func'] )->name('auth_req_lttr_troops_view_func');

Route::post('/auth_req_lttr_troops_view_btn' , [AuthReqController::class , 'auth_req_lttr_troops_view_btn'] )->name('auth_req_lttr_troops_view_btn');

Route::post('/auth_req_lttr_troops_loaddata_tofields' , [AuthReqController::class , 'auth_req_lttr_troops_loaddata_tofields'] )->name('auth_req_lttr_troops_loaddata_tofields');



Route::get('/auth_req_lttr_weapon' , [AuthReqController::class , 'auth_req_lttr_weapon'] )->name('auth_req_lttr_weapon');
Route::get('/auth_req_lttr_weapon_view' , [AuthReqController::class , 'auth_req_lttr_weapon_view'] )->name('auth_req_lttr_weapon_view');



Route::post('/auth_req_lttr_weapon_form_func' , [AuthReqController::class , 'auth_req_lttr_weapon_form_func'] )->name('auth_req_lttr_weapon_form_func');




Route::get('/create_user' , [Controller::class , 'create_user'] )->name('create_user');

Route::post('/login_func' , [Controller::class , 'login_func'] ); 
Route::post('/register_func' , [Controller::class , 'register_func'] );

Route::post('/add_establishment_func' , [Controller::class , 'add_establishment_func'] );


//Establishment Armoury
Route::resource('/estb_armoury', EstablishmentArmoryController::class);
Route::post('/get-establishment-armory-dt', [EstablishmentArmoryController::class,'getEstablishmentArmoryDt'])->name('get-establishment-armory-dt');

//establishment admin
Route::resource('/admin', AdminController::class);


// Datatable
Route::get('/add_org' , [Controller::class , 'add_org'] )->name('add_org');
Route::get('/delete_sup_func/{id}' , [Controller::class , 'delete_sup_func'] );
Route::get('/datatable_edit/{id}' , [Controller::class , 'datatable_edit'] );
Route::post('/datatable_edit_func' , [Controller::class , 'datatable_edit_func'] );
// Datatable

Route::get('image_upload', function () { return view('image_upload'); });
Route::post('/image/upload', '\App\Http\Controllers\UnitController@upload')->name('image.upload');



// Route::get('image_upload', function () { return view('image_upload'); });

Route::post('/upload' , [AuthReqController::class , 'upload'] )->name('upload');