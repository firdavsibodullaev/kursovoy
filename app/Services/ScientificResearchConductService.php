<?php

namespace App\Services;

use App\Models\ScientificResearchConduct;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class ScientificResearchConductService
 * @package App\Services
 */
class ScientificResearchConductService
{
    /**
     * @return LengthAwarePaginator
     */
    public function fetchWithPagination(): LengthAwarePaginator
    {
        return QueryBuilder::for(ScientificResearchConduct::class)
            ->allowedSorts('year', 'name', 'id')
            ->defaultSort('-year')
            ->paginate()
            ->withQueryString();
    }

    /**
     * @param array $validated
     * @return Model
     */
    public function create(array $validated): Model
    {
        return ScientificResearchConduct::query()->create($validated);
    }

    /**
     * @param ScientificResearchConduct $fundOrder
     * @param array $validated
     * @return ScientificResearchConduct
     */
    public function update(ScientificResearchConduct $fundOrder, array $validated): ScientificResearchConduct
    {
        return tap($fundOrder)->update($validated);
    }

    /**
     * @param ScientificResearchConduct $fundOrder
     * @return bool|null
     */
    public function delete(ScientificResearchConduct $fundOrder): ?bool
    {
        return $fundOrder->delete();
    }
}
