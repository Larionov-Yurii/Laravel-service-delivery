<?php
/**
 * Defines the contract for sending delivery data,
 * and any courier service will be implement this interface.
 */

namespace App\Contracts;

interface CourierInterface
{
    public function sendDeliveryData(array $data): bool;
}
