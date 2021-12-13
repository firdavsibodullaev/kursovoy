<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Department extends BaseModel
{
    use HasTranslations;

    public $translatable = ['short_name', 'full_name'];
}
