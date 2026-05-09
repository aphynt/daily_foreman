<?php

namespace App\Exports;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class HazardReportExport implements FromCollection, WithHeadings, WithMapping, WithEvents, WithCustomStartCell
{
    protected Collection $data;
    protected string $startDate;
    protected string $endDate;
    protected array $temporaryImages = [];

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

    public function collection()
    {
        return $this->data;
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

    public function map($item): array
    {
        $fotoTemuan = ($item->dokumentasi_1 ?? null) ?: ($item->dokumentasi_2 ?? null);
        $fotoPerbaikan = ($item->dokumentasi_perbaikan_1 ?? null) ?: ($item->dokumentasi_perbaikan_2 ?? null);

        return [
            $item->id ?? '-',
            'PT.SIMS',
            $item->departemen_pelapor ?? '-',
            $item->nama_pelapor ?? '-',

            $item->perusahaan ?? '-',
            $item->nama_departemen ?? '-',

            $item->lokasi ?? '-',
            $this->formatDate($item->tanggal_pelaporan ?? null),
            $item->bahaya ?? '-',
            $item->risiko ?? '-',
            strtoupper((string) ($item->tingkat_risiko ?? '-')),

            $fotoTemuan,

            $item->tindakan_perbaikan ?? '-',
            $item->pengendalian_awal ?? '-',

            $fotoPerbaikan,

            $this->normalizeStatus(
                $item->status ?? null,
                $item->verified_scc ?? null,
                $item->verified_penerima ?? null
            ),
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                /** @var Worksheet $sheet */
                $sheet = $event->sheet->getDelegate();

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

                $this->setColumnWidths($sheet);

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

                $highestRow = $sheet->getHighestRow();

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

                    $sheet->getStyle("A4:G{$highestRow}")
                        ->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                    $sheet->getStyle("K4:L{$highestRow}")
                        ->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                    $sheet->getStyle("O4:P{$highestRow}")
                        ->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }

                for ($row = 4; $row <= $highestRow; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(85);

                    $sheet->getStyle('C' . $row)->getFont()->setBold(true);
                    $sheet->getStyle('F' . $row)->getFont()->setBold(true);

                    $riskText = strtoupper((string) $sheet->getCell('K' . $row)->getValue());
                    $this->applyRiskStyle($sheet, 'K' . $row, $riskText);

                    $status = trim((string) $sheet->getCell('P' . $row)->getValue());

                    if ($status !== 'Close') {
                        $status = 'Open';
                    }

                    $sheet->setCellValue('P' . $row, $status);
                    $this->applyStatusStyle($sheet, 'P' . $row, $status);

                    $fotoTemuan = $sheet->getCell('L' . $row)->getValue();

                    if (!empty($fotoTemuan)) {
                        $imagePath = $this->makeOptimizedImage($fotoTemuan);

                        if ($imagePath) {
                            $this->addImageToSheet(
                                $sheet,
                                $imagePath,
                                'L' . $row,
                                'Foto Temuan ' . $row
                            );

                            $sheet->setCellValue('L' . $row, '');
                        }
                    }

                    $fotoPerbaikan = $sheet->getCell('O' . $row)->getValue();

                    if (!empty($fotoPerbaikan)) {
                        $imagePath = $this->makeOptimizedImage($fotoPerbaikan);

                        if ($imagePath) {
                            $this->addImageToSheet(
                                $sheet,
                                $imagePath,
                                'O' . $row,
                                'Foto Perbaikan ' . $row
                            );

                            $sheet->setCellValue('O' . $row, '');
                        }
                    }
                }

                register_shutdown_function(function () {
                    foreach ($this->temporaryImages as $path) {
                        if (is_file($path)) {
                            @unlink($path);
                        }
                    }
                });
            },
        ];
    }

    protected function setColumnWidths(Worksheet $sheet): void
    {
        $sheet->getColumnDimension('A')->setWidth(8);
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
        if (empty($value)) {
            return null;
        }

        try {
            return Carbon::parse($value)->format('d-M-Y');
        } catch (\Throwable $e) {
            return (string) $value;
        }
    }

    protected function normalizeStatus($status, $verifiedScc = null, $verifiedPenerima = null): string
    {
        $status = strtoupper(trim((string) $status));
        $verifiedScc = strtoupper(trim((string) $verifiedScc));
        $verifiedPenerima = strtoupper(trim((string) $verifiedPenerima));

        if (
            $status === '2' &&
            $verifiedScc === 'ACCEPT' &&
            $verifiedPenerima === 'ACCEPT'
        ) {
            return 'Close';
        }

        return 'Open';
    }

    protected function applyRiskStyle(Worksheet $sheet, string $cell, string $riskText): void
    {
        $riskText = strtoupper(trim($riskText));

        $fillColor = null;
        $fontColor = '000000';

        if (str_contains($riskText, 'EXTREME')) {
            $fillColor = 'C00000';
            $fontColor = 'FFFFFF';
        } elseif (str_contains($riskText, 'HIGH')) {
            $fillColor = '1F1FBF';
            $fontColor = 'FFFFFF';
        } elseif (str_contains($riskText, 'MEDIUM')) {
            $fillColor = 'FFD966';
            $fontColor = '000000';
        } elseif (str_contains($riskText, 'LOW')) {
            $fillColor = '00B050';
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
                'startColor' => ['rgb' => $isClose ? '198754' : 'DC3545'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
    }

    protected function addImageToSheet(
        Worksheet $sheet,
        string $imagePath,
        string $cell,
        string $name
    ): void {
        $drawing = new Drawing();
        $drawing->setName($name);
        $drawing->setDescription($name);
        $drawing->setPath($imagePath);
        $drawing->setHeight(75);
        $drawing->setCoordinates($cell);
        $drawing->setOffsetX(5);
        $drawing->setOffsetY(5);
        $drawing->setWorksheet($sheet);
    }

    protected function makeOptimizedImage(?string $source): ?string
    {
        if (empty($source)) {
            return null;
        }

        $originalPath = $this->resolveImageSource($source);

        if (!$originalPath || !is_file($originalPath)) {
            return null;
        }

        $imageInfo = @getimagesize($originalPath);

        if (!$imageInfo) {
            return null;
        }

        [$width, $height] = $imageInfo;
        $mime = $imageInfo['mime'] ?? null;

        switch ($mime) {
            case 'image/jpeg':
                $sourceImage = @imagecreatefromjpeg($originalPath);
                break;

            case 'image/png':
                $sourceImage = @imagecreatefrompng($originalPath);
                break;

            case 'image/webp':
                $sourceImage = function_exists('imagecreatefromwebp')
                    ? @imagecreatefromwebp($originalPath)
                    : false;
                break;

            default:
                return null;
        }

        if (!$sourceImage) {
            return null;
        }

        $maxWidth = 300;
        $maxHeight = 190;

        $ratio = min($maxWidth / $width, $maxHeight / $height, 1);

        $newWidth = max(1, (int) floor($width * $ratio));
        $newHeight = max(1, (int) floor($height * $ratio));

        $newImage = imagecreatetruecolor($newWidth, $newHeight);

        $white = imagecolorallocate($newImage, 255, 255, 255);
        imagefill($newImage, 0, 0, $white);

        imagecopyresampled(
            $newImage,
            $sourceImage,
            0,
            0,
            0,
            0,
            $newWidth,
            $newHeight,
            $width,
            $height
        );

        $tempPath = storage_path('app/temp_hazard_export_image_' . uniqid() . '.jpg');

        imagejpeg($newImage, $tempPath, 70);

        imagedestroy($sourceImage);
        imagedestroy($newImage);

        $this->temporaryImages[] = $tempPath;

        return $tempPath;
    }

    protected function resolveImageSource(string $source): ?string
    {
        $source = trim($source);

        if ($source === '') {
            return null;
        }

        if (preg_match('/^https?:\/\//i', $source)) {
            $parsed = parse_url($source);

            if (!empty($parsed['path'])) {
                $decodedPath = rawurldecode($parsed['path']);

                $publicStoragePath = public_path(ltrim($decodedPath, '/'));

                if (is_file($publicStoragePath)) {
                    return $publicStoragePath;
                }

                if (str_starts_with($decodedPath, '/storage/')) {
                    $relativeStoragePath = substr($decodedPath, strlen('/storage/'));
                    $storagePath = storage_path('app/public/' . $relativeStoragePath);

                    if (is_file($storagePath)) {
                        return $storagePath;
                    }
                }
            }

            return $this->downloadImageToTemporaryFile($source);
        }

        $source = ltrim($source, '/');

        $candidates = [
            public_path($source),
            public_path('storage/' . $source),
            storage_path('app/public/' . $source),
            storage_path('app/' . $source),
            base_path($source),
        ];

        foreach ($candidates as $path) {
            if (is_file($path)) {
                return $path;
            }
        }

        return null;
    }

    protected function downloadImageToTemporaryFile(string $url): ?string
    {
        $url = $this->normalizeImageUrl($url);

        $tempPath = storage_path('app/temp_hazard_download_image_' . uniqid() . '.tmp');

        $file = @fopen($tempPath, 'wb');

        if (!$file) {
            return null;
        }

        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_FILE => $file,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_FAILONERROR => true,
            CURLOPT_USERAGENT => 'Mozilla/5.0',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
        ]);

        $success = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        fclose($file);

        if (!$success || $httpCode >= 400 || !is_file($tempPath) || filesize($tempPath) <= 0) {
            @unlink($tempPath);
            return null;
        }

        $this->temporaryImages[] = $tempPath;

        return $tempPath;
    }

    protected function normalizeImageUrl(string $url): string
    {
        $url = trim($url);

        $parts = parse_url($url);

        if (!$parts || empty($parts['scheme']) || empty($parts['host'])) {
            return $url;
        }

        $scheme = $parts['scheme'];
        $host = $parts['host'];
        $port = isset($parts['port']) ? ':' . $parts['port'] : '';

        $path = $parts['path'] ?? '';
        $query = isset($parts['query']) ? '?' . $parts['query'] : '';
        $fragment = isset($parts['fragment']) ? '#' . $parts['fragment'] : '';

        $encodedPath = implode('/', array_map(function ($segment) {
            return rawurlencode(rawurldecode($segment));
        }, explode('/', $path)));

        return $scheme . '://' . $host . $port . $encodedPath . $query . $fragment;
    }
}
