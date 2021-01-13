<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$httpControllerNamespace = "App\Http\Controllers";

Route::prefix('v1')->group(function () use ($httpControllerNamespace) {
    Route::prefix('reminder')
        ->namespace($httpControllerNamespace)
        ->middleware('auth:api')
        ->group(function () {
            Route::post('', 'ReminderController@store');
            Route::delete('{reminder}', 'ReminderController@destroy');
            Route::patch('{reminder}/resolve', 'ReminderController@check');
            Route::get('filter', 'ReminderController@filter');
            Route::get('list', 'ReminderController@listReminders');
        });
});

