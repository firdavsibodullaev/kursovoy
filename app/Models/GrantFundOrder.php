<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsTo;

/** @property-read User $user */
class GrantFundOrder extends BaseModel
{
    protected $fillable = [
        'name',
        'price',
        'full_price',
        'year',
        'user_id'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
