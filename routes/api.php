<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Drivers
    Route::post('drivers/media', 'DriversApiController@storeMedia')->name('drivers.storeMedia');
    Route::apiResource('drivers', 'DriversApiController');

    // Vehicles
    Route::post('vehicles/media', 'VehicleApiController@storeMedia')->name('vehicles.storeMedia');
    Route::apiResource('vehicles', 'VehicleApiController');

    // Vehicle Types
    Route::apiResource('vehicle-types', 'VehicleTypeApiController');

    // Requisition Requests
    Route::post('requisition-requests/media', 'RequisitionRequestApiController@storeMedia')->name('requisition-requests.storeMedia');
    Route::apiResource('requisition-requests', 'RequisitionRequestApiController');

    // Expenses
    Route::post('expenses/media', 'ExpenseApiController@storeMedia')->name('expenses.storeMedia');
    Route::apiResource('expenses', 'ExpenseApiController');

    // Divisions
    Route::apiResource('divisions', 'DivisionApiController');

    // Organograms
    Route::apiResource('organograms', 'OrganogramApiController');

    // Driver Allocations
    Route::apiResource('driver-allocations', 'DriverAllocationApiController');

    // Vehicle Parts
    Route::apiResource('vehicle-parts', 'VehiclePartsApiController');

    // Fuels
    Route::apiResource('fuels', 'FuelApiController');

    // Employees
    Route::apiResource('employees', 'EmployeeApiController');

    // Vehicle Allocations
    Route::apiResource('vehicle-allocations', 'VehicleAllocationApiController');

    // Expense Types
    Route::apiResource('expense-types', 'ExpenseTypeApiController');

});
