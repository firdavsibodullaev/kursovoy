<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\HasOne;

class DScDoctor extends BaseModel
{
    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
