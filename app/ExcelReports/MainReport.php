<?php

namespace App\ExcelReports;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class MainReport
{
    public static function get(array $reports, Spreadsheet &$spreadsheet)
    {
        foreach ($reports as $worksheet_name => $report) {
            $report = app($report);

            unset($reports[$worksheet_name]);
            if ($report instanceof ReportSheet) {
                $report::get($spreadsheet, $worksheet_name);
            }
        }
    }
}
