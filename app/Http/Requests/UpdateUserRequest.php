<?php

namespace App\Http\Requests;

use App\Constants\UserRoles;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
        $user = $this->route('user');
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'patronymic' => 'required|string|max:255',
            'username' => "required|string|max:255|unique:users,username,{$user->id},id,deleted_at,NULL",
            'password' => [
                'nullable',
                'string',
                'max:255',
            ],
            'birthdate' => 'date|nullable',
            'phone' => [
                'nullable',
                'string',
                'max:13',
                'regex:/^\+998\d{9}$/',
                "unique:users,phone,{$user->id},id,deleted_at,NULL"
            ],
            'faculty_id' => 'exists:faculties,id|nullable',
            'department_id' => 'exists:departments,id|nullable',
            'post' => ['required', Rule::in(UserRoles::list())],
            'email' => "nullable|email|unique:users,email,{$user->id},id,deleted_at,NULL",
        ];
    }
}
