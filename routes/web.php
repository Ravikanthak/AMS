<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrganizationArmoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthReqController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\OrganizationResourceController;
use Illuminate\Support\Facades\Auth;



//Route::get('/login' , [Controller::class , 'login'] )->name('login');
//Route::get('/register' , [Controller::class , 'register'] )->name('register');



Route::get('/dashboard' , [HomeController::class , 'index'] )->name('dashboard');

Route::get('/logout' , [Controller::class , 'logout'] )->name('logout');

Route::get('/auth_req_ltr' , [Controller::class , 'auth_req_ltr'] )->name('auth_req_ltr');


Route::post('/register_func' , [Controller::class , 'register_func'] );

Route::post('/add_establishment_func' , [Controller::class , 'add_establishment_func'] );




Route::get('/', function () {;
    return redirect('/login');
});


Route::post('/login_func' , [Controller::class , 'login_func'] );





Route::group(['middleware' => 'auth'], function () {


//Establishment Armoury
Route::resource('/org_armoury', OrganizationArmoryController::class);
Route::post('/get-organization-armory-dt', [OrganizationArmoryController::class,'getEstabligetOrganizationArmoryDt'])->name('get-organization-armory-dt');
Route::post('/get-organization-type', [OrganizationArmoryController::class,'getOrganizationType'])->name('get-organization-type');

//establishment admin save
Route::resource('/admin', AdminController::class);

//establishment admin save
Route::resource('/resource', OrganizationResourceController::class);

//organization admin view
Route::get('/create_user' , [AdminController::class , 'create_user'] )->name('create_user');
Route::post('/get-admin-user-type' , [AdminController::class , 'getAdminUserType'] )->name('get-admin-user-type');


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



//Ravikantha

Route::get('/auth_req_ltr_troops/{id?}' , [AuthReqController::class , 'auth_req_ltr_troops'] )->name('auth_req_ltr_troops');
Route::get('/auth_req_ltr_troops_view' , [AuthReqController::class , 'auth_req_ltr_troops_view'] )->name('auth_req_ltr_troops_view');
Route::get('/auth_req_ltr_troops_take_action_view' , [AuthReqController::class , 'auth_req_ltr_troops_take_action_view'] )->name('auth_req_ltr_troops_take_action_view');
Route::get('/auth_req_ltr_troops_take_action/{id?}' , [AuthReqController::class , 'auth_req_ltr_troops_take_action'] )->name('auth_req_ltr_troops_take_action');


Route::post('/auth_req_ltr_troops_form_func' , [AuthReqController::class , 'auth_req_ltr_troops_form_func'] )->name('auth_req_ltr_troops_form_func');
Route::post('/auth_req_ltr_troops_track_btn' , [AuthReqController::class , 'auth_req_ltr_troops_track_btn'] )->name('auth_req_ltr_troops_track_btn');

Route::post('/auth_req_ltr_troops_view_btn' , [AuthReqController::class , 'auth_req_ltr_troops_view_btn'] )->name('auth_req_ltr_troops_view_btn');

Route::post('/auth_req_ltr_weapons_view_btn' , [AuthReqController::class , 'auth_req_ltr_weapons_view_btn'] )->name('auth_req_ltr_weapons_view_btn');

Route::post('/auth_req_ltr_troops_loaddata_tofields' , [AuthReqController::class , 'auth_req_ltr_troops_loaddata_tofields'] )->name('auth_req_ltr_troops_loaddata_tofields');

Route::post('/auth_req_ltr_troops_approve_btn' , [AuthReqController::class , 'auth_req_ltr_troops_approve_btn'] )->name('auth_req_ltr_troops_approve_btn');

Route::post('/auth_req_ltr_troops_final_approve_btn' , [AuthReqController::class , 'auth_req_ltr_troops_final_approve_btn'] )->name('auth_req_ltr_troops_final_approve_btn');

Route::post('/auth_req_ltr_troops_decline_btn' , [AuthReqController::class , 'auth_req_ltr_troops_decline_btn'] )->name('auth_req_ltr_troops_decline_btn');

Route::post('/auth_req_ltr_troops_check_status' , [AuthReqController::class , 'auth_req_ltr_troops_check_status'] )->name('auth_req_ltr_troops_check_status');



Route::get('/auth_req_ltr_weapon/{id?}' , [AuthReqController::class , 'auth_req_ltr_weapon'] )->name('auth_req_ltr_weapon');
Route::get('/auth_req_ltr_weapon_view' , [AuthReqController::class , 'auth_req_ltr_weapon_view'] )->name('auth_req_ltr_weapon_view');



Route::post('/auth_req_ltr_weapon_form_func' , [AuthReqController::class , 'auth_req_ltr_weapon_form_func'] )->name('auth_req_ltr_weapon_form_func');
