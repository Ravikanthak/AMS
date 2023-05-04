<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrganizationArmoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;



//Route::get('/login' , [Controller::class , 'login'] )->name('login');
//Route::get('/register' , [Controller::class , 'register'] )->name('register');





Route::get('/dashboard' , [HomeController::class , 'index'] )->name('dashboard');

//Route::get('/logout' , [AdminController::class , 'logout'] )->name('logout');

Route::get('/auth_req_lttr' , [Controller::class , 'auth_req_lttr'] )->name('auth_req_lttr');


Route::post('/register_func' , [Controller::class , 'register_func'] );

Route::post('/add_establishment_func' , [Controller::class , 'add_establishment_func'] );





Route::post('/login_func' , [Controller::class , 'login_func'] );





Route::group(['middleware' => 'auth'], function () {


//Establishment Armoury
Route::resource('/org_armoury', OrganizationArmoryController::class);
Route::post('/get-organization-armory-dt', [OrganizationArmoryController::class,'getEstabligetOrganizationArmoryDt'])->name('get-organization-armory-dt');

//establishment admin save
Route::resource('/admin', AdminController::class);

//organization admin view
Route::get('/create_user' , [AdminController::class , 'create_user'] )->name('create_user');

//roles
Route::resource('/roles', RoleController::class);



// Datatable
Route::get('/add_org' , [Controller::class , 'add_org'] )->name('add_org');
Route::get('/delete_sup_func/{id}' , [Controller::class , 'delete_sup_func'] );
Route::get('/datatable_edit/{id}' , [Controller::class , 'datatable_edit'] );
Route::post('/datatable_edit_func' , [Controller::class , 'datatable_edit_func'] );
// Datatable

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

