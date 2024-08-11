<?php
/**
 * Defines the API routes for the application.
 */

use App\Http\Controllers\DeliveryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route to get the authenticated user
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route to send delivery data with recipient and parcel validation
Route::post('/send-delivery-data', [DeliveryController::class, 'sendDeliveryData'])
    ->middleware(['validate.recipient', 'validate.parcel']);
