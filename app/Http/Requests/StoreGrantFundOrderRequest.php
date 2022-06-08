<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGrantFundOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:10000000000000',
            'full_price' => 'required|numeric|min:0|max:10000000000000',
            'year' => ['required', 'string', 'regex:/^\d{4}$/', 'max:' . date('Y')],
            'user_id' => 'required|exists:users,id'
        ];
    }
}
