<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Services\CurrencyService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CurrencyRequest;

class CurrencyController extends Controller
{
    public function __construct(public CurrencyService $currencyService) {

    }

    public function getCurrencyRates(CurrencyRequest $request): JsonResponse
    {
        try {
            $date = $request->query('date', now()->toDateString());
            $rates = $this->currencyService->getCurrencyRates($date);

            return jsonResponse($rates, "Uğurlu əməliyyat!", 200);
        } catch (Exception $e) {
            return jsonResponse([], $e->getMessage(), 400);
        }
    }
}
