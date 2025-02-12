<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Services\AuthService;
use App\Services\CurrencyService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;

class AuthController extends Controller
{
    public function __construct(public AuthService $authService, public CurrencyService $currencyService) {

    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $responseData = $this->authService->register($data);

            return jsonResponse($responseData, 'Uğurlu əməliyyat!', 201);
        } catch (Exception $e) {
            return jsonResponse([], $e->getMessage(), 500);
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->validated();
            $responseData = $this->authService->login($credentials);

            return jsonResponse($responseData, 'Uğurlu giriş!', 200);
        } catch (Exception $e) {
            return jsonResponse([],  $e->getMessage(), 401);
        }
    }
}
