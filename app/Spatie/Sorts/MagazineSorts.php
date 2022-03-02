<?php


namespace App\Spatie\Sorts;


use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Sorts\Sort;

class MagazineSorts implements Sort
{

    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $direction = $descending ? 'DESC' : 'ASC';
        $query->select('scientific_article_citations.*')
            ->join('journals', 'scientific_article_citations.journal_id', '=', 'journals.id')
            ->orderBy('title', $direction);
    }
}
