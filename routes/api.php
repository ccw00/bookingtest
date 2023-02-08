<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookingController;
use App\Http\Controllers\OccupancyRateController;
use App\Models\Booking;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('booking')->group(function () {
    Route::post('', [BookingController::class, 'store']);
    Route::put('{' . Booking::ROUTE_BINDING_ENTITY_NAME . '}', [BookingController::class, 'update']);
    Route::get('{offset?}/{limit?}', [BookingController::class, 'list']);
});

Route::get('daily-occupancy-rates/{date}', [OccupancyRateController::class, 'daily']);
Route::get('monthly-occupancy-rates/{date}', [OccupancyRateController::class, 'monthly']);
