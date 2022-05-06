<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScientificResearchEffectivenessRequest extends FormRequest
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
            'specialized_name' => 'required|string|max:190',
            'specialized_code' => 'required|string|max:10',
            'name' => 'required|string|max:190',
            'accepted_report' => 'required|string|max:190',
            'accepted_date' => 'required|date',
            'publication_name' => 'required|string|max:190',
            'users' => 'required|array',
            'users.*' => 'required|exists:users,id',
            'publication_checkbox' => ['nullable', 'string', 'regex:/^on$/']
        ];
    }
}
