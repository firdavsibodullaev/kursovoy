<?php

namespace App\ExcelReports\Reports;

use App\ExcelReports\ReportSheet;
use App\Models\ObtainedIndustrialSamplePatent;
use Illuminate\Database\Eloquent\Builder;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ObtainedIndustrialSamplePatentSheet implements ReportSheet
{
    const BODY_STYLE = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['argb' => '000000']
            ]
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER
        ]
    ];

    const FOOTER_STYLE = [
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER
        ]
    ];

    public function getCollection()
    {
        $year = request('obtained_industrial_sample_patent_year');
        return ObtainedIndustrialSamplePatent::query()
            ->with(['users', 'institute'])
            ->when($year, function (Builder $query) use ($year) {
                $query->whereYear('date', '=', $year);
            })
            ->get();
    }

    /**
     * @param Worksheet $worksheet
     * @return int
     */
    public function body(Worksheet &$worksheet): int
    {
        $iter = 0;
        $dsc = $this->getCollection();
        /**
         * @var int $key
         * @var ObtainedIndustrialSamplePatent $item
         */
        foreach ($dsc as $key => $item) {
            unset($dsc[$key]);
            $iter = $key + 8;
            $worksheet->setCellValue("A{$iter}", $key + 1)
                ->setCellValue("B{$iter}", "Навоий давлат кончилик ва технологиялар университети")
                ->setCellValue("C{$iter}", br2nl($item->users_formatted))
                ->setCellValue("D{$iter}", $item->name)
                ->setCellValue("E{$iter}", date_create($item->date)->format('d.m.Y'))
                ->setCellValue("F{$iter}", $item->number);

            $worksheet->getRowDimension($iter)->setRowHeight(65);

        }
        $worksheet->getStyle("A8:F{$iter}")
            ->applyFromArray(self::BODY_STYLE)
            ->getFont()
            ->setName('Times New Roman')
            ->setSize(12);

        $worksheet->getStyle("A8:F{$iter}")
            ->getAlignment()
            ->setWrapText(true);
        return $iter;
    }

    /**
     * @throws Exception
     */
    public function footer(Worksheet &$worksheet, int $footer_iter)
    {
        $worksheet->mergeCells("B{$footer_iter}:E" . ($footer_iter + 1));

        $worksheet->setCellValue("B{$footer_iter}", "Ректор                                                                                 Қ.С.Санақулов")
            ->getStyle("B{$footer_iter}:E" . ($footer_iter + 1))
            ->applyFromArray(self::FOOTER_STYLE)
            ->getFont()
            ->setName('Times New Roman')
            ->setSize(12)
            ->setBold(true);
    }

    /**
     * @throws Exception
     */
    public static function get(Spreadsheet &$spreadsheet, int $worksheet_index)
    {
        $worksheet = $spreadsheet->getSheet($worksheet_index);
        $sheet = new static();
        $footer_iter = $sheet->body($worksheet) + 3;
        $sheet->footer($worksheet, $footer_iter);
    }
}
