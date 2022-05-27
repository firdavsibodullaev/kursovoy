<?php

namespace App\Models;


use App\Constants\MediaCollectionsConstant;
use App\Traits\Users;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CopyrightProtectedVariousMaterialInformation extends BaseModel
{
    use Users;

    protected $fillable = [
//        'institute_id',
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
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'copyright_protected_various_material_information_users',
            'copyright_protected_various_material_information_id',
            'user_id'
        );
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
