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
   

    Route::prefix('general-settings')->group(function () {
        Route::get('/', [GeneralSettingsController::class, 'index'])->name('general-settings.index');
        Route::post('/', [GeneralSettingsController::class, 'store'])->name('general-settings.store');
        Route::get('/create', [GeneralSettingsController::class, 'create'])->name('general-settings.create');
        Route::get('/{setup}', [GeneralSettingsController::class, 'show'])->name('general-settings.show');
        Route::post('/{setup}/update', [GeneralSettingsController::class, 'update'])->name('general-settings.update');
        Route::get('/{setup}/edit', [GeneralSettingsController::class, 'edit'])->name('general-settings.edit');
        Route::delete('/{setup}/delete', [GeneralSettingsController::class, 'destroy'])->name('general-settings.destroy');

        Route::post('/api/upload-image', [GeneralSettingsController::class, 'upload_image']);
    });

});