<?php

namespace App\Services;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class FacultyService
 * @package App\Services
 */
class FacultyService
{
    /**
     * @return Collection
     */
    public function fetchFacultiesList(): Collection
    {
        return Faculty::query()->with('departments')->get();
    }

    /**
     * @param array $validated
     * @return Faculty
     */
    public function create(array $validated): Faculty
    {
        $faculty = new Faculty();
        $this->addTranslation($faculty, $validated);
        $faculty->save();

        return $faculty;
    }

    /**
     * @param Faculty $faculty
     * @param array $validated
     * @return Faculty
     */
    public function update(Faculty $faculty, array $validated): Faculty
    {
        $this->addTranslation($faculty, $validated);
        $faculty->save();

        return $faculty;
    }

    public function addTranslation(Faculty &$faculty, array $validated)
    {
        $faculty->setTranslations('full_name', [
            'uz' => $validated['full_name_uz'],
            'oz' => $validated['full_name_oz'],
            'ru' => $validated['full_name_ru'],
            'en' => $validated['full_name_en']
        ])->setTranslations('short_name', [
            'uz' => $validated['short_name_uz'],
            'oz' => $validated['short_name_oz'],
            'ru' => $validated['short_name_ru'],
            'en' => $validated['short_name_en']
        ]);
    }
}
