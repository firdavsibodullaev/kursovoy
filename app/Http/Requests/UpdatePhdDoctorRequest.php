<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhdDoctorRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'patronymic' => 'required|string|max:255',
            'diploma_series' => [
                'required_without_all:professor_without_science_degree_series,professor_without_science_degree_number',
                'nullable',
                'integer',
                'min:1',
                'digits_between:1,4'
            ],
            'diploma_number' => [
                'required_without_all:professor_without_science_degree_series,professor_without_science_degree_number',
                'nullable',
                'integer',
                'min:1',
                'digits_between:1,8'
            ],
            'professor_without_science_degree_series' => [
                'required_without_all:diploma_series,diploma_number',
                'nullable',
                'integer',
                'min:1',
                'digits_between:1,4'
            ],
            'professor_without_science_degree_number' => [
                'required_without_all:diploma_series,diploma_number',
                'nullable',
                'integer',
                'min:1',
                'digits_between:1,8'
            ],
            'speciality_name' => 'required|string|max:255',
            'employee_order' => 'string|required|max:255',
            'employee_date' => 'date|required',
        ];
    }
}
