<?php

namespace App\Contracts;

interface AuthServiceInterface {
    public function register (array $data): array;
    public function login (array $data): array;
}
