<?php

namespace App\Http\Requests;

use App\Constants\LanguagesConstant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreScientificArticleCitationRequest extends FormRequest
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
            'magazine_name' => 'string|required|max:255',
            'magazine_publish_date' => 'date|required',
            'article_title' => 'required|string|max:255',
            'article_language' => [
                'required',
                'string',
                Rule::in(LanguagesConstant::list())
            ],
            'link' => 'required|url',
            'citations_count' => 'integer|nullable|digits_between:1,7',
            'users' => 'array|nullable',
            'users.*' => 'exists:users,id',
            'magazine_checkbox' => ['nullable', 'string', 'regex:/^on$/']
        ];
    }
}
