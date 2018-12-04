<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

// forgot password
Route::get('/passwords/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('passwords.request');
Route::post('/passwords/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('passwords.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset/{token}', 'Auth\ResetPasswordController@reset')->name('password.resetok');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/reservation/mybooking', 'ReservationsController@show')->name('reservation.show');
});

// middleware group role:admin
Route::group(['middleware' => ['role:admin']], function () {
    //rooms
    Route::delete('/rooms/{id}', 'RoomsController@delete')->name('rooms.delete');
    Route::get('/rooms/add', 'RoomsController@add')->name('rooms.add');
    Route::get('/rooms/edit/{id}', 'RoomsController@edit')->name('rooms.edit');
    Route::put('/rooms/{id}', 'RoomsController@update')->name('rooms.update');
    Route::post('/rooms', 'RoomsController@store')->name('rooms.store');
    Route::get('/rooms', 'RoomsController@index')->name('rooms.index');

    Route::get('/rooms/trash', 'RoomsController@trash')->name('rooms.trash');
    Route::get('/rooms/restore/{id}', 'RoomsController@restore')->name('rooms.restore');
    Route::get('/rooms/perma_del/{id}', 'RoomsController@perma_del')->name('rooms.perma_del');
    // Route::get('/rooms/massDestroy', 'RoomsController@massDestroy')->name('rooms.mass_destroy');

    //area
    Route::get('/areas', 'AreasController@index')->name('areas.index');
    Route::get('/areas/add', 'AreasController@add')->name('areas.add');
    Route::post('/areas', 'AreasController@store')->name('areas.store');
    Route::get('/areas/edit/{id}', 'AreasController@edit')->name('areas.edit');
    Route::put('/areas/{id}', 'AreasController@update')->name('areas.update');
    Route::delete('/areas/{id}', 'AreasController@delete')->name('areas.delete');

    Route::get('/areas/trash', 'AreasController@trash')->name('areas.trash');
    Route::get('/areas/restore/{id}', 'AreasController@restore')->name('areas.restore');
    Route::get('/areas/perma_del/{id}', 'AreasController@perma_del')->name('areas.perma_del');
    // Route::get('/areas/massDestroy', 'AreasController@massDestroy')->name('areas.mass_destroy');

    //user
    Route::get('/users', 'UsersController@index')->name('users.index');
    Route::get('/users/add', 'UsersController@create')->name('users.create');
    Route::post('/users', 'UsersController@store')->name('users.store');
    Route::get('/users/edit/{id}', 'UsersController@edit')->name('users.edit');
    Route::put('/users/{id}', 'UsersController@update')->name('users.update');
    Route::delete('/users/{id}', 'UsersController@destroy')->name('users.destroy');

    //units
    Route::get('/units', 'UnitsController@index')->name('units.index');
    Route::post('/units', 'UnitsController@store')->name('units.store');
    Route::delete('/units/{id}', 'UnitsController@delete')->name('units.delete');
    Route::get('/units/edit/{id}', 'UnitsController@edit')->name('units.edit');
    Route::put('/units/{id}', 'UnitsController@update')->name('units.update');
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

    Route::get('/units/trash', 'UnitsController@trash')->name('units.trash');
    Route::get('/units/restore/{id}', 'UnitsController@restore')->name('units.restore');
    Route::get('/units/perma_del/{id}', 'UnitsController@perma_del')->name('units.perma_del');
    // Route::get('/units/massDestroy', 'UnitsController@massDestroy')->name('units.mass_destroy');

    // roles
    Route::get('/roles', 'RolesController@index')->name('roles.index');
    Route::get('/roles/add', 'RolesController@add')->name('roles.add');
    Route::post('/roles', 'RolesController@store')->name('roles.store');
    Route::delete('/roles/{id}', 'RolesController@delete')->name('roles.delete');
    Route::get('/roles/edit/{id}', 'RolesController@edit')->name('roles.edit');
    Route::put('/roles/{id}', 'RolesController@update')->name('roles.update');

    // permissions
    Route::get('/permissions', 'PermissionsController@index')->name('permissions.index');
    Route::get('/permissions/add', 'PermissionsController@add')->name('permissions.add');
    Route::post('/permissions', 'PermissionsController@store')->name('permissions.store');
    Route::delete('/permissions/{id}', 'PermissionsController@delete')->name('permissions.delete');
    Route::get('/permissions/edit/{id}', 'PermissionsController@edit')->name('permissions.edit');
    Route::put('/permissions/{id}', 'PermissionsController@update')->name('permissions.update');

    // reservations
    Route::get('/reservation', 'ReservationsController@index')->name('reservation.index');
    Route::get('/reservation/addSchedule', 'ReservationsController@addSchedule')->name('reservation.addSchedule');
    Route::post('/reservation/storeSchedule', 'ReservationsController@storeSchedule')->name('reservation.store');

    //facilities
    Route::get('/facilities', 'FacilitiesController@index')->name('facilities.index');
    Route::get('/facilities/add', 'FacilitiesController@add')->name('facilities.add');
    Route::post('/facilities', 'FacilitiesController@store')->name('facilities.store');
    Route::put('/facilities/{id}', 'FacilitiesController@facilityupdate')->name('facilities.update');
    Route::delete('/facilities/{id}', 'FacilitiesController@facilitydelete')->name('facilities.delete');
    Route::get('/facilities/edit/{id}', 'FacilitiesController@edit')->name('facilities.edit');

    // reservations
    Route::group(['middleware' => ['role:employee']], function () {
        Route::get('/reservation/addrequest/area/{idArea}/room/{idRoom}', 'ReservationsController@addrequest')->name('reservation.addrequest');
    });

    Route::post('/reservation', 'ReservationsController@storerequest')->name('reservation.storerequest');
    Route::get('/reservation/area', 'ReservationsController@reservationArea')->name('reservation.reservationArea');
    Route::get('/reservation/area/{idArea}', 'ReservationsController@reservationRoom')->name('reservation.room');
    Route::get('/reservation/area/{idArea}/room/{idRoom}', 'ReservationsController@reservationCalendar') ->name('reservation.calendar');
    Route::get('/reservation/detail/{id}', 'ReservationsController@detail')->name('reservation.detail');
    Route::get('/calendar', 'ReservationsController@calendar')->name('calendar.calendar');
    Route::post('/reservation/mybooking/{id}', 'ReservationsController@cancel')->name('reservation.cancel');
    Route::get('/search', 'ReservationsController@search');

    Route::get('/reservation/approve/{id}', ['middleware'=>['role:admin'], 'uses' => 'ReservationsController@update'])->name('reservation.update');
    Route::get('/reservation/{id}', ['middleware'=>['role:admin'], 'uses' => 'ReservationsController@reject'])->name('reservation.reject');

    //change password
    Route::get('password', 'Auth\ChangePasswordController@index')->name('password.index');
    Route::post('password', 'Auth\ChangePasswordController@update')->name('password.update');
    //update profile
    Route::put('/users/profile/{id}', 'UsersController@updateProfile')->name('users.updateProfile');
    Route::get('users/profile/{id}', 'UsersController@editProfile')->name('users.editProfile');
    // AJAX
    Route::get('ajax/rooms/by-area', 'RoomsController@getByAreaId')->name('ajax.rooms.byarea');
    Route::get('ajax/reservation/get-attend', 'ReservationsController@getAttend');
    Route::get('ajax/reservation/getting-attendence', 'ReservationsController@getAttend');
    Route::get('ajax/reservations/notif', 'ReservationsController@notification')->name('ajax.notif');
});
