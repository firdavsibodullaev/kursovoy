<?php

namespace App\Services;

use App\Models\PhdDoctor;
use App\Spatie\Sorts\DScDoctorDefaultSorts;
use App\Traits\PreparingJsonDataForModels;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class PhdDoctorService
 * @package App\Services
 */
class PhdDoctorService
{
    use PreparingJsonDataForModels;

    /**
     * @return LengthAwarePaginator
     */
    public function fetchWithPaginate(): LengthAwarePaginator
    {
        return QueryBuilder::for(PhdDoctor::class)
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
        return PhdDoctor::query()->create($validated);
    }

    public function update(PhdDoctor $doctor, array $validated)
    {
        $this->prepareData($validated);
        return tap($doctor)->update($validated);
    }


    /**
     * @param PhdDoctor $doctor
     */
    public function delete(PhdDoctor $doctor)
    {
        $doctor->delete();
    }
}
