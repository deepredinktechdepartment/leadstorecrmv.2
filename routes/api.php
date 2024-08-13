<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExternalDataController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/fetch-roles/{empID?}', [HRController::class, 'fetchRoles']);
Route::get('/fetch-roles-emp/{empID?}', [HRController::class, 'fetchRolesEmp']);
Route::get('/DeleteCRMRecord/{params?}', [ExternalDataController::class, 'DeleteCRMRecord'])->name('api.DeleteCRMRecord');
Route::get('/UpdateCRMRecord/{params?}', [ExternalDataController::class, 'UpdateCRMRecord'])->name('api.UpdateCRMRecord');


// For API routes (usually in routes/api.php)
Route::get('getleads', [ExternalDataController::class, 'getLeads']);
Route::get('getsingleleadData', [ExternalDataController::class, 'getSingleLeadData']);
Route::get('deleteLeadfromexternal', [ExternalDataController::class, 'deleteLead']);
Route::get('updateLeadfromexternal', [ExternalDataController::class, 'updateLead']);

Route::post('leads/handle-external-post', [ExternalDataController::class, 'handleExternalPost'])->middleware('project.api.key');