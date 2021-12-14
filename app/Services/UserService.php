<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
        return QueryBuilder::for(User::with(['faculty', 'department']))->paginate()->withQueryString();
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
}
