<?php

namespace App\Models;


use App\Traits\Users;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ScientificArticle extends BaseModel
{
    use Users;

    protected $fillable = [
        'title',
        'publish_year',
        'pages',
        'link',
        'magazine_id',
        'country_id',
        'is_confirmed'
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'scientific_article_users');
    }

    /**
     * @return BelongsTo
     */
    public function magazine(): BelongsTo
    {
        return $this->belongsTo(Magazine::class);
    }

    /**
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
