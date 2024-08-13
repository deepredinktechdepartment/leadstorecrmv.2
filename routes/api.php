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
Route::get('/get-leads', [ExternalDataController::class, 'getLeads']);