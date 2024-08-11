<?php
/**
 * The service class that handles the logic of sending delivery
 * data to the selected courier.
 */

namespace App\Services;

use Illuminate\Support\Facades\Log;
use App\Models\Parcel;
use App\Contracts\CourierInterface;

class DeliveryService
{
    protected $courier;

    public function __construct(CourierInterface $courier)
    {
        $this->courier = $courier;
    }

    public function sendDeliveryData(array $validated, CourierInterface $courier, Parcel $parcel): bool
    {
        try {
            // Send the delivery data using the selected courier
            $success = $courier->sendDeliveryData([
                'full_name'    => $validated['full_name'],
                'phone_number' => $validated['phone_number'],
                'email'        => $validated['email'],
                'address'      => $validated['address'],
                'width'        => $parcel->width,
                'height'       => $parcel->height,
                'length'       => $parcel->length,
                'weight'       => $parcel->weight,
            ]);

            return $success;
        } catch (\Exception $e) {
            // Log the detailed error
            Log::error('Error sending delivery data: ' . $e->getMessage(), [
                'payload'   => $validated,
                'exception' => $e,
            ]);
            throw $e;
        }
    }
}
