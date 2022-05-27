<?php


namespace App\Spatie\Filters;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class PhdDoctorUserFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $value = Str::lower($value);

        if (is_numeric($value)) {
            return $query->where('id', '=', $value);
        }

        $query->where(function ($q) use ($value) {
            $q->where(DB::raw("LOWER(JSON_EXTRACT_PATH_TEXT(phd_doctors.user, 'last_name'))"), 'like', "%{$value}%")
                ->orWhere(DB::raw("LOWER(JSON_EXTRACT_PATH_TEXT(phd_doctors.user, 'first_name'))"), 'like', "%{$value}%")
                ->orWhere(DB::raw("LOWER(JSON_EXTRACT_PATH_TEXT(phd_doctors.user, 'patronymic'))"), 'like', "%{$value}%");
        });
    }
}
