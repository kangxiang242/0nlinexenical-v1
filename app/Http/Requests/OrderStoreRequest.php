<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'goods_id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'regex:/^09\d{8}$/'],
            'email' => ['required', 'email', 'max:255'],
            'order_type' => ['required', 'integer', 'in:0,1,2'],
            'city' => ['required', 'string', 'max:100'],
            'county' => ['required', 'string', 'max:100'],
            'street' => ['required', 'string', 'max:100'],
            'store_id' => ['required_if:order_type,1,2', 'nullable', 'string', 'max:100'],
            'address' => ['required_if:order_type,0', 'nullable', 'string', 'max:255'],
            'remarks' => ['nullable', 'string', 'max:1000'],
            'delivery_time' => ['nullable', 'string', 'max:50'],
            'form_token' => ['nullable', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'goods_id.required' => '商品數據有誤',
            'name.required' => '請填寫收件人姓名',
            'phone.required' => '請填寫收件人聯絡電話',
            'phone.regex' => '請填寫正確的聯絡電話',
            'email.required' => '請填寫收件人郵箱',
            'email.email' => '請填寫正確的郵箱',
            'order_type.required' => '請選擇配送方式',
            'city.required' => '請選擇縣市',
            'county.required' => '請選擇地區',
            'street.required' => '請選擇路段',
            'store_id.required_if' => '請選擇便利店',
            'address.required_if' => '請填寫詳細地址',
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
