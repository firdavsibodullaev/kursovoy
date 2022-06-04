<?php

namespace App\ExcelReports\Reports;

use App\ExcelReports\ReportSheet;
use App\Models\OakScientificArticle;
use Illuminate\Database\Eloquent\Builder;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use function br2nl;

class OakScientificArticleSheet implements ReportSheet
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
        return OakScientificArticle::query()
            ->where('is_confirmed', '=', true)
            ->with(['users', 'magazine'])
            ->when($year, function (Builder $query) use ($year) {
                $query->where('publish_year', '=', $year);
            })
            ->get();
    }

    /**
     * @param Worksheet $worksheet
     * @return int
     * @throws Exception
     */
    public function body(Worksheet &$worksheet): int
    {
        $iter = 8;
        $collection = $this->getCollection();
        /**
         * @var int $key
         * @var OakScientificArticle $item
         */
        foreach ($collection as $key => $item) {
            unset($collection[$key]);
            $iter += $key;
            $worksheet->setCellValue("A{$iter}", $key + 1)
                ->setCellValue("B{$iter}", br2nl($item->users_formatted))
                ->setCellValue("C{$iter}", $item->magazine->title)
                ->setCellValue("D{$iter}", $item->title)
                ->setCellValue("E{$iter}", "{$item->publish_year}й. {$item->pages}")
                ->setCellValue("F{$iter}", $item->link)
                ->setCellValue("G{$iter}", $item->users->count());

            $worksheet->getCell("F{$iter}")
                ->getHyperlink()
                ->setUrl($item->link);

            $worksheet->getRowDimension($iter)->setRowHeight(40);
            $worksheet->getColumnDimension("F")->setWidth(50);
            $worksheet->getColumnDimension("G")->setWidth(50);
        }

        $worksheet->getStyle("A8:G{$iter}")
            ->applyFromArray(self::BODY_STYLE)
            ->getFont()
            ->setName('Times New Roman')
            ->setSize(12);
        $worksheet->getStyle("A8:G{$iter}")
            ->getAlignment()
            ->setWrapText(true);
        return $iter;
    }

    /**
     * @throws Exception
     */
    public function footer(Worksheet &$worksheet, int $footer_iter)
    {
        $worksheet->mergeCells("B{$footer_iter}:G" . ($footer_iter + 1));

        $worksheet->setCellValue("B{$footer_iter}", "Ректор                                                                                 Қ.С.Санақулов")
            ->getStyle("B{$footer_iter}:G" . ($footer_iter + 1))
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
