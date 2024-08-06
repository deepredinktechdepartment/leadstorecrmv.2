<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\SourceGroupController;




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

// Login routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('auth/verify', [LoginController::class, 'authenticate'])->name('auth.verify');

// Forgot and reset password routes
Route::get('forgotpassword', [UserController::class, 'showForgetPasswordForm'])->name('forget.password');
Route::post('forget-password', [UserController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

// Logout route
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Authenticated routes
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    // Reset password
    Route::get('reset-password', [UserController::class, 'changePasswordForm'])->name('reset.password');
    Route::post('reset-password-post',[UserController::class,'saveChangePassword'])->name('verifying.password');



    // Profile routes
    Route::get('profile', [UserController::class, 'showProfileForm'])->name('profile.show');
    Route::post('profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('change-password', [UserController::class, 'changePassword'])->name('profile.changePassword');

    // Admin users routes
    Route::get('users', [UserController::class, 'listUsers'])->name('reg.user');
    Route::get('user/create', [UserController::class, 'showCreateUserForm']);
    Route::post('user/store', [UserController::class, 'storeNewUser']);
    Route::get('user/edit/{id}', [UserController::class, 'showEditUserForm']);
    Route::post('user/update', [UserController::class, 'updateUser']);
    Route::get('user/delete/{id}', [UserController::class, 'deleteUser']);
    Route::get('user/delete/{id}', [UserController::class, 'deleteUser']);

// sources & their Group
    Route::resource('sources', SourceController::class);
Route::resource('source_groups', SourceGroupController::class);
});
