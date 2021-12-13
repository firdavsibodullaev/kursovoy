<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faculty = Faculty::query()->firstWhere('id', 1);
        Department::query()->insert([
            [
                'short_name' => json_encode([
                    'uz' => 'MT',
                    'oz' => 'МТ',
                    'ru' => 'ТМ',
                    'en' => 'MET',
                ]),
                'full_name' => json_encode([
                    'uz' => 'Mashinasozlik texnologiyasi',
                    'oz' => 'Машинасозлик технологияси',
                    'ru' => 'Технология машиностроения',
                    'en' => 'Mechanical engineering technology',
                ]),
                'faculty_id' => $faculty->id,
            ],
            [
                'short_name' => json_encode([
                    'uz' => 'TJA',
                    'oz' => 'ТЖА',
                    'ru' => 'АУ',
                    'en' => 'AC',
                ]),
                'full_name' => json_encode([
                    'uz' => 'Texnologik jarayonlarni avtomatlashtirish',
                    'oz' => 'Технологик жараёнларни автоматлаштириш',
                    'ru' => 'Автоматизация и управление',
                    'en' => 'Automatizing and Control',
                ]),
                'faculty_id' => $faculty->id,
            ],
        ]);
    }
}
