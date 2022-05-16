<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CopyrightProtectedVariousMaterialInformation extends BaseModel
{

    protected $fillable = [
        'institute_id',
        'user_id',
        'name',
        'date',
        'serial'
    ];

    /**
     * @return BelongsTo
     */
    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
