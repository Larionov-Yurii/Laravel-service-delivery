<?php
/**
 * The class represents a specific courier (in this Justin courier )
 * and implements the necessary methods to send delivery data.
 */

namespace App\Services;

class JustinCourier extends BaseCourier
{
    protected function getCourierName(): string
    {
        return 'justin';
    }
}
