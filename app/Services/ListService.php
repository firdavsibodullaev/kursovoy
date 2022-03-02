<?php

namespace App\Services;

use App\Models\Country;
use App\Models\Magazine;
use App\Models\ScientificArticle;
use Illuminate\Database\Eloquent\Builder;
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
     * @return Collection|QueryBuilder[]
     */
    public function getMagazinesList()
    {
        return QueryBuilder::for(Magazine::class)->get();
    }


    /**
     * @param string $magazine
     * @return Builder|Model
     */
    public function getMagazineByTitle(string $magazine)
    {
        return Magazine::query()->firstOrCreate([
            'title' => $magazine
        ]);
    }

    /**
     * @param string $country
     * @return Builder|Model
     */
    public function getCountryByName(string $country)
    {
        return Country::query()->firstOrCreate([
            'name' => $country
        ]);
    }
}
