<?php
/**
 * Provides shared functionality for all couriers, such as sending HTTP requests and logging.
 */

namespace App\Services;

use App\Contracts\CourierInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DeliveryFailureNotification;

abstract class BaseCourier implements CourierInterface
{
    protected $url;
    protected $senderAddress;

    public function __construct()
    {
        $courierConfig = Config::get("services." . $this->getCourierName());
        $this->url = $courierConfig['url'];
        $this->senderAddress = $courierConfig['sender_address'];
    }

    // This method using for each courier class to return the name of the courier.
    abstract protected function getCourierName(): string;

    // Sends delivery data to the courier service, and also logs and handles failures.
    public function sendDeliveryData(array $data): bool
    {
        $payload = [
            'recipient_name'    => $data['full_name'],
            'phone_number'      => $data['phone_number'],
            'email'             => $data['email'],
            'sender_address'    => $this->senderAddress,
            'delivery_address'  => $data['address'],
        ];

        Log::info("Sending delivery data to {$this->url}", [
            'payload' => $payload,
            'courier' => $this->getCourierName(),
        ]);

        $response = retry(3, function () use ($payload) {
            return Http::post($this->url, $payload);
        }, 100);

        if ($response->successful()) {
            Log::info("Delivery data sent successfully", [
                'response' => $response->body(),
                'courier'  => $this->getCourierName(),
            ]);
            return true;
        } else {
            Log::error("Failed to send delivery data", [
                'payload'  => $payload,
                'response' => $response->body(),
                'courier'  => $this->getCourierName(),
                'status'   => $response->status(),
            ]);

            Notification::route('mail', config('services.admin_email'))
                ->notify(new DeliveryFailureNotification($payload, $response->body()));

            return false;
        }
    }
}
