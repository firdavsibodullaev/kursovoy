<?php

namespace App\ExcelReports\Reports;

use App\ExcelReports\ReportSheet;
use App\Models\PhdDoctor;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PhdSheet implements ReportSheet
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
        return PhdDoctor::all();
    }

    /**
     * @param Worksheet $worksheet
     * @return int
     */
    public function body(Worksheet &$worksheet): int
    {
        $iter = 6;
        $dsc = $this->getCollection();
        /**
         * @var int $key
         * @var PhdDoctor $item
         */
        foreach ($dsc as $key => $item) {
            unset($dsc[$key]);
            $iter += $key;
            $worksheet->setCellValue("A{$iter}", $key + 1)
                ->setCellValue("B{$iter}", $item->user_full_name)
                ->setCellValue("C{$iter}", is_null($item->diploma) ? '' : $item->diploma['series'])
                ->setCellValue("D{$iter}", is_null($item->diploma) ? '' : $item->diploma['number'])
                ->setCellValue("E{$iter}", is_null($item->professor_without_science_degree) ? '' : $item->professor_without_science_degree['series'])
                ->setCellValue("F{$iter}", is_null($item->professor_without_science_degree) ? '' : $item->professor_without_science_degree['number'])
                ->setCellValue("G{$iter}", $item->speciality_name)
                ->setCellValue("H{$iter}", $item->employment['order'] . " \n" . $item->employment['date']);

            $worksheet->getRowDimension($iter)->setRowHeight(40);
            $worksheet->getColumnDimension("H")->setWidth(50);
            $worksheet->getColumnDimension("G")->setWidth(50);

        }
        $worksheet->getStyle("A6:H{$iter}")
            ->applyFromArray(self::BODY_STYLE)
            ->getFont()
            ->setName('Times New Roman')
            ->setSize(12);
        $worksheet->getStyle("A6:H{$iter}")
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
