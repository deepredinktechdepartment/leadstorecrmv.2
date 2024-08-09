<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\SourceGroupController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ExternalDataController;



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

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Reset password
    Route::get('reset-password', [UserController::class, 'changePasswordForm'])->name('reset.password');
    Route::post('reset-password-post',[UserController::class,'saveChangePassword'])->name('verifying.password');



    // Profile routes
    Route::get('profile', [UserController::class, 'showProfileForm'])->name('profile.show');
    Route::post('profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('change-password', [UserController::class, 'changePassword'])->name('profile.changePassword');



    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('users/create', [UserController::class, 'edit'])->name('users.create');
    Route::post('users/updateData', [UserController::class, 'storeOrUpdate'])->name('userUpdateData');
    Route::post('users/storeData', [UserController::class, 'storeOrUpdate'])->name('userstoreData');
    Route::post('users/deleteData', [UserController::class, 'storeOrUpdate'])->name('users.destroy');


    Route::post('/users/updatePassword', [UserController::class, 'updatePassword'])->name('users.updatePassword');
    Route::post('/users/toggleStatus', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');

    Route::resource('clients', ClientController::class);



    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

Route::any('projectLeads', [ExternalDataController::class,'fetchDataFromExternalAPI'])->name('projectLeads');
Route::any('get/crm/leads', [ExternalDataController::class,'fetchCRMLeads'])->name('get.crm.leads');
Route::get('/SingleLeadData/{params?}', [ExternalDataController::class, 'SingleLeadData'])->name('Single.Lead.Data');
Route::get('/project/settings', [ClientController::class, 'projectSetting'])->name('project.settings');
Route::match(['get', 'post'], '/clients/save/{id?}', [ClientController::class, 'save'])->name('clients.save');


// sources & their Group
    Route::resource('sources', SourceController::class);
    Route::resource('source_groups', SourceGroupController::class);
});
