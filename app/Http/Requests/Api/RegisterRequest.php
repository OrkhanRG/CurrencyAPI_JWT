<?php

namespace App\Http\Requests\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            "name"              => ["required", "string", "max:255"],
            "email"             => ["required", "string", "email", "unique:users"],
            "password"          => ["required", Password::min(8)->letters()->mixedCase()->symbols()],
            "password_confirm"  => ["required", "same:password"]
        ];
    }

    public function messages(): array {
        return [
            "name.required"         => "Ad sahəsi vacibdir",
             "name.string"           => "Ad sahəsinə yalnız mətn tipli simvollar daxil olunmalıdır",
             "name.max"              => "Ad sahəsi maksimum 255 simvol olmalıdır",
             "email.required"        => "Ad sahəsi vacibdir",
             "email.string"          => "E-mail sahəsinə yalnız mətn tipli simvollar daxil olunmalıdır",
             "email.email"           => "Keçərli email daxil olunmayıb!",
             "email.unique"          => "Bu e-mail ilə daha əvvəl qeydiyyat olunub",
             "password.required"     => "Şifrə sahəsi vacibdir.",
             "password.min"          => "Şifrə ən azı 8 simvoldan ibarət olmalıdır.",
             "password.letters"      => "Şifrə ən azı bir hərf içerməlidir.",
             "password.mixedCase"    => "Şifrə ən azı bir böyük və bir kiçik hərf içerməlidir.",
             "password.symbols"      => "Şifrə ən azı bir xüsusi simvol içerməlidir.",
             "password_confirm.same" => "Şifrələr bir-birinə uyğun olmalıdır."
         ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            jsonResponse($validator->errors(), "Yanlış formatda daxil olunmuş parametr", 422)
        );
    }
}
