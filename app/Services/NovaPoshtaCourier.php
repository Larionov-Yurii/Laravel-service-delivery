<?php
/**
 * The class represents a specific courier (in this NovaPoshta courier )
 * and implements the necessary methods to send delivery data.
 */

namespace App\Services;

class NovaPoshtaCourier extends BaseCourier
{
    protected function getCourierName(): string
    {
        return 'novaposhta';
    }
}
