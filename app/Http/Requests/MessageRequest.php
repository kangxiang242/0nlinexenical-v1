<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'regex:/^09\d{8}$/'],
            'email' => ['required', 'email', 'max:255'],
            'type' => ['nullable', 'integer', 'in:0,1,2,3,4,5'],
            'content' => ['required', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '請留下你的稱呼',
            'phone.required' => '請留下你的電話號碼',
            'phone.regex' => '請填寫正確的聯絡電話',
            'email.required' => '請留下你的電子郵箱',
            'email.email' => '請填寫正確的郵箱',
            'content.required' => '請填寫問題詳述',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $message = $validator->errors()->first();

        throw new HttpResponseException(response()->json([
            'code' => 400,
            'msg' => $message,
            'message' => $message,
        ], 400));
    }
}
