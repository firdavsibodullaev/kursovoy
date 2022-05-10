<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ObtainedIndustrialSamplePatentRequest extends FormRequest
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
            'institute_name' => 'required|string|max:190',
            'name' => 'string|required|max:255',
            'date' => 'date|required',
            'number' => 'required|string|max:15',
            'users' => 'array|required',
            'users.*' => 'required|exists:users,id'
        ];
    }
}
