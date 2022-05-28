<?php

namespace App\Services;

use App\Models\Department;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class DepartmentService
 * @package App\Services
 */
class DepartmentService
{
    /**
     * @return Collection
     */
    public function fetchList(): Collection
    {
        return Department::query()->with('faculty')->get();
    }

    /**
     * @param array $validated
     * @return Department
     */
    public function create(array $validated): Department
    {
        $department = new Department();
        $this->addTranslation($department, $validated);
        $department->faculty_id = $validated['faculty_id'];
        $department->save();
        return $department->load('faculty');
    }

    /**
     * @param Department $department
     * @param array $validated
     * @return Department
     */
    public function update(Department $department, array $validated): Department
    {
        $this->addTranslation($department, $validated);
        $department->faculty_id = $validated['faculty_id'];
        $department->save();

        return $department->load('faculty');
    }

    /**
     * @param Department $department
     * @return bool|null
     */
    public function delete(Department $department): ?bool
    {
        return $department->delete();
    }

    /**
     * @param Department $department
     * @param array $validated
     * @return void
     */
    protected function addTranslation(Department &$department, array $validated)
    {
        $department->setTranslations('full_name', [
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
