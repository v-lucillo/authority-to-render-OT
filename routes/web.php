<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $user =  session('user');
    if($user){
        return redirect()->route("user.home");
    }
    return view('welcome');
})->name('sign_in');


Route::prefix("api")->name("api.")->group(function(){
    Route::get('registration','APIController@registration')->name('registration');
    Route::post('sign_up','APIController@sign_up')->name('sign_up');
    Route::post('login','APIController@login')->name('login');

}); 
Route::prefix("user")->name("user.")->group(function(){
    Route::get('home','UserController@home')->name('home');
    Route::get('file_ot','UserController@file_ot')->name('file_ot');
    Route::post('submit_ot','UserController@submit_ot')->name('submit_ot');
    Route::get('logout','UserController@logout')->name('logout');
    Route::get('ot_lvl1','UserController@ot_lvl1')->name('ot_lvl1');
    Route::get('history','UserController@history')->name('history');
    Route::get('remove_ot','UserController@remove_ot')->name('remove_ot');
    Route::get('get_history_data','UserController@get_history_data')->name('get_history_data');
    Route::get('generate_pdf','UserController@generate_pdf')->name('generate_pdf');
}); 

Route::prefix("heads")->name("heads.")->group(function(){
    Route::get('ot','HeadsController@ot')->name('ot');
    Route::get('home','HeadsController@home')->name('home');
    Route::get('get_submitted_ot','HeadsController@get_submitted_ot')->name('get_submitted_ot');
    Route::get('approved_and_sign_ot','HeadsController@approved_and_sign_ot')->name('approved_and_sign_ot');
    Route::get('view_ot','HeadsController@view_ot')->name('view_ot');
    Route::get('generate_pdf','HeadsController@generate_pdf')->name('generate_pdf');
    Route::get('change_password','HeadsController@change_password')->name('change_password');
    Route::post('submit_change_password','HeadsController@submit_change_password')->name('submit_change_password');
    Route::get('change_signature','HeadsController@change_signature')->name('change_signature');
    Route::post('submit_change_signature','HeadsController@submit_change_signature')->name('submit_change_signature');
}); 


Route::prefix("admin")->name("admin.")->group(function(){
    Route::get('create_department','AdminController@create_department')->name('create_department');
    Route::post('submit_department','AdminController@submit_department')->name('submit_department');
    Route::get('get_department','AdminController@get_department')->name('get_department');
    Route::get('create_head_account','AdminController@create_head_account')->name('create_head_account');
    Route::get('get_department_lov','AdminController@get_department_lov')->name('get_department_lov');
    Route::post('submit_dept_head_create','AdminController@submit_dept_head_create')->name('submit_dept_head_create');
    Route::get('get_head_account','AdminController@get_head_account')->name('get_head_account');
    Route::get('edit_head_account','AdminController@edit_head_account')->name('edit_head_account');
    Route::post('change_head_password','AdminController@change_head_password')->name('change_head_password');

    Route::post('change_head_department','AdminController@change_head_department')->name('change_head_department');
}); 