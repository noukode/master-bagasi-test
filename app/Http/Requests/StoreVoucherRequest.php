<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVoucherRequest extends FormRequest
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
            'name' => 'required',
            'desc' => 'nullable',
            'type' => 'required|in:discount_percentage,discount_price',
            'code' => 'required|unique:vouchers,code',
            'tgl_mulai_berlaku' => 'required',
            'tgl_akhir_berlaku' => 'required',
        ];
    }
}
