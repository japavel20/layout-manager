<?php

use Illuminate\Support\Facades\Route;
use Layout\Manager\Http\Controllers\NavGroupController;
use Layout\Manager\Http\Controllers\NavItemController;

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
});
