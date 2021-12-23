<?php


namespace App\Spatie\Sorts;


use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Sorts\Sort;

class UserSorts implements Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';

        $query->orderBy('last_name', $direction)
            ->orderBy('first_name', $direction)
            ->orderBy('patronymic', $direction);
    }
}
