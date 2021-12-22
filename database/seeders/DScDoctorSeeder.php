<?php

namespace Database\Seeders;

use App\Models\DScDoctor;
use Illuminate\Database\Seeder;

class DScDoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DScDoctor::factory()->count(50)->create();
    }
}
