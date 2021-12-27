<?php


namespace App\Spatie\Sorts;


use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Sorts\Sort;

class DScDoctorDefaultSorts implements Sort
{

    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';
        $query
            ->orderBy('user->last_name', $direction)
            ->orderBy('user->first_name', $direction)
            ->orderBy('user->patronymic', $direction);
    }
}
