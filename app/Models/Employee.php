<?php

namespace App\Models;


class Employee extends BaseModel
{
    protected $fillable = [
        'first_name',
        'last_name',
        'patronymic',
        'phone',
        'faculty_id',
        'department_id',
        'post'
    ];
}
