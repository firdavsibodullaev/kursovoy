<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CopyrightProtectedVariousMaterialInformationRequest extends FormRequest
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
//            'institute_name' => 'required|string|max:100',
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'serial' => 'required|string|max:15',
            'users' => $this->isMethod('post')
                ? 'required|array'
                : 'nullable|array',
            'users.*' => 'required|exists:users,id',
            'file' => $this->isMethod('post')
                ? 'required|file|mimes:pdf|max:' . (1024 * 10)
                : 'nullable|file|mimes:pdf|max:' . (1024 * 10)
        ];
    }
}
