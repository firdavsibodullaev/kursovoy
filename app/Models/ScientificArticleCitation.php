<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ScientificArticleCitation extends BaseModel
{
    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'scientific_article_citation_user',
            'scientific_article_citation_id',
            'user_id'
        );
    }

    /**
     * @return HasOne
     */
    public function journal(): HasOne
    {
        return $this->hasOne(Journal::class, 'id', 'journal_id');
    }
}
