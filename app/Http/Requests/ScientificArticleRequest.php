<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScientificArticleRequest extends FormRequest
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
            'title' => 'required|string|max:190',
            'publish_year' => 'required|digits:4|numeric|min:1900|max:' . (date('Y') + 1),
            'pages' => 'string|required|max:20',
            'link' => 'required|url',
            'magazine_name' => 'required|string|max:190',
            'country_name' => 'required|string|max:190',
            'users' => 'nullable|array',
            'users.*' => 'required|exists:users,id'
        ];
    }
}
