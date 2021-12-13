<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faculty::query()->insert([
            [
                'short_name' => json_encode([
                    'uz' => 'EMF',
                    'oz' => 'ЭМФ',
                    'ru' => 'ЭМФ',
                    'en' => 'EMF',
                ]),
                'full_name' => json_encode([
                    'uz' => 'Energo-mexanika fakulteti',
                    'oz' => 'Энерго-механика факултети',
                    'ru' => 'Энергомеханический факультет',
                    'en' => 'Energo-mechanical faculty',
                ]),
            ],
            [
                'short_name' => json_encode([
                    'uz' => 'KF',
                    'oz' => 'КФ',
                    'ru' => 'ГФ',
                    'en' => 'MF',
                ]),
                'full_name' => json_encode([
                    'uz' => 'Konchilik fakulteti',
                    'oz' => 'Кончилик факультети',
                    'ru' => 'Горный факультет',
                    'en' => 'Mining faculty',
                ]),
            ],
            [
                'short_name' => json_encode([
                    'uz' => 'KMF',
                    'oz' => 'КМФ',
                    'ru' => 'ХМФ',
                    'en' => 'ChMF',
                ]),
                'full_name' => json_encode([
                    'uz' => 'Kimyo-metallurgiya fakulteti',
                    'oz' => 'Кимё-металлургия факультети',
                    'ru' => 'Химико-металлургический факультет',
                    'en' => 'Chemical-metallurgy faculty',
                ]),
            ],
        ]);
    }
}
