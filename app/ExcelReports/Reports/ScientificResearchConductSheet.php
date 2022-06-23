<?php

namespace App\ExcelReports\Reports;

use App\ExcelReports\ReportSheet;
use App\Models\ScientificResearchConduct;
use Illuminate\Database\Eloquent\Builder;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ScientificResearchConductSheet implements ReportSheet
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
        $year = request('year');
        return ScientificResearchConduct::query()
            ->with('user')
            ->when($year, function (Builder $query) use ($year) {
                $query->where('year', '=', $year);
            })
            ->get();
    }

    /**
     * @param Worksheet $worksheet
     * @return int
     */
    public function body(Worksheet &$worksheet): int
    {
        $iter = 9;
        $collection = $this->getCollection();
        $count = $collection->count();
        $price_total = $collection->sum('price');
        $full_price_total = $collection->sum('full_price');
        /**
         * @var int $key
         * @var ScientificResearchConduct $item
         */
        foreach ($collection as $key => $item) {
            unset($collection[$key]);
            $iter += $key;
            $worksheet->setCellValue("A{$iter}", $key + 1)
                ->setCellValue("B{$iter}", $item->name)
                ->setCellValue("C{$iter}", $item->price)
                ->setCellValue("D{$iter}", $item->user->full_name_abbr)
                ->setCellValue("E{$iter}", $item->full_price);


            if (($key + 1) === $count) {
                $iter++;

                $worksheet->setCellValue("B{$iter}", "Жами")
                    ->setCellValue("C{$iter}", $price_total)
                    ->setCellValue("E{$iter}", $full_price_total);
                $worksheet->getStyle("B{$iter}:E{$iter}")
                    ->getFont()
                    ->setBold(true);
            }
        }

        $worksheet->getStyle("A9:E{$iter}")
            ->applyFromArray(self::BODY_STYLE)
            ->getFont()
            ->setName('Times New Roman')
            ->setSize(12);
        $worksheet->getStyle("A9:E{$iter}")
            ->getAlignment()
            ->setWrapText(true);
        return $iter;
    }

    /**
     * @throws Exception
     */
    public function footer(Worksheet &$worksheet, int $footer_iter)
    {
        $worksheet->mergeCells("B{$footer_iter}:D" . ($footer_iter + 1));

        $worksheet->setCellValue("B{$footer_iter}", "Ректор                                                                                 Б.Т.Мардонов")
            ->getStyle("B{$footer_iter}:D" . ($footer_iter + 1))
            ->applyFromArray(self::FOOTER_STYLE)
            ->getFont()
            ->setName('Times New Roman')
            ->setSize(12)
            ->setBold(true);

        $footer_iter += 2;

        $worksheet->mergeCells("B{$footer_iter}:D" . ($footer_iter + 1));

        $worksheet->setCellValue("B{$footer_iter}", "Бош ҳисобчи                                                                      Т.А.Абдуллаев    ")
            ->getStyle("B{$footer_iter}:D" . ($footer_iter + 1))
            ->applyFromArray(self::FOOTER_STYLE)
            ->getFont()
            ->setName('Times New Roman')
            ->setSize(12)
            ->setBold(true);

    }

    /**
     * @throws Exception
     */
    public static function get(Spreadsheet &$spreadsheet, string $worksheet_name)
    {
        $worksheet = $spreadsheet->getSheetByName($worksheet_name);
        $sheet = new static();
        $footer_iter = $sheet->body($worksheet) + 3;
        $sheet->footer($worksheet, $footer_iter);
    }
}
