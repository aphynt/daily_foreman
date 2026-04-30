<?php

namespace App\Exports;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class InspeksiPICAExport implements
    FromQuery,
    WithHeadings,
    WithMapping,
    WithEvents
{
    protected array $filters;
    protected int $no = 1;
    protected array $temporaryImages = [];

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $query = DB::table('prd_sap_report as sr')
            ->leftJoin('users as us', 'sr.foreman_id', 'us.id')
            ->leftJoin('ref_departemen as dep', 'sr.departemen_pic', 'dep.id')
            ->leftJoin('ref_shift as sh', 'sr.shift', 'sh.id')
            ->select(
                'sr.uuid',
                'sr.statusenabled',
                'sr.created_at',
                'sr.tanggal_kejadian',
                'sr.jam_kejadian',
                'sh.keterangan as shift',
                'us.nik as nik_pic',
                'us.name as pic',
                'sr.area',
                'sr.temuan',
                'sr.risiko',
                'sr.level',
                'sr.inspektor1',
                'sr.inspektor2',
                'sr.inspektor3',
                'sr.inspektor4',
                'sr.inspektor5',
                'sr.file_temuan',
                'sr.file_temuan2',
                'sr.file_temuan3',
                'sr.file_tindakLanjut',
                'sr.file_tindakLanjut2',
                'sr.file_tindakLanjut3',
                'sr.tingkat_risiko',
                'sr.due_date',
                'sr.tanggal_perbaikan',
                'sr.pengendalian',
                'sr.tindak_lanjut',
                'sr.is_finish',
                'dep.keterangan as departemen'
            )
            ->whereBetween('sr.created_at', [
                $this->filters['start'],
                $this->filters['end'],
            ])
            ->where('sr.statusenabled', 1);

        if (!in_array($this->filters['role'], ['ADMIN', 'MANAGEMENT'])) {
            $query->where(function ($q) {
                $q->where('sr.departemen_pic', $this->filters['departemen_id'])
                    ->orWhere('sr.foreman_id', $this->filters['user_id']);
            });
        }

        if (isset($this->filters['status']) && $this->filters['status'] !== '') {
            $query->where('sr.is_finish', $this->filters['status']);
        }

        return $query->orderBy('sr.created_at', 'DESC');
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

    public function map($item): array
    {
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
            $this->no++,
            $item->tanggal_kejadian
                ? Carbon::parse($item->tanggal_kejadian)->format('d-M-y')
                : null,
            $item->area,
            $inspectors ?: '-',
            $item->temuan,
            $item->file_temuan ?: null,
            $item->tingkat_risiko,
            $item->tindak_lanjut,
            $item->created_at
                ? Carbon::parse($item->created_at)->addDays(7)->format('d-M-y')
                : null,
            $item->departemen,
            $isClose && $item->tanggal_perbaikan
                ? Carbon::parse($item->tanggal_perbaikan)->format('d-M-y')
                : null,
            $item->file_tindakLanjut ?: null,
            $isClose ? 'Close' : 'Open',
            $item->level,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                /** @var Worksheet $sheet */
                $sheet = $event->sheet->getDelegate();

                /*
                 * FromQuery tidak memakai WithCustomStartCell.
                 * Jadi kita geser isi export ke bawah 3 baris.
                 */
                $sheet->insertNewRowBefore(1, 3);

                $logo = public_path('dashboard/assets/images/logo-full.png');

                if (file_exists($logo)) {
                    $drawing = new Drawing();
                    $drawing->setName('Logo');
                    $drawing->setDescription('Logo Perusahaan');
                    $drawing->setPath($logo);
                    $drawing->setHeight(50);
                    $drawing->setCoordinates('A1');
                    $drawing->setOffsetX(0);
                    $drawing->setWorksheet($sheet);
                }

                $sheet->mergeCells('A2:N2');
                $sheet->setCellValue('A2', 'PICA INSPEKSI KESELAMATAN PERTAMBANGAN');

                $sheet->getStyle('A2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 24,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $sheet->setCellValue('N1', 'FM-SE-82/05/24/09/25');

                $sheet->getStyle('N1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 9,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_RIGHT,
                        'vertical' => Alignment::VERTICAL_TOP,
                    ],
                ]);

                $this->setColumnWidths($sheet);

                $highestRow = $sheet->getHighestRow();

                $sheet->getStyle("A4:N{$highestRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],
                ]);

                $sheet->getStyle('A4:N4')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 11,
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

                for ($row = 5; $row <= $highestRow; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(85);

                    $status = $sheet->getCell('M' . $row)->getValue();
                    $isClose = strtolower((string) $status) === 'close';

                    $sheet->getStyle('M' . $row)->applyFromArray([
                        'font' => [
                            'bold' => true,
                            'color' => ['rgb' => 'FFFFFF'],
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

                    $fileTemuan = $sheet->getCell('F' . $row)->getValue();

                    if (!empty($fileTemuan)) {
                        $imagePath = $this->makeOptimizedImage($fileTemuan);

                        if ($imagePath) {
                            $this->addImageToSheet(
                                $sheet,
                                $imagePath,
                                'F' . $row,
                                'Dokumentasi Temuan ' . $row
                            );

                            $sheet->setCellValue('F' . $row, '');
                        }
                    }

                    $fileTindakLanjut = $sheet->getCell('L' . $row)->getValue();

                    if (!empty($fileTindakLanjut)) {
                        $imagePath = $this->makeOptimizedImage($fileTindakLanjut);

                        if ($imagePath) {
                            $this->addImageToSheet(
                                $sheet,
                                $imagePath,
                                'L' . $row,
                                'Dokumentasi Perbaikan ' . $row
                            );

                            $sheet->setCellValue('L' . $row, '');
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

        $maxWidth = 280;
        $maxHeight = 180;

        $ratio = min($maxWidth / $width, $maxHeight / $height, 1);

        $newWidth = max(1, (int) floor($width * $ratio));
        $newHeight = max(1, (int) floor($height * $ratio));

        $newImage = imagecreatetruecolor($newWidth, $newHeight);

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

        $tempPath = storage_path('app/temp_export_image_' . uniqid() . '.jpg');

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

        /*
        * Jika isi database berupa URL.
        * Contoh:
        * http://foreman.ptsims.co.id/storage/sap/file_temuan/WhatsApp Image.jpeg
        */
        if (preg_match('/^https?:\/\//i', $source)) {
            $parsed = parse_url($source);

            /*
            * Jika URL mengarah ke file storage lokal,
            * lebih baik baca langsung dari server, bukan download lewat HTTP.
            */
            if (!empty($parsed['path'])) {
                $decodedPath = rawurldecode($parsed['path']);

                /*
                * Contoh hasil:
                * /storage/sap/file_temuan/file.jpg
                */
                $publicStoragePath = public_path(ltrim($decodedPath, '/'));

                if (is_file($publicStoragePath)) {
                    return $publicStoragePath;
                }

                /*
                * Alternatif jika file ada di storage/app/public
                */
                if (str_starts_with($decodedPath, '/storage/')) {
                    $relativeStoragePath = substr($decodedPath, strlen('/storage/'));
                    $storagePath = storage_path('app/public/' . $relativeStoragePath);

                    if (is_file($storagePath)) {
                        return $storagePath;
                    }
                }
            }

            /*
            * Kalau bukan file lokal, baru download URL.
            */
            return $this->downloadImageToTemporaryFile($source);
        }

        /*
        * Jika isi database berupa path dari public.
        * Contoh:
        * storage/sap/file_temuan/file.jpg
        * uploads/temuan/file.jpg
        */
        $publicPath = public_path(ltrim($source, '/'));

        if (is_file($publicPath)) {
            return $publicPath;
        }

        /*
        * Jika isi database berupa path storage.
        * Contoh:
        * sap/file_temuan/file.jpg
        */
        $storagePath = storage_path('app/public/' . ltrim($source, '/'));

        if (is_file($storagePath)) {
            return $storagePath;
        }

        return null;
    }

    protected function downloadImageToTemporaryFile(string $url): ?string
    {
        $url = $this->normalizeImageUrl($url);

        $tempPath = storage_path('app/temp_download_image_' . uniqid() . '.tmp');

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
