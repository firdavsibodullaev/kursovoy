<?php

namespace App\Models;


use App\Constants\MediaCollectionsConstant;
use App\Traits\Users;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ObtainedIndustrialSamplePatent extends BaseModel
{
    use Users;

    protected $fillable = [
//        'institute_id',
        'name',
        'date',
        'number',
        'confirmed_at',
        'is_confirmed'
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'obtained_industrial_sample_patent_users',
            'obtained_industrial_sample_patent_id',
            'user_id'
        );
    }

    /**
     * @return BelongsTo
     */
    public function institute(): BelongsTo
    {
        return $this->belongsTo(Institute::class, 'institute_id', 'id');
    }

    /**
     * @return MorphOne
     */
    public function file(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')
            ->where(
                'collection_name',
                '='
                , MediaCollectionsConstant::PATENT);
    }
}
