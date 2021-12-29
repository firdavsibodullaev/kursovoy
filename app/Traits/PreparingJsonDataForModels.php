<?php


namespace App\Traits;


trait PreparingJsonDataForModels
{
    /**
     * @param array $validated
     */
    protected function prepareData(array &$validated)
    {
        if (isset($validated['diploma_series'])) {
            $validated['diploma'] = [
                'series' => $validated['diploma_series'],
                'number' => $validated['diploma_number'],
            ];
            $validated['professor_without_science_degree'] = null;
        }

        if (isset($validated['professor_without_science_degree_series'])) {
            $validated['diploma'] = null;
            $validated['professor_without_science_degree'] = [
                'series' => $validated['professor_without_science_degree_series'],
                'number' => $validated['professor_without_science_degree_number'],
            ];
        }
        $validated['employment'] = [
            'order' => $validated['employee_order'],
            'date' => $validated['employee_date']
        ];
        $validated['user'] = [
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'patronymic' => $validated['patronymic'],
        ];
        unset(
            $validated['diploma_series'],
            $validated['diploma_number'],
            $validated['professor_without_science_degree_number'],
            $validated['professor_without_science_degree_series'],
            $validated['employee_order'],
            $validated['employee_date'],
            $validated['first_name'],
            $validated['last_name'],
            $validated['patronymic']
        );
    }
}
