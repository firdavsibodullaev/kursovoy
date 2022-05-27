<?php

namespace App\Services;

use App\Models\GrantFundOrder;
use App\Spatie\Filters\GrantFundOrderFilter;
use App\Spatie\Filters\UsersRelationFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class GrantFundOrderService
 * @package App\Services
 */
class GrantFundOrderService
{
    /**
     * @return LengthAwarePaginator
     */
    public function fetchWithPagination(): LengthAwarePaginator
    {
        return QueryBuilder::for(GrantFundOrder::class)
            ->allowedFilters([
                AllowedFilter::custom('name', new GrantFundOrderFilter)
            ])
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
        return GrantFundOrder::query()->create($validated);
    }

    /**
     * @param GrantFundOrder $fundOrder
     * @param array $validated
     * @return GrantFundOrder
     */
    public function update(GrantFundOrder $fundOrder, array $validated): GrantFundOrder
    {
        return tap($fundOrder)->update($validated);
    }

    /**
     * @param GrantFundOrder $fundOrder
     * @return bool|null
     */
    public function delete(GrantFundOrder $fundOrder): ?bool
    {
        return $fundOrder->delete();
    }
}
