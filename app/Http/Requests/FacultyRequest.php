<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacultyRequest extends FormRequest
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
            'full_name_uz' => 'string|required|max:100',
            'full_name_oz' => 'string|required|max:100',
            'full_name_ru' => 'string|required|max:100',
            'full_name_en' => 'string|required|max:100',
            'short_name_uz' => 'string|required|max:10',
            'short_name_oz' => 'string|required|max:10',
            'short_name_ru' => 'string|required|max:10',
            'short_name_en' => 'string|required|max:10',
        ];
    }
}
