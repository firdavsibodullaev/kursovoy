<?php

namespace App\Models;


class ObtainedIndustrialSamplePatentUser extends BaseModel
{
    protected $fillable = [
        'user_id',
        'obtained_industrial_sample_patent_id'
    ];

    protected $table = 'patent_users';
}
