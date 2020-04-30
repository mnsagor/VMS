<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Expence Histories
    Route::resource('expence-histories', 'ExpenceHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Maintanence Histories
    Route::resource('maintanence-histories', 'MaintanenceHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Drivers
    Route::delete('drivers/destroy', 'DriversController@massDestroy')->name('drivers.massDestroy');
    Route::post('drivers/media', 'DriversController@storeMedia')->name('drivers.storeMedia');
    Route::post('drivers/ckmedia', 'DriversController@storeCKEditorImages')->name('drivers.storeCKEditorImages');
    Route::resource('drivers', 'DriversController');

    // Vehicles
    Route::delete('vehicles/destroy', 'VehicleController@massDestroy')->name('vehicles.massDestroy');
    Route::post('vehicles/media', 'VehicleController@storeMedia')->name('vehicles.storeMedia');
    Route::post('vehicles/ckmedia', 'VehicleController@storeCKEditorImages')->name('vehicles.storeCKEditorImages');
    Route::resource('vehicles', 'VehicleController');

    // Vehicle Types
    Route::delete('vehicle-types/destroy', 'VehicleTypeController@massDestroy')->name('vehicle-types.massDestroy');
    Route::resource('vehicle-types', 'VehicleTypeController');

    // Requisition Requests
    Route::delete('requisition-requests/destroy', 'RequisitionRequestController@massDestroy')->name('requisition-requests.massDestroy');
    Route::post('requisition-requests/media', 'RequisitionRequestController@storeMedia')->name('requisition-requests.storeMedia');
    Route::post('requisition-requests/ckmedia', 'RequisitionRequestController@storeCKEditorImages')->name('requisition-requests.storeCKEditorImages');
    Route::resource('requisition-requests', 'RequisitionRequestController');

    // Expenses
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::post('expenses/media', 'ExpenseController@storeMedia')->name('expenses.storeMedia');
    Route::post('expenses/ckmedia', 'ExpenseController@storeCKEditorImages')->name('expenses.storeCKEditorImages');
    Route::resource('expenses', 'ExpenseController');

    // Divisions
    Route::delete('divisions/destroy', 'DivisionController@massDestroy')->name('divisions.massDestroy');
    Route::resource('divisions', 'DivisionController');

    // Organograms
    Route::delete('organograms/destroy', 'OrganogramController@massDestroy')->name('organograms.massDestroy');
    Route::resource('organograms', 'OrganogramController');

    // Driver Allocations
    Route::delete('driver-allocations/destroy', 'DriverAllocationController@massDestroy')->name('driver-allocations.massDestroy');
    Route::resource('driver-allocations', 'DriverAllocationController');

    // Vehicle Parts
    Route::delete('vehicle-parts/destroy', 'VehiclePartsController@massDestroy')->name('vehicle-parts.massDestroy');
    Route::resource('vehicle-parts', 'VehiclePartsController');

    // Fuels
    Route::delete('fuels/destroy', 'FuelController@massDestroy')->name('fuels.massDestroy');
    Route::resource('fuels', 'FuelController');

    // Employees
    Route::delete('employees/destroy', 'EmployeeController@massDestroy')->name('employees.massDestroy');
    Route::resource('employees', 'EmployeeController');

    // Vehicle Allocations
    Route::delete('vehicle-allocations/destroy', 'VehicleAllocationController@massDestroy')->name('vehicle-allocations.massDestroy');
    Route::resource('vehicle-allocations', 'VehicleAllocationController');

    // Expense Types
    Route::delete('expense-types/destroy', 'ExpenseTypeController@massDestroy')->name('expense-types.massDestroy');
    Route::resource('expense-types', 'ExpenseTypeController');

});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }

});
