<?php

use Illuminate\Support\Facades\Route;
use Layout\Manager\Http\Controllers\Api\NavLocationController;
use Layout\Manager\Http\Controllers\Api\NavLocationHistoryController;
use Layout\Manager\Http\Controllers\Api\NavGroupController;
use Layout\Manager\Http\Controllers\Api\NavGroupHistoryController;
use Layout\Manager\Http\Controllers\Api\RoleController;
use Layout\Manager\Http\Controllers\Api\RoleHistoryController;
use Layout\Manager\Http\Controllers\Api\NavItemController;

use Layout\Manager\Http\Controllers\Api\NavItemHistoryController;

//use namespace

// $authorize = boolval(class_exists('Pondit\Authorize\Http\Middleware\CheckAuthorization')) ? 'authorize' : 'app-authorize';

Route::group(['middleware' => ['web', 'api', 'auth'], 'prefix' => 'api', 'as' => 'api.'], function () {
    Route::apiResource('nav-groups', NavGroupController::class);
    Route::apiResource('nav-items', NavItemController::class);
    Route::get('/get-nav-items-with-selected/{locationId}', [NavGroupController::class, 'getNavItemWithSelected']);
    // Route::get('/get-nav-groups-with-selected/{locationId}', [NavLocationController::class, 'getNavGroupWithSelected']);

    // Route::get('get-role-navitems-with-selected/{structureId}', [NavItemController::class, 'getnavitemWithSelected']);
    //Place your route here
});
