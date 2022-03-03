<?php


namespace App\Spatie\Sorts;


use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Sorts\Sort;

class MagazineSorts implements Sort
{

    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';
        $query->select("{$property}.*")
            ->join('magazines', "{$property}.magazine_id", '=', 'magazines.id')
            ->orderBy('title', $direction);
    }
}
