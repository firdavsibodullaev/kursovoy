<?php

namespace App\Services;

use App\Constants\MediaCollectionsConstant;
use App\Models\ObtainedIndustrialSamplePatent;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
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
        /** @var User $user */
        $user = auth()->user();

        return QueryBuilder::for(ObtainedIndustrialSamplePatent::with(['users', 'institute', 'file']))
            ->orderByDesc('date')
            ->when(!is_super_admin(), function (Builder $query) use ($user) {
                $query->whereHas('users', function (Builder $query) use ($user) {
                    $query->where('obtained_industrial_sample_patent_users.user_id', '=', $user->id);
                });
            })
            ->where('is_confirmed', '=', true)
            ->paginate()
            ->withQueryString();
    }

    /**
     * @return Collection
     */
    public function getNotConfirmedArticlesList(): Collection
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

        if (is_super_admin()) {
            $patent->users()->sync($validated['users']);
        }

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
