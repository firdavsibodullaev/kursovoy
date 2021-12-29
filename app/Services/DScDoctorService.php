<?php

namespace App\Services;

use App\Models\DScDoctor;
use App\Spatie\Sorts\DScDoctorDefaultSorts;
use App\Traits\PreparingJsonDataForModels;
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
    use PreparingJsonDataForModels;
    /**
     * @return LengthAwarePaginator
     */
    public function fetchWithPagination(): LengthAwarePaginator
    {
        return QueryBuilder::for(DScDoctor::class)
            ->defaultSort(AllowedSort::custom('user', new DScDoctorDefaultSorts))
            ->allowedSorts([
                AllowedSort::custom('user', new DScDoctorDefaultSorts)
            ])
            ->paginate();
    }

    /**
     * @param array $validated
     * @return Builder|Model
     */
    public function create(array $validated)
    {
        $this->prepareData($validated);
        return DScDoctor::query()->create($validated);
    }

    /**
     * @param DScDoctor $doctor
     * @param array $validated
     * @return mixed
     */
    public function update(DScDoctor $doctor, array $validated)
    {
        $this->prepareData($validated);
        return tap($doctor)->update($validated);
    }

    /**
     * @param DScDoctor $doctor
     */
    public function delete(DScDoctor $doctor)
    {
        $doctor->delete();
    }
}
