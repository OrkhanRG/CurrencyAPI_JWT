<?php

namespace App\Services;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Contracts\AuthServiceInterface;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthService implements AuthServiceInterface {
    public function register(array $data): array
    {
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $token = JWTAuth::fromUser($user);

            return [
                'token' => $token
            ];

        } catch (Exception $e) {
            throw new Exception("Qeydiyyat zamanı xəta baş verdi: " . $e->getMessage());
        }
    }

    public function login(array $credentials): array
    {
        if (!$token = JWTAuth::attempt($credentials)) {
            throw new Exception("Yanlış e-mail ünvan və ya şifrə.");
        }

        return [
            'token' => $token
        ];
    }
}
