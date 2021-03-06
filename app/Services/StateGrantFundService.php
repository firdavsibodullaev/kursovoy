<?php

namespace App\Services;

use App\Models\StateGrantFund;
use App\Spatie\Filters\StateGrantFundFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class StateGrantFundService
 * @package App\Services
 */
class StateGrantFundService
{
    /**
     * @return LengthAwarePaginator
     */
    public function fetchWithPagination(): LengthAwarePaginator
    {
        return QueryBuilder::for(StateGrantFund::class)
            ->with('user')
            ->allowedSorts('year', 'name', 'id')
            ->defaultSort('-year')
            ->allowedFilters([
                AllowedFilter::custom('name', new StateGrantFundFilter)
            ])
            ->paginate()
            ->withQueryString();
    }

    /**
     * @param array $validated
     * @return Model
     */
    public function create(array $validated): Model
    {
        return StateGrantFund::query()->create($validated);
    }

    /**
     * @param StateGrantFund $fundOrder
     * @param array $validated
     * @return StateGrantFund
     */
    public function update(StateGrantFund $fundOrder, array $validated): StateGrantFund
    {
        return tap($fundOrder)->update($validated);
    }

    /**
     * @param StateGrantFund $fundOrder
     * @return bool|null
     */
    public function delete(StateGrantFund $fundOrder): ?bool
    {
        return $fundOrder->delete();
    }
}
