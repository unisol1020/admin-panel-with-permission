<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ResellerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'] , function () {
    Route::post('register', [AuthController::class , 'register']);
    Route::post('login', [AuthController::class , 'login']);
    Route::post('logout', [AuthController::class , 'logout'])->middleware('auth:api');

    Route::group(['middleware' => ['auth:api' , 'permission']] , function () {

/***********************************************************************************************************************
        Please note that you need to specify the correct entity name it is needed to verify the user's access rights.
        And also specify the correct method which the user is going to execute on this route.
        Methods that the user can execute ['index' , 'store' , 'show' , 'update' , 'destroy'].
        And also if you have developed not a resource method then specify through a point what exactly it executes.
        For example:
            Route::get('reseller/{id}/hash', [ResellerController::class, 'getHashes'])->name('reseller_hash.show');


        If you added a new route with new entities please put into EntitiesEnum $enum a new string with entities name for
        permissions if it is not only for admin.
***********************************************************************************************************************/

        //For any roles
        Route::resource('user' , 'UserController');
        Route::resource('reseller', 'ResellerController');
        Route::resource('role', 'RoleController');

        Route::get('reseller/{reseller_id}/hash', [ResellerController::class, 'getHashes'])->name('reseller_hash.index');
        Route::post('reseller/{reseller_id}/hash', [ResellerController::class, 'storeHash'])->name('reseller_hash.store');
        Route::delete('reseller/{reseller_id}/hash/{id}', [ResellerController::class, 'destroyHash'])->name('reseller_hash.destroy');

        //Only for Admin
        Route::resource('hostname', 'HostnameController');
    });
});
