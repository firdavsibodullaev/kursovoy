<?php

namespace App\Services;

use App\Models\Magazine;
use Illuminate\Database\Eloquent\Collection;
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
}
