<?php

namespace App\Models;

/**
 * @property-read string $user_full_name
 * @property-read string $diploma_formatted
 * @property-read string $diploma_without_science_degree_formatted
 * @property-read string $employment_formatted
 */
class DScDoctor extends BaseModel
{
    protected $fillable = [
        'user',
        'diploma',
        'professor_without_science_degree',
        'speciality_name',
        'employment'
    ];
    protected $casts = [
        'user' => 'object',
        'diploma' => 'array',
        'professor_without_science_degree' => 'array',
        'employment' => 'array'
    ];

    /**
     * @return string
     */
    public function getUserFullNameAttribute(): string
    {
        return "{$this->user->last_name} {$this->user->first_name} {$this->user->patronymic}";
    }

    /**
     * @return string
     */
    public function getDiplomaFormattedAttribute(): string
    {
        if (is_null($this->diploma)) {
            return '';
        }
        return "{$this->diploma['series']}  {$this->diploma['number']}";
    }

    /**
     * @return string
     */
    public function getDiplomaWithoutScienceDegreeFormattedAttribute(): string
    {
        if (is_null($this->professor_without_science_degree)) {
            return '';
        }
        return "{$this->professor_without_science_degree['series']}  {$this->professor_without_science_degree['number']}";
    }

    /**
     * @return string
     */
    public function getEmploymentFormattedAttribute(): string
    {
        return "№ {$this->employment['order']} {$this->employment['date']}";
    }
}
