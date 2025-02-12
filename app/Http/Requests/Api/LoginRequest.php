<?php

namespace App\Http\Requests\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "email"             => ["required", "email"],
            "password"          => ["required"]
        ];
    }

    public function messages(): array {
        return [
            "email.required"        => "Ad sahəsi vacibdir",
            "email.email"           => "Keçərli email ünvanı daxil olunmayıb!",
            "password.required"     => "Şifrə sahəsi vacibdir.",
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            jsonResponse($validator->errors(), "Yanlış formatda daxil olunmuş parametr", 422)
        );
    }
}
