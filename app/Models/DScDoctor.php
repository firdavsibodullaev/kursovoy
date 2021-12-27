<?php

namespace App\Models;


class DScDoctor extends BaseModel
{
    protected $casts = [
        'user' => 'object',
        'diploma' => 'array',
        'professor_without_science_degree' => 'array',
        'employment' => 'array'
    ];
}
