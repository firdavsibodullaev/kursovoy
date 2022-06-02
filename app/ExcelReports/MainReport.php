<?php

namespace App\ExcelReports;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class MainReport
{
    public static function get(array $reports, Spreadsheet &$spreadsheet)
    {
        foreach ($reports as $worksheet_index => $report) {
            $report = app($report);

            unset($reports[$worksheet_index]);
            if ($report instanceof ReportSheet) {
                $report::get($spreadsheet, $worksheet_index);
            }
        }
    }
}
