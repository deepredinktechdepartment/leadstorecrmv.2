<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\SourceGroupController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ExternalDataController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ThemeoptionsController;


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



/** Reset * Forgot  password route URL */
Route::get('forgotpassword', [UserController::class, 'showForgetPasswordForm'])->name('forget.password');
Route::post('forget-password', [UserController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('updateyourpassword/{userid?}', [UserController::class, 'setupPassword']);
Route::any('setup.password.update', [UserController::class, 'post_setuppassword'])->name('setup.password.update');

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


/*Admin Theme options*/
Route::resource('theme_options', ThemeoptionsController::class);
Route::get('theme_options/create',[ThemeoptionsController::class,'create_theme_options']);
Route::post('theme_options/store',[ThemeoptionsController::class,'store_theme_options']);
Route::get('theme_options/edit/{id?}',[ThemeoptionsController::class,'edit_theme_options']);
Route::post('theme_options/update/{id?}', [ThemeoptionsController::class, 'update_theme_options']);

Route::get('theme_options/delete/{id}',[ThemeoptionsController::class,'delete_theme_options']);



Route::get('/singleproject/{clientID?}/ExternalCRM', [ClientController::class, 'ExternalCRM'])->name('external.crm');


Route::get('/singleproject/{clientID?}/facebook', [ClientController::class, 'facebook'])->name('facebook');
Route::get('/singleproject/{clientID?}/facebook-pages', [ClientController::class, 'facebookPages'])->name('facebookPages');
Route::get('/singleproject/{clientID?}/competitor-scores', [ClientController::class, 'competitorScores'])->name('competitorScores');
Route::get('/singleproject/{clientID?}/exotel', [ClientController::class, 'exotel'])->name('exotel');

Route::get('/singleproject/{clientID?}/first-response-emailer', [ClientController::class, 'firstResponseEmailer'])->name('firstResponseEmailer');
Route::get('/singleproject/{clientID?}/email-lead-notifications', [ClientController::class, 'leadNotifications'])->name('emailLeadNotifications');
Route::get('/singleproject/{clientID?}/sms-lead-notifications', [ClientController::class, 'smsLeadNotifications'])->name('smsLeadNotifications');

//FRE Email Template
Route::get('/singleproject/{clientID?}/fre-template', [ClientController::class, 'freTemplate'])->name('freTemplate');
Route::get('/singleproject/{clientID?}/email-server', [ClientController::class, 'emailServer'])->name('emailServer');

Route::post('/settings/save', [SettingController::class, 'storeOrUpdateSetting'])->name('store.Or.Update.Setting');

Route::get('/singleproject/{clientID?}/sms-fre-template', [ClientController::class, 'smsFreTemplate'])->name('smsFreTemplate');
Route::get('/singleproject/{clientID?}/sms-lead-notification-template', [ClientController::class, 'smsLeadNotificationTemplate'])->name('smsLeadNotificationTemplate');
Route::get('/singleproject/{clientID?}/lead-notification-template', [ClientController::class, 'leadSummaryNotifications'])->name('leadSummaryNotifications');

Route::get('/singleproject/{clientID?}/email-lead-notification-template', [ClientController::class, 'leadNotificationTemplate'])->name('emailleadNotificationTemplate');
Route::get('/singleproject/{clientID?}/sms-gateway', [ClientController::class, 'smsGateway'])->name('smsGateway');
Route::get('/singleproject/{clientID?}/first-response-sms', [ClientController::class, 'firstResponseSms'])->name('firstResponseSms');
Route::get('/singleproject/{clientID?}/setup-monthly-goals', [ClientController::class, 'setupMonthlyGoals'])->name('setupMonthlyGoals');
Route::get('/singleproject/{clientID?}/lead-capture', [ClientController::class, 'leadCapture'])->name('leadCapture');
Route::get('/singleproject/{clientID?}/lead-actions', [ClientController::class, 'leadActions'])->name('leadActions');
Route::get('/singleproject/{clientID?}/blacklisting', [ClientController::class, 'blacklisting'])->name('blacklisting');
Route::get('/singleproject/{clientID?}/hide-cust-info', [ClientController::class, 'hideCustInfo'])->name('hideCustInfo');
Route::get('/singleproject/{clientID?}/revenue-tracking', [ClientController::class, 'revenueTracking'])->name('revenueTracking');


Route::get('/createlead', [LeadController::class, 'showForm'])->name('createLead');
Route::post('/lead/submit', [LeadController::class, 'submit'])->name('lead.submit');

});
