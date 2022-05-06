<?php

namespace App\Models;


use App\Traits\Users;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ScientificResearchEffectiveness extends BaseModel
{
    use Users;

    protected $fillable = [
        'specialized_name',
        'specialized_code',
        'name',
        'accepted_report',
        'accepted_date',
        'publication_id',
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

    public function publication(): BelongsTo
    {
        return $this->belongsTo(Publication::class, 'publication_id', 'id');
    }

    /**
     * @return string
     */
    public function getSpecializeAttribute(): string
    {
        return "{$this->specialized_code} {$this->specialized_name}";
    }

    /**
     * @return string
     */
    public function getAcceptAttribute(): string
    {
        return "({$this->accepted_date}) - {$this->accepted_report}";
    }
}
