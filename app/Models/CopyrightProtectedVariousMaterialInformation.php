<?php

namespace App\Models;


use App\Constants\MediaCollectionsConstant;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CopyrightProtectedVariousMaterialInformation extends BaseModel
{

    protected $fillable = [
//        'institute_id',
        'user_id',
        'name',
        'date',
        'serial',
        'confirmed_at',
        'is_confirmed'
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

    /**
     * @return MorphOne
     */
    public function file(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')
            ->where('collection_name', '=', MediaCollectionsConstant::COPYRIGHT);
    }
}
