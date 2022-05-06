<?php

namespace App\Services;

use App\Models\Country;
use App\Models\Magazine;
use App\Models\Publication;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * Class ListService
 * @package App\Services
 */
class ListService
{
    /**
     * @return Collection
     */
    public function getMagazinesList(): Collection
    {
        return QueryBuilder::for(Magazine::class)->get();
    }


    /**
     * @param string $magazine
     * @return Model
     */
    public function getMagazineByTitle(string $magazine): Model
    {
        return Magazine::query()->firstOrCreate([
            'title' => $magazine
        ]);
    }

    /**
     * @return Collection
     */
    public function getCountries(): Collection
    {
        return QueryBuilder::for(Country::class)->get();
    }

    /**
     * @param string $country
     * @return Model
     */
    public function getCountryByName(string $country): Model
    {
        return Country::query()->firstOrCreate([
            'name' => $country
        ]);
    }

    /**
     * @return Collection
     */
    public function getPublicationsList(): Collection
    {
        return QueryBuilder::for(Publication::class)->get();
    }

    /**
     * @param string $publication
     * @return Model
     */
    public function getPublicationByName(string $publication): Model
    {
        return Publication::query()->firstOrCreate([
            'title' => $publication
        ]);
    }
}
