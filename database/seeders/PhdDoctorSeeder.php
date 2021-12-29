<?php

namespace Database\Seeders;

use App\Models\PhdDoctor;
use Illuminate\Database\Seeder;

class PhdDoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PhdDoctor::factory()->count(300)->create();
    }
}
