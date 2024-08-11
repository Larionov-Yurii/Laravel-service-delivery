<?php
/**
 * The class represents a specific courier (in this UkrPoshta courier )
 * and implements the necessary methods to send delivery data.
 */

namespace App\Services;

class UkrPoshtaCourier extends BaseCourier
{
    protected function getCourierName(): string
    {
        return 'ukrposhta';
    }
}
