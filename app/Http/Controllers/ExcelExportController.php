<?php

namespace App\Http\Controllers;

use App\ExcelReports\MainReport;
use App\ExcelReports\Reports\CopyrightProtectedVariousMaterialInformationSheet;
use App\ExcelReports\Reports\DScSheet;
use App\ExcelReports\Reports\GrantFundOrderSheet;
use App\ExcelReports\Reports\OakScientificArticleSheet;
use App\ExcelReports\Reports\ObtainedIndustrialSamplePatentSheet;
use App\ExcelReports\Reports\PhdSheet;
use App\ExcelReports\Reports\ScientificArticleCitationSheet;
use App\ExcelReports\Reports\ScientificArticleSheet;
use App\ExcelReports\Reports\ScientificResearchConductSheet;
use App\ExcelReports\Reports\ScientificResearchEffectivenessSheet;
use App\ExcelReports\Reports\StateGrantFundSheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExcelExportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return BinaryFileResponse
     * @throws PhpSpreadsheet
     * @throws Exception
     */
    public function __invoke(Request $request): BinaryFileResponse
    {

        $store_path = storage_path('app/public/Рейтингга_оид_жадваллар.xlsx');

        if (file_exists($store_path)) {
            unlink($store_path);
        }

        $path = storage_path('app/example.xlsx');
        $spreadsheet = IOFactory::load($path);

        MainReport::get([
            '1.3.1' => DScSheet::class,
            '1.3.2' => PhdSheet::class,
            '1.5' => ScientificArticleCitationSheet::class,
            '1.6.1' => ScientificArticleSheet::class,
            '1.6.2' => OakScientificArticleSheet::class,
            '1.7.1' => GrantFundOrderSheet::class,
            '1.7.2' => ScientificResearchConductSheet::class,
            '1.7.3' => StateGrantFundSheet::class,
            '1.9.1' => ScientificResearchEffectivenessSheet::class,
            '1.9.2' => ObtainedIndustrialSamplePatentSheet::class,
            '1.9.3' => CopyrightProtectedVariousMaterialInformationSheet::class
        ], $spreadsheet);

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($store_path);

        return Response::download($store_path);
    }
}
