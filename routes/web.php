<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Superadmin\SuperAdminController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Operator\OperatorController;
use App\Http\Controllers\Viewer\ViewerController;
use App\Http\Controllers\SuperAdmin\LocationController;
use App\Http\Controllers\Superadmin\EquipmentController;
use App\Http\Controllers\Superadmin\SuperAdminUserController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminLocationController;
use App\Http\Controllers\Operator\OperatorLocationController;
use App\Http\Controllers\Admin\MachineController;
use App\Http\Controllers\Operator\OperatorReportController;
use App\Http\Controllers\Admin\MaintenanceReportController;
use App\Http\Controllers\Operator\ProductionController;
use App\Http\Controllers\Admin\ProductionReportController;
use App\Http\Controllers\SuperAdmin\ProfileController;
use App\Http\Controllers\Admin\AdminProfileController;
// use App\Http\Controllers\MachineStatusController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// ROUTES FOR SUPERADMIN
Route::middleware(['auth','role:superadmin'])->group(function(){

    Route::get('/superadmin/dashboard', [SuperAdminController::class,'dashboard']);

    Route::prefix('superadmin')->name('superadmin.')->group(function () {
        Route::resource('locations', LocationController::class);
    });

    Route::get('/superadmin/equipment',[EquipmentController::class,'index'])->name('superadmin.equipment');

    Route::post('/superadmin/equipment/store',[EquipmentController::class,'store']);

    Route::post('/machine/status/{id}', [EquipmentController::class,'updateStatus']);

    Route::get('/superadmin/meters', [EquipmentController::class,'meterPage'])->name('superadmin.meters');

    Route::get('/running-machines', [EquipmentController::class, 'runningMachines']);

    Route::get('/superadmin/users', [SuperAdminUserController::class, 'index'])->name('superadmin.users.index');

    Route::get('/superadmin/create', [SuperAdminUserController::class, 'create'])->name('superadmin.users.create');

    Route::post('/superadmin/users/store', [SuperAdminUserController::class, 'store'])->name('superadmin.users.store');

    Route::get('/superadmin/profile', [ProfileController::class,'edit'])->name('superadmin.profile.edit');

    Route::post('/superadmin/profile',[ProfileController::class,'update'])->name('superadmin.profile.update');
});


// ROUTES FOR ADMIN AND SUPERADMIN MAINTAINCE REPORT

  Route::get('/admin/maintenance-reports', [MaintenanceReportController::class,'adminIndex'])
  ->middleware(['auth','role:admin'])->name('admin.maintenance');


    Route::get('/superadmin/maintenance-reports', [MaintenanceReportController::class,'superIndex']
    )->middleware(['auth','role:superadmin'])->name('superadmin.maintenance');



// ROUTES FOR ADMIN AND SUPERADMIN PRODUCTION REPORT

Route::get('/admin/production-reports',[ProductionReportController::class,'adminIndex'])
->middleware(['auth','role:admin'])->name('admin.production.reports');

Route::get('/superadmin/production-reports',[ProductionReportController::class,'superIndex']
)->middleware(['auth','role:superadmin'])->name('superadmin.production.reports');


// ROUTES FOR ADMIN
Route::middleware(['auth','role:admin'])->group(function(){

    Route::get('/admin/dashboard', [AdminController::class,'dashboard']);

    Route::get('/admin/users', [UserController::class,'index'])->name('admin.users');

    Route::get('/users/create', [UserController::class,'create'])->name('admin.users.create');

    Route::post('/users/store', [UserController::class,'store'])->name('admin.users.store');

    Route::get('/locations', [AdminLocationController::class,'index'])->name('admin.locations');

    Route::get('/machines', [MachineController::class,'index'])->name('admin.machines');

    Route::get('/admin/running-machines',[AdminController::class,'runningMachines']);

    Route::get('/meters',[AdminController::class,'meters'])->name('admin.meters');

    Route::get('/admin/profile', [AdminProfileController::class,'edit'])->name('admin.profile.edit');

    Route::post('/admin/profile',[AdminProfileController::class,'update'])->name('admin.profile.update');

});


// ROUTES FOR OPERATOR
Route::middleware(['auth','role:operator'])->group(function(){

    Route::get('/operator/dashboard', [OperatorController::class,'dashboard']);

    Route::get('/oprators/machines', [OperatorController::class,'machines'])->name('operator.machines');

    Route::post('/operator/machines/status', [OperatorController::class,'updateStatus'])->name('operator.machine.status');
    
    Route::get('/operator/locations', [OperatorLocationController::class,'index'])->name('operator.locations');

    Route::get('/operator/meters',[OperatorController::class,'meters'])->name('operator.meters');

    
    Route::get('/operator/running-machines',[OperatorController::class,'runningMachines']);

    Route::get('/operator/reports', [OperatorReportController::class,'index'])->name('operator.reports');

    Route::get('/operator/reports/{machine}', [OperatorReportController::class,'create'])->name('operator.report.create');


    Route::post('/reports/store', [OperatorReportController::class,'store'])->name('operator.report.store');

    Route::get('/operator/production/create', [ProductionController::class,'create'])->name('production.create');

    Route::post('/operator/production/store', [ProductionController::class,'store'])->name('production.store');

});

// ROUTES FOR VIEWER
Route::middleware(['auth','role:viewer'])->group(function(){

    Route::get('/viewer/dashboard', [ViewerController::class,'dashboard']);

});