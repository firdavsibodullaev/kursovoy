<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ScientificArticleCitation extends BaseModel
{
    protected $fillable = [
        'magazine_id',
        'magazine_publish_date',
        'article_title',
        'article_language',
        'link',
        'citations_count',
        'is_confirmed'
    ];
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
    public function magazine(): HasOne
    {
        return $this->hasOne(Magazine::class, 'id', 'magazine_id');
    }
}
