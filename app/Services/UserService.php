<?php

namespace App\Services;

use App\Models\User;
use App\Spatie\Filters\UserFilter;
use App\Spatie\Sorts\UserSorts;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    /**
     * @return LengthAwarePaginator
     */
    public function fetchWithPagination(): LengthAwarePaginator
    {
        return QueryBuilder::for(User::with(['faculty', 'department']))
            ->defaultSort('id')
            ->allowedFilters([
                AllowedFilter::custom('full_name', new UserFilter)
            ])
            ->allowedSorts([
                AllowedSort::custom('full_name', new UserSorts(), 'full_name'),
                'id'
            ])
            ->paginate()->withQueryString();
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return QueryBuilder::for(User::with(['faculty', 'department']))
            ->defaultSort('id')
            ->allowedFilters([
                AllowedFilter::custom('full_name', new UserFilter)
            ])->get();
    }

    /**
     * @param array $validated
     * @return Builder|Model
     */
    public function create(array $validated)
    {
        return User::query()->create($validated)->load(['faculty', 'department']);
    }

    /**
     * @param User $user
     * @param array $validated
     * @return mixed
     */
    public function update(User $user, array $validated)
    {
        return tap($user)->update($validated)->load(['faculty', 'department']);
    }

    public function delete(User $user)
    {
        $user->delete();
    }

    public function getPosts()
    {
        return Role::query()->orderBy('id')->get();
    }
}
