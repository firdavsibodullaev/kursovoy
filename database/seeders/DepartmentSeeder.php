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
                'faculty_id' => 1,
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
                'faculty_id' => 1,
            ],
            [
                'short_name' => json_encode([
                    'uz' => 'KI',
                    'oz' => 'КИ',
                    'ru' => 'ГД',
                    'en' => 'MW',
                ]),
                'full_name' => json_encode([
                    'uz' => 'Konchilik ishi',
                    'oz' => 'Кончилик иши',
                    'ru' => 'Горное дело',
                    'en' => 'Mining works',
                ]),
                'faculty_id' => 2,
            ],
            [
                'short_name' => json_encode([
                    'uz' => 'TMJ',
                    'oz' => 'ТМЖ',
                    'ru' => 'ТМО',
                    'en' => 'TME',
                ]),
                'full_name' => json_encode([
                    'uz' => 'Texnologik mashina va jixozlar',
                    'oz' => 'Технологик машина ва жихозлар',
                    'ru' => 'Технологические машины и оборудования',
                    'en' => 'Technological machines and equipments',
                ]),
                'faculty_id' => 2,
            ],
            [
                'short_name' => json_encode([
                    'uz' => 'MET',
                    'oz' => 'МЕТ',
                    'ru' => 'МЕТ',
                    'en' => 'MET',
                ]),
                'full_name' => json_encode([
                    'uz' => 'Metallurgiya',
                    'oz' => 'Металлургия',
                    'ru' => 'Металлургия',
                    'en' => 'Metallurgy',
                ]),
                'faculty_id' => 3,
            ],
            [
                'short_name' => json_encode([
                    'uz' => 'IQ',
                    'oz' => 'ИҚ',
                    'ru' => 'ЭК',
                    'en' => 'EC',
                ]),
                'full_name' => json_encode([
                    'uz' => 'Iqtisod',
                    'oz' => 'Иқтисод',
                    'ru' => 'Экономика',
                    'en' => 'Economy',
                ]),
                'faculty_id' => 3,
            ],
        ]);
    }
}
