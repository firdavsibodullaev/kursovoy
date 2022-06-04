<?php

namespace App\ExcelReports\Reports;

use App\Constants\LanguagesConstant;
use App\ExcelReports\ReportSheet;
use App\Models\ScientificArticleCitation;
use Illuminate\Database\Eloquent\Builder;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use function br2nl;

class ScientificArticleCitationSheet implements ReportSheet
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
        return ScientificArticleCitation::query()
            ->where('is_confirmed', '=', true)
            ->with(['users', 'magazine'])
            ->when($year, function (Builder $query) use ($year) {
                $query->whereYear('magazine_publish_date', '=', $year);
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
        $count = $collection->count();
        /**
         * @var int $key
         * @var ScientificArticleCitation $item
         */
        foreach ($collection as $key => $item) {
            unset($collection[$key]);
            $iter += $key;
            $worksheet->setCellValue("A{$iter}", $key + 1)
                ->setCellValue("B{$iter}", br2nl($item->users_formatted))
                ->setCellValue("C{$iter}", $item->magazine->title)
                ->setCellValue("D{$iter}", date_create($item->magazine_publish_date)->format('d.m.Y'))
                ->setCellValue("E{$iter}", $item->article_title)
                ->setCellValue("F{$iter}", LanguagesConstant::translatedList($item->article_language))
                ->setCellValue("G{$iter}", $item->link)
                ->setCellValue("H{$iter}", $item->citations_count);

            $worksheet->getCell("G{$iter}")
                ->getHyperlink()
                ->setUrl($item->link);

            $worksheet->getRowDimension($iter)->setRowHeight(40);
            $worksheet->getColumnDimension("H")->setWidth(50);
            $worksheet->getColumnDimension("G")->setWidth(50);
            if (($key + 1) === $count) {
                $iter++;

                $worksheet->setCellValue("B{$iter}", "Жами")
                    ->setCellValue("H{$iter}", $count);
            }
        }

        $worksheet->getStyle("A8:H{$iter}")
            ->applyFromArray(self::BODY_STYLE)
            ->getFont()
            ->setName('Times New Roman')
            ->setSize(12);
        $worksheet->getStyle("A8:H{$iter}")
            ->getAlignment()
            ->setWrapText(true);
        return $iter;
    }

    /**
     * @throws Exception
     */
    public function footer(Worksheet &$worksheet, int $footer_iter)
    {
        $worksheet->mergeCells("B{$footer_iter}:H" . ($footer_iter + 1));

        $worksheet->setCellValue("B{$footer_iter}", "Ректор                                                                                 Қ.С.Санақулов")
            ->getStyle("B{$footer_iter}:H" . ($footer_iter + 1))
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
