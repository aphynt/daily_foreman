<?php

namespace App\Exports;

use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class InspeksiPICAExport implements
    FromCollection,
    WithEvents,
    WithHeadings,
    WithStyles,
    WithCustomStartCell
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function startCell(): string
    {
        return 'A4';
    }

    public function collection()
    {
        $no = 1;

        return $this->data->map(function ($item) use (&$no) {
            $isClose = (int) ($item->is_finish ?? 0) === 1;

            $inspectors = collect([
                $item->inspektor1 ?? null,
                $item->inspektor2 ?? null,
                $item->inspektor3 ?? null,
                $item->inspektor4 ?? null,
                $item->inspektor5 ?? null,
            ])->filter(function ($value) {
                return !is_null($value) && trim($value) !== '';
            })->map(function ($value) {
                return '- ' . trim($value);
            })->implode("\n");

            return [
                $no++,
                $item->created_at
                    ? Carbon::parse($item->created_at)->format('d-M-y')
                    : null,
                $item->area,
                $inspectors ?: '-',
                $item->temuan,
                $item->file_temuan,
                $item->tingkat_risiko,
                $item->tindak_lanjut,
                $item->created_at
                    ? Carbon::parse($item->created_at)->addDays(7)->format('d-M-y')
                    : null,
                'Produksi',
                $isClose && $item->tanggal_perbaikan
                    ? Carbon::parse($item->tanggal_perbaikan)->format('d-M-y')
                    : null,
                $item->file_tindakLanjut,
                $isClose ? 'Close' : 'Open',
                $item->level,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Tgl. Inspeksi',
            'Lokasi',
            'Inspektor',
            'Uraian Temuan',
            'Dokumentasi Temuan',
            'Tingkat Risiko',
            'Rekomendasi Tindak Lanjut',
            'Due Date',
            'PIC',
            'Tgl. Perbaikan',
            'Dokumentasi Tindakan Perbaikan',
            'Status',
            'Level',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                /** @var Worksheet $sheet */
                $sheet = $event->sheet->getDelegate();
                $logo = public_path('dashboard/assets/images/logo-full.png');

                if (file_exists($logo)) {
                    $d2 = new Drawing();
                    $d2->setName('Logo2');
                    $d2->setDescription('Logo Perusahaan 2');
                    $d2->setPath($logo);
                    $d2->setHeight(50);
                    $d2->setCoordinates('A1');
                    $d2->setOffsetX(0);
                    $d2->setWorksheet($sheet);
                }

                $sheet->mergeCells('A2:N2');
                $sheet->setCellValue('A2', 'PICA INSPEKSI KESELAMATAN PERTAMBANGAN');
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 24,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $sheet->setCellValue('N1', 'FM-SE-82/05/24/09/25');
                $sheet->getStyle('N1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 9,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                        'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                    ],
                ]);

                $sheet->getColumnDimension('A')->setWidth(5);
                $sheet->getColumnDimension('B')->setWidth(12);
                $sheet->getColumnDimension('C')->setWidth(18);
                $sheet->getColumnDimension('D')->setWidth(30);
                $sheet->getColumnDimension('E')->setWidth(35);
                $sheet->getColumnDimension('F')->setWidth(30);
                $sheet->getColumnDimension('G')->setWidth(14);
                $sheet->getColumnDimension('H')->setWidth(35);
                $sheet->getColumnDimension('I')->setWidth(14);
                $sheet->getColumnDimension('J')->setWidth(18);
                $sheet->getColumnDimension('K')->setWidth(14);
                $sheet->getColumnDimension('L')->setWidth(30);
                $sheet->getColumnDimension('M')->setWidth(10);
                $sheet->getColumnDimension('N')->setWidth(10);

                $highestRow    = $sheet->getHighestRow() ?: 4;
                $highestColumn = $sheet->getHighestColumn() ?: 'N';
                $range         = "A4:{$highestColumn}{$highestRow}";

                $sheet->getStyle($range)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color'       => ['argb' => 'FF000000'],
                        ],
                    ],
                    'alignment' => [
                        'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        'wrapText'   => true,
                    ],
                ]);

                $startDataRow = 5;
                $rowIndex     = 0;

                foreach ($this->data as $item) {
                    $row = $startDataRow + $rowIndex;
                    $isClose = (int) ($item->is_finish ?? 0) === 1;
                    $statusCell = 'M' . $row;

                    $sheet->getStyle($statusCell)->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'color' => ['rgb' => $isClose ? 'FFFFFF' : 'FFFFFF'],
                        ],
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => $isClose ? '198754' : 'DC3545'],
                        ],
                        'alignment' => [
                            'horizontal' => Alignment::HORIZONTAL_CENTER,
                            'vertical'   => Alignment::VERTICAL_CENTER,
                        ],
                    ]);

                    $sheet->getRowDimension($row)->setRowHeight(80);

                    if (!empty($item->file_temuan)) {
                        $this->addImageFromUrl(
                            $sheet,
                            $item->file_temuan,
                            'F'.$row,
                            'Dok Temuan '.$rowIndex
                        );
                        $sheet->setCellValue('F'.$row, '');
                    }

                    if (!empty($item->file_tindakLanjut)) {
                        $this->addImageFromUrl(
                            $sheet,
                            $item->file_tindakLanjut,
                            'L'.$row,
                            'Dok Perbaikan '.$rowIndex
                        );
                        $sheet->setCellValue('L'.$row, '');
                    }

                    $rowIndex++;
                }

            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            'A4:N4' => [
                'font' => [
                    'bold' => true,
                    'size' => 11,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical'   => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'wrapText'   => true,
                ],
                'fill' => [
                    'fillType'  => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor'=> ['rgb' => 'D8E4BC'],
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color'       => ['rgb' => '000000'],
                    ],
                ],
            ],
        ];
    }

    protected function addImageFromUrl(Worksheet $sheet, string $url, string $cell, string $name): void
    {
        try {
            $imageData = @file_get_contents($url);
            if ($imageData === false) {
                return;
            }

            $image = @imagecreatefromstring($imageData);
            if ($image === false) {
                return;
            }

            $drawing = new MemoryDrawing();
            $drawing->setName($name);
            $drawing->setDescription($name);
            $drawing->setImageResource($image);
            $drawing->setRenderingFunction(MemoryDrawing::RENDERING_JPEG);
            $drawing->setMimeType(MemoryDrawing::MIMETYPE_DEFAULT);
            $drawing->setHeight(80);
            $drawing->setCoordinates($cell);
            $drawing->setOffsetX(5);
            $drawing->setOffsetY(5);
            $drawing->setWorksheet($sheet);
        } catch (\Throwable $e) {
        }
    }
}
