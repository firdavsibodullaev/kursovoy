<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
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
            'username' => 'required|string|max:255|unique:users,username,NULL,id,deleted_at,NULL',
            'password' => 'required|string|max:255',
            'birthdate' => 'date|nullable',
            'phone' => [
                'nullable',
                'string',
                'max:13',
                'regex:/^\+998\d{9}$/',
                'unique:users,phone,NULL,id,deleted_at,NULL'
            ],
            'faculty_id' => 'exists:faculties,id|nullable',
            'department_id' => 'exists:departments,id|nullable',
            'post' => 'exists:roles,id',
            'email' => 'nullable|email|unique:users,email,NULL,id,deleted_at,NULL',
            'roles' => 'array|nullable',
            'roles.*' => 'exists:roles,id|required',
            'permissions' => 'array|nullable',
            'permissions.*' => 'exists:permissions,id|required',
        ];
    }
}
