<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use App\Contracts\CurrencyServiceInterface;

class CurrencyService implements CurrencyServiceInterface {
    public function getCurrencyRates(string $date): array
{
    $cacheKey = "currency_rates_$date";

    $cachedRates = cache()->get($cacheKey);
    if ($cachedRates) {
        return $cachedRates;
    }

    $response = Http::get("https://www.cbar.az/currencies/{$date}.xml");

    if ($response->failed()) {
        throw new Exception("CBAR-a qoşulma mümkün olmadı.");
    }

    $xml  = simplexml_load_string($response->body());

    $data = json_decode(json_encode($xml), true);

    $rates = [];
    foreach ($data["ValType"][1]['Valute'] as $valute) {
        $rates[$valute['@attributes']['Code']] = $valute['Value'];
    }

    cache()->put($cacheKey, [
        'date' => $date,
        'rates' => $rates
    ], now()->addHour());

    return [
        'date' => $date,
        'rates' => $rates
    ];
}
}
