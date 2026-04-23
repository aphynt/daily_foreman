<?php

namespace App\Exports;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class HazardReportExport implements FromCollection, WithHeadings, WithEvents, WithCustomStartCell
{
    protected Collection $data;
    protected string $startDate;
    protected string $endDate;

    public function __construct($data, string $startDate, string $endDate)
    {
        $this->data = collect($data);
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function headings(): array
    {
        return [
            [
                'No HR',
                'PELAPOR HAZARD',
                '',
                '',
                'PIC PENANGGUNG JAWAB',
                '',
                'DETAIL LOKASI',
                'TANGGAL',
                'TEMUAN BAHAYA',
                'RESIKO',
                'NILAI RISIKO',
                'FOTO TEMUAN',
                'TINDAKAN PERBAIKAN',
                'PENGENDALIAN AWAL',
                'FOTO PERBAIKAN',
                'STATUS',
            ],
            [
                '',
                'PERUSAHAAN',
                'DEPT.',
                'NAMA',
                'PERUSAHAAN',
                'DEPT.',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
            ],
        ];
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                $item->id ?? '-',
                'PT.SIMS',
                $item->departemen_pelapor ?? '-',
                $item->nama_pelapor ?? '-',

                $item->perusahaan ?? '-',
                $item->nama_departemen ?? '-', // dept PIC

                $item->lokasi ?? '-',
                $this->formatDate($item->tanggal_pelaporan ?? null),
                $item->bahaya ?? '-',
                $item->risiko ?? '-',
                strtoupper((string) ($item->tingkat_risiko ?? '-')),
                '',
                $item->tindakan_perbaikan ?? '-',
                $item->pengendalian_awal ?? '-',
                '',
                $this->normalizeStatus($item->status ?? null),
            ];
        });
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                /** @var Worksheet $sheet */
                $sheet = $event->sheet->getDelegate();

                $highestRow = 3 + $this->data->count();

                $sheet->mergeCells('A1:P1');
                $sheet->setCellValue('A1', '"' . $this->buildTitle() . '"');

                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'DCE6F1'],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                $sheet->getRowDimension(1)->setRowHeight(42);

                $sheet->mergeCells('A1:P1');

                $sheet->mergeCells('A2:A3');
                $sheet->mergeCells('B2:D2');
                $sheet->mergeCells('E2:F2');
                $sheet->mergeCells('G2:G3');
                $sheet->mergeCells('H2:H3');
                $sheet->mergeCells('I2:I3');
                $sheet->mergeCells('J2:J3');
                $sheet->mergeCells('K2:K3');
                $sheet->mergeCells('L2:L3');
                $sheet->mergeCells('M2:M3');
                $sheet->mergeCells('N2:N3');
                $sheet->mergeCells('O2:O3');
                $sheet->mergeCells('P2:P3');

                $sheet->getColumnDimension('A')->setWidth(6);
                $sheet->getColumnDimension('B')->setWidth(16);
                $sheet->getColumnDimension('C')->setWidth(15);
                $sheet->getColumnDimension('D')->setWidth(20);
                $sheet->getColumnDimension('E')->setWidth(16);
                $sheet->getColumnDimension('F')->setWidth(18);
                $sheet->getColumnDimension('G')->setWidth(24);
                $sheet->getColumnDimension('H')->setWidth(14);
                $sheet->getColumnDimension('I')->setWidth(42);
                $sheet->getColumnDimension('J')->setWidth(36);
                $sheet->getColumnDimension('K')->setWidth(18);
                $sheet->getColumnDimension('L')->setWidth(35);
                $sheet->getColumnDimension('M')->setWidth(30);
                $sheet->getColumnDimension('N')->setWidth(28);
                $sheet->getColumnDimension('O')->setWidth(35);
                $sheet->getColumnDimension('P')->setWidth(12);

                $sheet->getRowDimension(2)->setRowHeight(28);
                $sheet->getRowDimension(3)->setRowHeight(28);

                $sheet->getStyle('A2:P3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 10,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D8E4BC'],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                if ($highestRow >= 4) {
                    $sheet->getStyle("A4:P{$highestRow}")->applyFromArray([
                        'alignment' => [
                            'vertical' => Alignment::VERTICAL_CENTER,
                            'wrapText' => true,
                        ],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['rgb' => '000000'],
                            ],
                        ],
                    ]);

                    $sheet->getStyle("A4:G{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle("K4:L{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle("O4:P{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }

                foreach ($this->data->values() as $index => $item) {
                    $row = 4 + $index;

                    $sheet->getRowDimension($row)->setRowHeight(72);

                    $sheet->getStyle('C' . $row)->getFont()->setBold(true);
                    $sheet->getStyle('F' . $row)->getFont()->setBold(true);

                    $riskText = strtoupper((string) ($item->tingkat_risiko ?? ''));
                    $this->applyRiskStyle($sheet, 'K' . $row, $riskText);

                    $status = $this->normalizeStatus($item->status ?? null);
                    $this->applyStatusStyle($sheet, 'P' . $row, $status);

                    $fotoTemuan = $item->dokumentasi_1 ?: $item->dokumentasi_2;
                    $fotoPerbaikan = $item->dokumentasi_perbaikan_1 ?: $item->dokumentasi_perbaikan_2;

                    $this->addImageFromSource(
                        $sheet,
                        $fotoTemuan,
                        'L' . $row,
                        'Foto Temuan ' . $row
                    );

                    $this->addImageFromSource(
                        $sheet,
                        $fotoPerbaikan,
                        'O' . $row,
                        'Foto Perbaikan ' . $row
                    );
                }
            },
        ];
    }

    protected function buildTitle(): string
    {
        try {
            $start = Carbon::parse($this->startDate);
            $end = Carbon::parse($this->endDate);

            if ($start->format('m-Y') === $end->format('m-Y')) {
                return 'PICA HAZARD REPORT PERIODE ' . strtoupper($start->translatedFormat('F Y'));
            }

            return 'PICA HAZARD REPORT PERIODE ' .
                strtoupper($start->format('d M Y')) .
                ' - ' .
                strtoupper($end->format('d M Y'));
        } catch (\Throwable $e) {
            return 'PICA HAZARD REPORT';
        }
    }

    protected function formatDate($value): ?string
    {
        if (blank($value)) {
            return null;
        }

        try {
            return Carbon::parse($value)->format('d-M-Y');
        } catch (\Throwable $e) {
            return (string) $value;
        }
    }

    protected function normalizeStatus($status): string
    {
        $status = strtoupper((string) $status);

        if (in_array($status, ['2', 'CLOSE', 'CLOSED'], true)) {
            return 'Close';
        }

        return 'Open';
    }

    protected function applyRiskStyle(Worksheet $sheet, string $cell, string $riskText): void
    {
        $riskText = strtoupper(trim($riskText));

        $fillColor = null;
        $fontColor = '000000';

        if (str_contains($riskText, 'LOW')) {
            $fillColor = '00B050';
            $fontColor = 'FFFFFF';
        } elseif (str_contains($riskText, 'MEDIUM')) {
            $fillColor = 'FFD966';
            $fontColor = '000000';
        } elseif (str_contains($riskText, 'HIGH')) {
            $fillColor = '1F1FBF';
            $fontColor = 'FFFFFF';
        } elseif (str_contains($riskText, 'EXTREME')) {
            $fillColor = 'C00000';
            $fontColor = 'FFFFFF';
        }

        $style = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => $fontColor],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ];

        if ($fillColor) {
            $style['fill'] = [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => $fillColor],
            ];
        }

        $sheet->getStyle($cell)->applyFromArray($style);
    }

    protected function applyStatusStyle(Worksheet $sheet, string $cell, string $status): void
    {
        $isClose = strtoupper($status) === 'CLOSE';

        $sheet->getStyle($cell)->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => $isClose ? '198754' : 'FF1100'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
    }

    protected function addImageFromSource(Worksheet $sheet, ?string $source, string $cell, string $name): void
    {
        if (blank($source)) {
            return;
        }

        try {
            $imageData = null;

            if (filter_var($source, FILTER_VALIDATE_URL)) {
                $imageData = @file_get_contents($source);
            } else {
                $source = ltrim($source, '/');

                $candidates = [
                    public_path($source),
                    storage_path('app/public/' . $source),
                    storage_path('app/' . $source),
                    $source,
                ];

                foreach ($candidates as $path) {
                    if (file_exists($path)) {
                        $imageData = @file_get_contents($path);
                        break;
                    }
                }
            }

            if (!$imageData) {
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
            $drawing->setHeight(88);
            $drawing->setCoordinates($cell);
            $drawing->setOffsetX(5);
            $drawing->setOffsetY(5);
            $drawing->setWorksheet($sheet);
        } catch (\Throwable $e) {
        }
    }
}
