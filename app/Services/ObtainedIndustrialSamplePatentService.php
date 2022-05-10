<?php

namespace App\Services;

use App\Models\ObtainedIndustrialSamplePatent;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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
        return QueryBuilder::for(ObtainedIndustrialSamplePatent::with(['users', 'institute']))
            ->orderByDesc('date')
            ->paginate()
            ->withQueryString();
    }

    /**
     * @param array $validated
     * @return ObtainedIndustrialSamplePatent
     */
    public function create(array $validated): ObtainedIndustrialSamplePatent
    {
        $institute = (new ListService())->getInstituteByName($validated['institute_name']);

        $validated['institute_id'] = $institute->id;

        /** @var ObtainedIndustrialSamplePatent $patent */
        $patent = ObtainedIndustrialSamplePatent::query()->create($validated);

        $patent->users()->sync($validated['users']);

        return $patent->load(['users', 'institute']);
    }

    /**
     * @param ObtainedIndustrialSamplePatent $patent
     * @param array $validated
     * @return ObtainedIndustrialSamplePatent
     */
    public function update(ObtainedIndustrialSamplePatent $patent, array $validated): ObtainedIndustrialSamplePatent
    {
        $institute = (new ListService())->getInstituteByName($validated['institute_name']);

        $validated['institute_id'] = $institute->id;

        /** @var ObtainedIndustrialSamplePatent $patent */
        $patent = tap($patent)->update($validated);

        $patent->users()->sync($validated['users']);

        return $patent->load(['users', 'institute']);
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
