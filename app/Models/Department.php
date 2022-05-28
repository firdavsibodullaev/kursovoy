<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Translatable\HasTranslations;

class Department extends BaseModel
{
    use HasTranslations;

    protected $fillable = ['short_name', 'full_name', 'faculty_id'];

    public $translatable = ['short_name', 'full_name'];

    /**
     * @return HasOne
     */
    public function faculty(): HasOne
    {
        return $this->hasOne(Faculty::class, 'id', 'faculty_id');
    }

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'department_id');
    }
}
