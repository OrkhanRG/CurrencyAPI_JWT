<?php

use Illuminate\Http\JsonResponse;

if (!function_exists("jsonResponse")) {
    function jsonResponse($data = [], $message, $code = 404): JsonResponse {
        $response = [
            "code" => $code,
            "message" => $message,
        ];

        if (!!$data) {
            $response["data"] = $data;
        }

        return response()->json($response, $code);
    }
}
