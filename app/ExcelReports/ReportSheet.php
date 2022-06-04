<?php

namespace App\ExcelReports;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

interface ReportSheet
{
    /**
     * @param Spreadsheet $spreadsheet
     * @param string $worksheet_name
     * @return mixed
     */
    public static function get(Spreadsheet &$spreadsheet, string $worksheet_name);
}
