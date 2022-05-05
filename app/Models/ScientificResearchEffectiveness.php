<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ScientificResearchEffectiveness extends BaseModel
{
    protected $fillable = [
        'specialized_name',
        'specialized_code',
        'name',
        'accepted_report',
        'accepted_date',
        'publication_name',
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'scientific_research_effectiveness_users',
            'scientific_research_effectiveness_id',
            'user_id'
        );
    }
}
