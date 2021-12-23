<?php


namespace App\Spatie\Sorts;


use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Sorts\Sort;

class DScDoctorDefaultSorts implements Sort
{

    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';
        $query->select('d_sc_doctors.*')
            ->join('users', 'd_sc_doctors.user_id', '=', 'users.id')
            ->orderBy('users.last_name', $direction)
            ->orderBy('users.first_name', $direction)
            ->orderBy('users.patronymic', $direction);
    }
}
