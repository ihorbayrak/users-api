<?php

namespace App\Http\Requests;

use App\Exceptions\FailedValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    abstract public function rules(): array;

    protected function failedValidation(Validator $validator)
    {
        throw new FailedValidationException($validator->errors()->getMessages());
    }
}
