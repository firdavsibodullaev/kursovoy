<?php


namespace App\Spatie\Filters;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class UsersRelationFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $value = Str::lower($value);

        $query->whereHas('users', function (Builder $q) use ($value) {
            $q->where(DB::raw("LOWER(last_name)"), 'like', "%{$value}%")
                ->orWhere(DB::raw("LOWER(first_name)"), 'like', "%{$value}%")
                ->orWhere(DB::raw("LOWER(patronymic)"), 'like', "%{$value}%");
        });
    }
}
