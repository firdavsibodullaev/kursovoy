<?php

namespace App\Services;

use App\Models\ScientificResearchEffectiveness;
use App\Spatie\Filters\UsersRelationFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class ScientificResearchEffectivenessService
 * @package App\Services
 */
class ScientificResearchEffectivenessService
{
    /**
     * @return LengthAwarePaginator
     */
    public function fetchWithPagination(): LengthAwarePaginator
    {
        return QueryBuilder::for(ScientificResearchEffectiveness::with('users'))
            ->defaultSort('id')
            ->allowedFilters([
                AllowedFilter::custom('user', new UsersRelationFilter)
            ])
            ->paginate()
            ->withQueryString();
    }

    /**
     * @param array $validated
     * @return ScientificResearchEffectiveness
     */
    public function create(array $validated): ScientificResearchEffectiveness
    {
        /** @var ScientificResearchEffectiveness $effectiveness */
        $effectiveness = ScientificResearchEffectiveness::query()->create($validated);

        $effectiveness->users()->sync($validated['users']);

        return $effectiveness->load('users');
    }

    /**
     * @param ScientificResearchEffectiveness $effectiveness
     * @param array $validated
     * @return ScientificResearchEffectiveness
     */
    public function update(ScientificResearchEffectiveness $effectiveness, array $validated): ScientificResearchEffectiveness
    {
        /** @var ScientificResearchEffectiveness $effectiveness */
        $effectiveness = tap($effectiveness)->update($validated);

        $effectiveness->users()->sync($validated['users']);

        return $effectiveness->load('users');
    }

    /**
     * @param ScientificResearchEffectiveness $effectiveness
     * @return bool|null
     */
    public function delete(ScientificResearchEffectiveness $effectiveness): ?bool
    {
        return $effectiveness->delete();
    }
}
