<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ScientificArticleCitationUser extends Pivot
{
    protected $fillable = [
        'scientific_article_citation_id',
        'user_id'
    ];
}
