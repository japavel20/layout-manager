<?php

use Illuminate\Support\Facades\Route;
use Layout\Manager\Http\Controllers\NavItemController;
use Layout\Manager\Http\Controllers\NavGroupController;
use Layout\Manager\Http\Controllers\GeneralSettingsController;

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::resource('nav-groups', NavGroupController::class);
    // Route::resource('nav-roles', RoleController::class);
    Route::resource('nav-items', NavItemController::class);
    Route::get('/nav-group-item-map', [NavGroupController::class, 'groupItemMap'])->name('nav-group-item-map');
    Route::post('/nav-group-item-map', [NavGroupController::class, 'groupItemMapStore'])->name('nav-group-item-map.store');
    // Route::get('/role-navitem-map', [RoleController::class, 'roleNavitemMap'])->name('role-navitem-map');
    // Route::post('/role-navitem-map', [RoleController::class, 'roleNavitemMapStore'])->name('role-navitem-map.store');
    Route::get('/nav-groups-positions', [NavGroupController::class, 'navGroupPosition'])->name('nav-group-position');
    // Route::get('/sync-nav-item-role',[RoleController::class, 'suncNavItemRole']);
    //Place your route here
    Route::resource('general-settings', GeneralSettingsController::class);
    Route::post('organization-setups/api/upload-image', [GeneralSettingsController::class, 'upload_image']);
});


// Route::prefix('organization-setups')->group(function () {
//     Route::get('/', [OrganizationSetupController::class, 'index'])->name('organization-setups.index');
//     Route::post('/', [OrganizationSetupController::class, 'store'])->name('organization-setups.store');
//     Route::get('/create', [OrganizationSetupController::class, 'create'])->name('organization-setups.create');
//     Route::get('/{setup}', [OrganizationSetupController::class, 'show'])->name('organization-setups.show');
//     Route::post('/{setup}', [OrganizationSetupController::class, 'update'])->name('organization-setups.update');
//     Route::get('/{setup}/edit', [OrganizationSetupController::class, 'edit'])->name('organization-setups.edit');
//     Route::post('/{setup}/delete', [OrganizationSetupController::class, 'destroy'])->name('organization-setups.destroy');

//     Route::post('/api/upload-image', [OrganizationSetupController::class, 'upload_image']);
// });