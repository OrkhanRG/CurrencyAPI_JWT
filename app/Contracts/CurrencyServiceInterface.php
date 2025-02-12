<?php

namespace App\Contracts;

interface CurrencyServiceInterface {
    public function getCurrencyRates(string $date): array;
}
