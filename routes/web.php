<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Models\User;
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
Route::get('new-login', function () {
    return view('new-login');
});
Route::get('new-register', function () {
    return view('new-register');
});
Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');
Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('user/dashboard/list', function () {
        $users = User::get();
    return view('user-dashboard-list',compact('users'));
})->name('user.dashboard.list');

Route::post('login',[LoginController::class,'login'])->name('user.login');
Route::get('logout',[LoginController::class,'logout'])->name('logout');

Route::get('extra/function',[UserController::class,'extraFunction']);

Route::group(['prefix'=>'user'], function(){
    //  UserController Route
    Route::get('list',[UserController::class,'list'])->name('user.list');
    Route::get('create',[UserController::class,'create'])->name('user.create');
    Route::post('store',[UserController::class,'store'])->name('user.store');
    Route::get('edit',[UserController::class,'edit']);
    Route::post('update',[UserController::class,'update']);
    Route::get('delete/{id}',[UserController::class,'delete']);
    Route::get('delete',[UserController::class,'deleteAjax'])->name('user.delete.ajax');
});

//  AdminController Route
Route::group(['prefix'=>'admin'], function(){
    Route::get('create',[AdminController::class,'create'])->name('admin.create');
    Route::post('store',[AdminController::class,'store'])->name('admin.store');
    Route::get('list',[AdminController::class,'index'])->name('admin.list');
});

Route::get('mail/send',[UserController::class,'mailSend'])->name('mail.send');
