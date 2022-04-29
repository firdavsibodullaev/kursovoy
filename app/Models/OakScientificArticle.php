<?php

namespace App\Models;


use App\Traits\Users;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OakScientificArticle extends BaseModel
{
    use Users;

    protected $fillable = [
        'title',
        'publish_year',
        'pages',
        'link',
        'magazine_id',
        'is_confirmed'
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'oak_scientific_article_users');
    }

    /**
     * @return BelongsTo
     */
    public function magazine(): BelongsTo
    {
        return $this->belongsTo(Magazine::class);
    }
}
