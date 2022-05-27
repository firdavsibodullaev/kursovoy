<?php


namespace App\Spatie\Filters;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class GrantFundOrderFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where(function (Builder $q) use ($value) {
            $value = Str::lower($value);
            if (is_numeric($value)) {
                $q->where('id', '=', $value);
            } else {
                $q->where('name', 'like', "%{$value}%");
            }
        });
    }
}
