<?php

namespace App\Exports;

use App\Models\AnsweredAnketa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Illuminate\Support\Collection;

class AnsweredAnketasExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    use Exportable;

    protected $records;

    public function __construct($records = null)
    {
        $this->records = $records;
    }

    public function collection()
    {
        if ($this->records) {
            return $this->records;
        }
        return AnsweredAnketa::with(['agent', 'anketa'])->get();
    }

    public function headings(): array
    {
        return [];
    }

    public function map($row): array
    {
        return [];
    }

    public function styles(Worksheet $sheet)
    {
        $records = $this->collection();
        $currentRow = 1;

        // записи по названию анкеты
        $groupedRecords = $records->groupBy(function ($record) {
            return $record->anketa->name ?? 'Без названия';
        });

        foreach ($groupedRecords as $anketaName => $anketaRecords) {
            // вопросы только для текущей анкеты
            $firstRecord = $anketaRecords->first();
            $questions = array_keys(json_decode($firstRecord->answers, true));
            $lastColumn = chr(65 + count($questions)); // Определяем последнюю колонку


            $sheet->setCellValue('A' . $currentRow, $anketaName);
            $sheet->mergeCells('A' . $currentRow . ':' . $lastColumn . $currentRow);
            $sheet->getStyle('A' . $currentRow)->getFont()->setBold(true)->setSize(14);
            $sheet->getStyle('A' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $currentRow++;

            foreach ($questions as $index => $question) {
                $sheet->setCellValue(chr(65 + $index) . $currentRow, $question);
            }

            $sheet->setCellValue($lastColumn . $currentRow, 'Статус');
            $sheet->getStyle('A' . $currentRow . ':' . $lastColumn . $currentRow)->getFont()->setBold(true);
            $currentRow++;

            foreach ($anketaRecords as $record) {
                $answers = json_decode($record->answers, true);

                foreach ($questions as $index => $question) {
                    $sheet->setCellValue(chr(65 + $index) . $currentRow, $answers[$question] ?? '');
                }

                $sheet->setCellValue($lastColumn . $currentRow, $record->status);

                $status = $record->status;
                $color = match($status) {
                    'Одобрено' => '92D050',
                    'Отклонено' => 'FF0000',
                    default => 'FFC000',
                };

                $sheet->getStyle($lastColumn . $currentRow)
                    ->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setRGB($color);

                $currentRow++;
            }

            $currentRow++;
        }

        foreach (range('A', $sheet->getHighestColumn()) as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }
}
