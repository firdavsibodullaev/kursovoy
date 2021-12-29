<?php

namespace App\Models;


class PhdDoctor extends BaseModel
{
    protected $casts = [
        'user' => 'object',
        'diploma' => 'array',
        'professor_without_science_degree' => 'array',
        'employment' => 'array'
    ];
}
