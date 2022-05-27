<?php

namespace App\Services;

use App\Constants\MediaCollectionsConstant;
use App\Models\ObtainedIndustrialSamplePatent;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class ObtainedIndustrialSamplePatentService
 * @package App\Services
 */
class ObtainedIndustrialSamplePatentService
{
    /**
     * @return LengthAwarePaginator
     */
    public function fetchWithPagination(): LengthAwarePaginator
    {
        return QueryBuilder::for(ObtainedIndustrialSamplePatent::with(['users', 'institute', 'file']))
            ->orderByDesc('date')
            ->where('is_confirmed', '=', true)
            ->paginate()
            ->withQueryString();
    }

    /**
     * @return Collection
     */
    public function getNotConfirmedArticlesList()
    {
        return ObtainedIndustrialSamplePatent::query()->orderByDesc('id')
            ->where('is_confirmed', '=', false)
            ->get();
    }

    /**
     * @param array $validated
     * @return ObtainedIndustrialSamplePatent
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function create(array $validated): ObtainedIndustrialSamplePatent
    {
//        $institute = (new ListService())->getInstituteByName($validated['institute_name']);
//
//        $validated['institute_id'] = $institute->id;

        /** @var ObtainedIndustrialSamplePatent $patent */
        $patent = ObtainedIndustrialSamplePatent::query()->create($validated);

        $patent->users()->sync($validated['users']);

        $patent->addMedia($validated['file'])->toMediaCollection(MediaCollectionsConstant::PATENT);

        return $patent->load(['users', 'institute']);
    }

    /**
     * @param ObtainedIndustrialSamplePatent $patent
     * @param array $validated
     * @return ObtainedIndustrialSamplePatent
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(ObtainedIndustrialSamplePatent $patent, array $validated): ObtainedIndustrialSamplePatent
    {
//        $institute = (new ListService())->getInstituteByName($validated['institute_name']);
//
//        $validated['institute_id'] = $institute->id;

        /** @var ObtainedIndustrialSamplePatent $patent */
        $patent = tap($patent)->update($validated);

        $patent->users()->sync($validated['users']);

        if (isset($validated['file'])) {
            $patent->getFirstMedia(MediaCollectionsConstant::PATENT)->delete();
            $patent->addMedia($validated['file'])->toMediaCollection(MediaCollectionsConstant::PATENT);
        }

        return $patent->load(['users', 'institute']);
    }

    public function confirm(ObtainedIndustrialSamplePatent $patent)
    {
        $patent->update([
            'is_confirmed' => true,
            'confirmed_at' => now()
        ]);
    }

    /**
     * @param ObtainedIndustrialSamplePatent $patent
     * @return bool|null
     */
    public function destroy(ObtainedIndustrialSamplePatent $patent): ?bool
    {
        return $patent->delete();
    }
}
