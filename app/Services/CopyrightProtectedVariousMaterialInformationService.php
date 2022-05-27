<?php

namespace App\Services;

use App\Constants\MediaCollectionsConstant;
use App\Models\CopyrightProtectedVariousMaterialInformation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class CopyrightProtectedVariousMaterialInformationService
 * @package App\Services
 */
class CopyrightProtectedVariousMaterialInformationService
{
    public function fetchWithPagination(): LengthAwarePaginator
    {
        return QueryBuilder::for(CopyrightProtectedVariousMaterialInformation::with(['institute', 'user', 'file']))
            ->where('is_confirmed', '=', true)
            ->paginate();
    }

    /**
     * @return Collection
     */
    public function getNotConfirmedArticlesList(): Collection
    {
        return CopyrightProtectedVariousMaterialInformation::query()->with(['institute', 'user', 'file'])
            ->where('is_confirmed', '=', false)
            ->get();
    }

    /**
     * @param array $validated
     * @return CopyrightProtectedVariousMaterialInformation
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function create(array $validated): CopyrightProtectedVariousMaterialInformation
    {
//        $institute = (new ListService())->getInstituteByName($validated['institute_name']);
//        $validated['institute_id'] = $institute->id;

        /** @var CopyrightProtectedVariousMaterialInformation $copyright */
        $copyright = CopyrightProtectedVariousMaterialInformation::query()->create($validated)->load(['user', 'institute']);
        $copyright->addMedia($validated['file'])->toMediaCollection(MediaCollectionsConstant::COPYRIGHT);
        return $copyright;
    }

    /**
     * @param CopyrightProtectedVariousMaterialInformation $information
     * @param array $validated
     * @return CopyrightProtectedVariousMaterialInformation
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(CopyrightProtectedVariousMaterialInformation $information, array $validated): CopyrightProtectedVariousMaterialInformation
    {
//        $institute = (new ListService())->getInstituteByName($validated['institute_name']);
//        $validated['institute_id'] = $institute->id;
        /** @var CopyrightProtectedVariousMaterialInformation $copyright */
        $copyright = tap($information)->update($validated)->load(['institute', 'user']);

        if (isset($validated['file'])) {
            $copyright->getFirstMedia(MediaCollectionsConstant::COPYRIGHT)->delete();
            $copyright->addMedia($validated['file'])->toMediaCollection(MediaCollectionsConstant::COPYRIGHT);
        }
        return $copyright;
    }

    /**
     * @param CopyrightProtectedVariousMaterialInformation $information
     * @return bool
     */
    public function confirm(CopyrightProtectedVariousMaterialInformation $information): bool
    {
        return $information->update([
            'is_confirmed' => true,
            'confirmed_at' => now()
        ]);
    }

    /**
     * @param CopyrightProtectedVariousMaterialInformation $information
     * @return bool|null
     */
    public function delete(CopyrightProtectedVariousMaterialInformation $information): ?bool
    {
        return $information->delete();
    }
}
