<?php

namespace App\Models;


class ScientificResearchEffectivenessUser extends BaseModel
{
    protected $fillable = [
        'scientific_research_effectiveness_id',
        'user_id'
    ];

    protected $table = 'effectiveness_users';
}
