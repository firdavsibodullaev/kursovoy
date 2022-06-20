<?php

namespace App\Models;


class CopyrightProtectedVariousMaterialInformationUser extends BaseModel
{
    protected $fillable = [
        'copyright_information_id',
        'user_id'
    ];

    protected $table = 'copyright_information_users';
}
