<?php


namespace App\Spatie\Filters;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class UserFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $value = Str::lower($value);

        if (is_numeric($value)) {
            return $query->where('id', '=', $value);
        }

        $query->where(function ($q) use ($value) {
            $q->where(DB::raw("LOWER(last_name)"), 'like', "%{$value}%")
                ->orWhere(DB::raw("LOWER(first_name)"), 'like', "%{$value}%")
                ->orWhere(DB::raw("LOWER(patronymic)"), 'like', "%{$value}%");
        });
    }
}
