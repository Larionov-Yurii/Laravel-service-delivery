<?php
/**
 * Handles incoming delivery requests, validates the data, and interacts with
 * the DeliveryService to send the data to the appropriate courier.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Services\DeliveryService;
use App\Models\Recipient;
use App\Models\Parcel;

class DeliveryController extends Controller
{
    protected $deliveryService;

    public function __construct(DeliveryService $deliveryService)
    {
        $this->deliveryService = $deliveryService;
    }

    public function sendDeliveryData(Request $request)
    {
        // Validate the incoming request
        $validated = $request->all();

        // Courier class based on the request
        $courierClass = Config::get("services.courier_classes.{$validated['courier']}");

        if (!class_exists($courierClass)) {
            return response()->json(['message' => "Courier class for {$validated['courier']} does not exist."], 400);
        }

        // Instantiate the appropriate courier class
        $courier = new $courierClass();

        try {
            // Create recipient and parcel records
            $recipient = Recipient::create([
                'full_name' => $validated['full_name'],
                'phone_number' => $validated['phone_number'],
                'email' => $validated['email'],
                'address' => $validated['address'],
            ]);

            $parcel = Parcel::create([
                'recipient_id' => $recipient->id,
                'width' => $validated['width'],
                'height' => $validated['height'],
                'length' => $validated['length'],
                'weight' => $validated['weight'],
                'courier' => $validated['courier'],
            ]);

            // Send the delivery data using the selected courier
            $success = $this->deliveryService->sendDeliveryData($validated, $courier, $parcel);

            if ($success) {
                return response()->json(['message' => 'Data sent successfully'], 200);
            } else {
                return response()->json(['message' => 'Failed to send data'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }
}
