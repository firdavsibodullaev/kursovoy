<?php

namespace App\Services;

use App\Models\CopyrightProtectedVariousMaterialInformation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class CopyrightProtectedVariousMaterialInformationService
 * @package App\Services
 */
class CopyrightProtectedVariousMaterialInformationService
{
    public function fetchWithPagination(): LengthAwarePaginator
    {
        return QueryBuilder::for(CopyrightProtectedVariousMaterialInformation::with(['institute', 'user']))
            ->paginate();
    }

    /**
     * @param array $validated
     * @return Model
     */
    public function create(array $validated): Model
    {
        $institute = (new ListService())->getInstituteByName($validated['institute_name']);
        $validated['institute_id'] = $institute->id;

        return CopyrightProtectedVariousMaterialInformation::query()->create($validated)->load(['user', 'institute']);
    }

    /**
     * @param CopyrightProtectedVariousMaterialInformation $information
     * @param array $validated
     * @return CopyrightProtectedVariousMaterialInformation
     */
    public function update(CopyrightProtectedVariousMaterialInformation $information, array $validated): CopyrightProtectedVariousMaterialInformation
    {
        $institute = (new ListService())->getInstituteByName($validated['institute_name']);
        $validated['institute_id'] = $institute->id;

        return tap($information)->update($validated)->load(['institute', 'user']);
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
