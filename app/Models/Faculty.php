<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Faculty extends BaseModel
{
    use HasTranslations;

    public $translatable = ['short_name', 'full_name'];

    /**
     * @return HasMany
     */
    public function departments(): HasMany
    {
        return $this->hasMany(Department::class, 'faculty_id', 'id');
    }
}
