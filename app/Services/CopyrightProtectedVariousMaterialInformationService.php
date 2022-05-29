<?php

namespace App\Services;

use App\Constants\MediaCollectionsConstant;
use App\Models\CopyrightProtectedVariousMaterialInformation;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
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
        /** @var User $user */
        $user = auth()->user();
        return QueryBuilder::for(CopyrightProtectedVariousMaterialInformation::with(['institute', 'users', 'file']))
            ->where('is_confirmed', '=', true)
            ->when(!is_super_admin(), function (Builder $query) use ($user) {
                $query->whereHas('users', function (Builder $query) use ($user) {
                    $query->where('copyright_protected_various_material_information_users.user_id', '=', $user->id);
                });
            })
            ->paginate();
    }

    /**
     * @return Collection
     */
    public function getNotConfirmedArticlesList(): Collection
    {
        return CopyrightProtectedVariousMaterialInformation::query()->with(['institute', 'users', 'file'])
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
        $copyright = CopyrightProtectedVariousMaterialInformation::query()->create($validated);

        $copyright->users()->sync($validated['users']);

        $copyright->addMedia($validated['file'])->toMediaCollection(MediaCollectionsConstant::COPYRIGHT);

        return $copyright->load(['users', 'institute', 'file']);
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
        $copyright = tap($information)->update($validated);

        if (is_super_admin()) {
            $copyright->users()->sync($validated['users']);
        }

        if (isset($validated['file'])) {
            $copyright->getFirstMedia(MediaCollectionsConstant::COPYRIGHT)->delete();
            $copyright->addMedia($validated['file'])->toMediaCollection(MediaCollectionsConstant::COPYRIGHT);
        }
        return $copyright->load(['institute', 'users', 'file']);
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
