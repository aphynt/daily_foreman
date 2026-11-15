<?php

namespace App\Exports;

use App\Models\DiggibilityTimeSession;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class DiggingTimeExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    WithEvents,
    ShouldAutoSize,
    WithTitle
{
    protected $tanggalMulai;
    protected $tanggalSampai;
    protected $pengawas;
    protected $lokasi;
    protected $jenisMaterial;

    public function __construct(
        $tanggalMulai,
        $tanggalSampai,
        $pengawas = null,
        $lokasi = null,
        $jenisMaterial = null
    ) {
        $this->tanggalMulai = $tanggalMulai;
        $this->tanggalSampai = $tanggalSampai;
        $this->pengawas = $pengawas;
        $this->lokasi = $lokasi;
        $this->jenisMaterial = $jenisMaterial;
    }

    public function title(): string
    {
        return 'Digging Time';
    }

    private function kategoriMaterial($area, $jenisMaterial, $average, $kategoriLama = null)
    {
        $area = strtolower(trim((string) $area));

        $batas = strcasecmp(trim((string) $jenisMaterial), 'Free Dig') === 0
            ? 15.99
            : [
                'sisi highwall' => 14.00,
                'sisi tengah' => 12.50,
                'sisi freeface' => 13.50,
            ][$area] ?? null;

        if ($batas === null || $average === null || $average === '') {
            return $kategoriLama;
        }

        return round((float) $average, 2) <= $batas
            ? 'MATERIAL BAGUS'
            : 'MATERIAL KERAS';
    }

    public function collection(): Collection
    {
        $query = DiggibilityTimeSession::query()
            ->where('statusenabled', 1)
            ->whereDate('tanggal', '>=', $this->tanggalMulai)
            ->whereDate('tanggal', '<=', $this->tanggalSampai);

        if ($this->pengawas) {
            $query->where('nama_pengawas', $this->pengawas);
        }

        if ($this->lokasi) {
            $query->where('lokasi', $this->lokasi);
        }

        if ($this->jenisMaterial) {
            $query->where('jenis_material', $this->jenisMaterial);
        }

        $data = $query->get();

        $data = $data->sortBy(function ($item) {

            $jam = $item->jam ? Carbon::parse($item->jam)->format('H:i:s') : '';
            $shiftOrder = $jam === '' ? 3 : (($jam >= '07:00:00' && $jam <= '18:59:59') ? 1 : 2);
            return Carbon::parse($item->tanggal)->format('Y-m-d')
                . '-' . $shiftOrder
                . '-' . $jam;

        })->values();

        return $data->map(function ($item, $index) {
            $item->nomor_urut = $index + 1;
            return $item;
        });
    }

    public function headings(): array
    {
        return [
            [
                'ANALISIS KUALITAS MATERIAL BLASTING (DIGGING TIME)'
            ],
            [
                'No',
                'Tanggal',
                'Shift',
                'Pengawas',
                '',
                'Loading Point',
                '',
                'Digging Time',
                '',
                '',
                '',
                '',
                'Jenis Laporan',
            ],
            [
                '',
                '',
                '',
                'NIK',
                'Nama',
                'EXC',
                'Lokasi',
                'Jam',
                'Avg Digging Time',
                'Sisi Area',
                'Material',
                'Operator',
                '',
            ],
        ];
    }

    public function map($item): array
    {
        $jam = $item->jam
            ? Carbon::parse($item->jam)->format('H:i:s')
            : '';

        if ($jam === '') {
            $shift = '';
        } elseif ($jam >= '07:00:00' && $jam <= '18:59:59') {
            $shift = 'Siang';
        } else {
            $shift = 'Malam';
        }

        $kategori = $this->kategoriMaterial(
            $item->keterangan_area,
            $item->jenis_material,
            $item->average_digging_time,
            $item->kategori
        );

        $area = preg_replace(
            '/^sisi\s+/i',
            '',
            trim($item->keterangan_area ?? '')
        );

        return [
            $item->nomor_urut,
            Carbon::parse($item->tanggal)->format('j-M-y'),
            $shift,
            $item->nik_pengawas,
            $item->nama_pengawas,
            $item->no_unit,
            $item->lokasi,
            $jam,
            $item->average_digging_time,
            $area,
            $kategori === 'MATERIAL BAGUS'
                ? 'Bagus'
                : ($kategori === 'MATERIAL KERAS' ? 'Keras' : '-'),
            $item->nama_operator,
            'Aplikasi',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 14],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            2 => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'C6E0B4'],
                ],
            ],
            3 => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'C6E0B4'],
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                $lastRow = $sheet->getHighestRow();

                $merges = [
                    'A1:M1',
                    'A2:A3',
                    'B2:B3',
                    'C2:C3',
                    'D2:E2',
                    'F2:G2',
                    'H2:L2',
                    'M2:M3',
                ];

                foreach ($merges as $merge) {
                    $sheet->mergeCells($merge);
                }

                $sheet->getStyle('A1:M1')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D9EAD3'],
                    ],
                ]);

                $sheet->getStyle('A1:M' . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $sheet->getStyle('A4:D' . $lastRow)
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle('F4:K' . $lastRow)
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle('M4:M' . $lastRow)
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $widths = [
                    'A' => 6,
                    'B' => 14,
                    'C' => 12,
                    'D' => 12,
                    'E' => 30,
                    'F' => 10,
                    'G' => 14,
                    'H' => 12,
                    'I' => 16,
                    'J' => 14,
                    'K' => 14,
                    'L' => 25,
                    'M' => 16,
                ];

                foreach ($widths as $column => $width) {
                    $sheet->getColumnDimension($column)->setWidth($width);
                }

                $sheet->getRowDimension(1)->setRowHeight(25);
                $sheet->getRowDimension(2)->setRowHeight(25);
                $sheet->getRowDimension(3)->setRowHeight(35);

                $sheet->freezePane('A4');

                if ($lastRow >= 4) {
                    $sheet->setAutoFilter('A3:M' . $lastRow);
                }
            },
        ];
    }
}
