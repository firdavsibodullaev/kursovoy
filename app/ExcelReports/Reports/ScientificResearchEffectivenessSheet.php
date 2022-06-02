<?php

namespace App\ExcelReports\Reports;

use App\ExcelReports\ReportSheet;
use App\Models\ScientificResearchEffectiveness;
use Illuminate\Database\Eloquent\Builder;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ScientificResearchEffectivenessSheet implements ReportSheet
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
        $year = request('scientific_research_effectiveness_year');
        return ScientificResearchEffectiveness::query()
            ->with(['users', 'publication'])
            ->where('is_confirmed', '=', true)
            ->when($year, function (Builder $query) use ($year) {
                $query->whereYear('accepted_date', '=', $year);
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
        $collection = $this->getCollection();
        /**
         * @var int $key
         * @var ScientificResearchEffectiveness $item
         */
        foreach ($collection as $key => $item) {
            unset($collection[$key]);
            $iter = $key + 9;
            $worksheet->setCellValue("A{$iter}", $key + 1)
                ->setCellValue("B{$iter}", br2nl($item->users_formatted))
                ->setCellValue("C{$iter}", "{$item->specialized_code} - {$item->specialized_name}")
                ->setCellValue("D{$iter}", $item->name)
                ->setCellValue("E{$iter}", "({$item->accepted_date}) - {$item->accepted_report}")
                ->setCellValue("F{$iter}", $item->publication->title);

        }

        $worksheet->getStyle("A9:F{$iter}")
            ->applyFromArray(self::BODY_STYLE)
            ->getFont()
            ->setName('Times New Roman')
            ->setSize(12);
        $worksheet->getStyle("A9:F{$iter}")
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
