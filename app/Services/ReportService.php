<?php

namespace App\Services;

use App\Models\DScDoctor;
use App\Models\PhdDoctor;

/**
 * Class ReportService
 * @package App\Services
 */
class ReportService
{
    public function getDegreeReport()
    {
        $phd = PhdDoctor::query()->count();
        $dsc = DScDoctor::query()->count();

    }
}
