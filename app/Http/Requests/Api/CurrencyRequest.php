<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CurrencyRequest extends FormRequest
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
    public function rules():array
    {
        return [
            'date' => 'nullable|date_format:d.m.Y',
        ];
    }

    public function messages(): array
    {
        return [
            'date.date_format' => 'Tarix formatı DD.MM-YYYY şəklində olmalıdır!',
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            jsonResponse($validator->errors(), "Yanlış formatda daxil olunmuş parametr", 422)
        );
    }
}
