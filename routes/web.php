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
use App\Http\Controllers\LeadController;


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
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


    Route::post('/users/updatePassword', [UserController::class, 'updatePassword'])->name('users.updatePassword');
    Route::post('/users/toggleStatus', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');

// Define a custom route for editing clients (must come before the resource route)
Route::get('clients/edit', [ClientController::class, 'edit'])->name('clients.edit');

// Define the resource route for clients (will generate standard CRUD routes)
Route::resource('clients', ClientController::class)->except([
    'edit' // Exclude the edit route from the resource controller
]);
Route::post('/clients/update-status', [ClientController::class, 'updateStatus'])->name('clients.updateStatus');
Route::delete('clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');



Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

Route::any('projectLeads', [ExternalDataController::class,'fetchDataFromExternalAPI'])->name('projectLeads');
Route::any('get/crm/leads', [ExternalDataController::class,'fetchCRMLeads'])->name('get.crm.leads');
Route::get('/SingleLeadData/{params?}', [ExternalDataController::class, 'SingleLeadData'])->name('Single.Lead.Data');
Route::get('/project/settings', [ClientController::class, 'projectSetting'])->name('project.settings');
Route::match(['get', 'post'], '/clients/save/{id?}', [ClientController::class, 'save'])->name('clients.save');


// sources & their Group
    Route::resource('sources', SourceController::class);
    Route::resource('source_groups', SourceGroupController::class);


    Route::get('/export-leads', [LeadController::class, 'export'])->name('exportLeads');



Route::get('/client/{clientID?}/dashboard', [ClientController::class, 'dashboard'])->name('projectLeads');
Route::get('/client/{clientID?}/facebook', [ClientController::class, 'facebook'])->name('facebook');
Route::get('/client/{clientID?}/facebook-pages', [ClientController::class, 'facebookPages'])->name('facebookPages');
Route::get('/client/{clientID?}/competitor-scores', [ClientController::class, 'competitorScores'])->name('competitorScores');
Route::get('/client/{clientID?}/exotel', [ClientController::class, 'exotel'])->name('exotel');
Route::get('/client/{clientID?}/email-server', [ClientController::class, 'emailServer'])->name('emailServer');
Route::get('/client/{clientID?}/first-response-emailer', [ClientController::class, 'firstResponseEmailer'])->name('firstResponseEmailer');
Route::get('/client/{clientID?}/email-lead-notifications', [ClientController::class, 'leadNotifications'])->name('emailLeadNotifications');
Route::get('/client/{clientID?}/sms-lead-notifications', [ClientController::class, 'leadNotifications'])->name('smsLeadNotifications');
Route::get('/client/{clientID?}/fre-template', [ClientController::class, 'freTemplate'])->name('freTemplate');
Route::get('/client/{clientID?}/email-lead-notification-template', [ClientController::class, 'leadNotificationTemplate'])->name('emailleadNotificationTemplate');
Route::get('/client/{clientID?}/sms-lead-notification-template', [ClientController::class, 'leadNotificationTemplate'])->name('smsleadNotificationTemplate');
Route::get('/client/{clientID?}/lead-notification-template', [ClientController::class, 'leadSummaryNotifications'])->name('leadSummaryNotifications');
Route::get('/client/{clientID?}/sms-gateway', [ClientController::class, 'smsGateway'])->name('smsGateway');
Route::get('/client/{clientID?}/first-response-sms', [ClientController::class, 'firstResponseSms'])->name('firstResponseSms');
Route::get('/client/{clientID?}/setup-monthly-goals', [ClientController::class, 'setupMonthlyGoals'])->name('setupMonthlyGoals');
Route::get('/client/{clientID?}/lead-capture', [ClientController::class, 'leadCapture'])->name('leadCapture');
Route::get('/client/{clientID?}/lead-actions', [ClientController::class, 'leadActions'])->name('leadActions');
Route::get('/client/{clientID?}/blacklisting', [ClientController::class, 'blacklisting'])->name('blacklisting');
Route::get('/client/{clientID?}/hide-cust-info', [ClientController::class, 'hideCustInfo'])->name('hideCustInfo');
Route::get('/client/{clientID?}/revenue-tracking', [ClientController::class, 'revenueTracking'])->name('revenueTracking');


});
