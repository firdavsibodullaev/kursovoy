<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Pivot;

class ScientificArticleUser extends Pivot
{
    protected $fillable = [
        'scientific_article_id',
        'user_id'
    ];
}
