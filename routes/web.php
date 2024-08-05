<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/






Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');



Route::post('auth/verify', [LoginController::class, 'authenticate'])->name('auth.verify');

/** Reset * Forgot  password route URL */
Route::get('forgotpassword', [UsersController::class, 'showForgetPasswordForm'])->name('forget.password');
Route::post('forget-password', [UsersController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password',[UsersController::class,'changeownpassword'])->name('reset.password')->middleware('auth');
Route::any('post-changeown-password',[UsersController::class,'store_changeownpassword'])->name('post.changeown.password')->middleware('auth');
Route::get('logout', [LoginController::class,'logout'])->name('logout');


	/*Admin users*/
/* Admin users */
Route::get('users', [UserController::class, 'listUsers'])->name('reg.user');
Route::get('user/create', [UserController::class, 'showCreateUserForm']);
Route::post('user/store', [UserController::class, 'storeNewUser']);
Route::get('user/edit/{id}', [UserController::class, 'showEditUserForm']);
Route::post('user/update', [UserController::class, 'updateUser']);
Route::get('user/delete/{id}', [UserController::class, 'deleteUser']);
