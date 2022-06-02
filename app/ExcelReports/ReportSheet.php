<?php

namespace App\ExcelReports;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

interface ReportSheet
{
    /**
     * @param Spreadsheet $spreadsheet
     * @param int $worksheet_index
     * @return mixed
     */
    public static function get(Spreadsheet &$spreadsheet, int $worksheet_index);
}
