<?php

namespace App\Services;

use App\Models\DScDoctor;
use App\Spatie\Sorts\DScDoctorDefaultSorts;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class DScDoctorService
 * @package App\Services
 */
class DScDoctorService
{

    /**
     * @return LengthAwarePaginator
     */
    public function fetchWithPagination(): LengthAwarePaginator
    {
        return QueryBuilder::for(DScDoctor::with('user'))
            ->defaultSort(AllowedSort::custom('user_id', new DScDoctorDefaultSorts))
            ->paginate();
    }

    /**
     * @param array $validated
     * @return Builder|Model
     */
    public function create(array $validated)
    {
        $this->prepareData($validated);
        return DScDoctor::query()->create($validated)->load('user');
    }

    /**
     * @param DScDoctor $doctor
     * @param array $validated
     * @return mixed
     */
    public function update(DScDoctor $doctor, array $validated)
    {
        $this->prepareData($validated);
        return tap($doctor)->update($validated)->load('user');
    }

    /**
     * @param DScDoctor $doctor
     */
    public function delete(DScDoctor $doctor)
    {
        $doctor->delete();
    }

    /**
     * @param array $validated
     */
    protected function prepareData(array &$validated)
    {
        if (isset($validated['diploma_series'])) {
            $validated['diploma'] = json_encode([
                'series' => $validated['diploma_series'],
                'number' => $validated['diploma_number'],
            ]);
            $validated['professor_without_science_degree'] = null;
        }

        if (isset($validated['professor_without_science_degree_series'])) {
            $validated['diploma'] = null;

            $validated['professor_without_science_degree'] = json_encode([
                'series' => $validated['professor_without_science_degree_series'],
                'number' => $validated['professor_without_science_degree_number'],
            ]);
        }
        $validated['employment'] = json_encode([
            'order' => $validated['employee_order'],
            'date' => $validated['employee_date']
        ]);
        unset(
            $validated['diploma_series'],
            $validated['diploma_number'],
            $validated['professor_without_science_degree_number'],
            $validated['professor_without_science_degree_series'],
            $validated['employee_order'],
            $validated['employee_date']
        );
    }
}
