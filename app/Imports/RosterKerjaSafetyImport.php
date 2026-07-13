<?php

namespace App\Imports;

use App\Models\RosterKerjaSafety;
use Maatwebsite\Excel\Concerns\ToModel;
use Ramsey\Uuid\Uuid;
use Maatwebsite\Excel\Concerns\WithStartRow;

class RosterKerjaSafetyImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $tahun;
    protected $bulan;

    // Konstruktor untuk menerima tahun dan bulan
    public function __construct($tahun, $bulan)
    {
        $this->tahun = $tahun;
        $this->bulan = $bulan;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {

        if (!isset($row[1]) || trim($row[1]) == '') {
            return null;
        }

        $data = [
            'uuid' => (string) Uuid::uuid4(),
            'statusenabled' => true,
            'nik' => $row[1],
            'unit_kerja' => $row[0],
            'tahun' => (string)$this->tahun,
            'bulan' => (string)$this->bulan,
            '1' => $row[3] ?? null,
            '2' => $row[4] ?? null,
            '3' => $row[5] ?? null,
            '4' => $row[6] ?? null,
            '5' => $row[7] ?? null,
            '6' => $row[8] ?? null,
            '7' => $row[9] ?? null,
            '8' => $row[10] ?? null,
            '9' => $row[11] ?? null,
            '10' => $row[12] ?? null,
            '11' => $row[13] ?? null,
            '12' => $row[14] ?? null,
            '13' => $row[15] ?? null,
            '14' => $row[16] ?? null,
            '15' => $row[17] ?? null,
            '16' => $row[18] ?? null,
            '17' => $row[19] ?? null,
            '18' => $row[20] ?? null,
            '19' => $row[21] ?? null,
            '20' => $row[22] ?? null,
            '21' => $row[23] ?? null,
            '22' => $row[24] ?? null,
            '23' => $row[25] ?? null,
            '24' => $row[26] ?? null,
            '25' => $row[27] ?? null,
            '26' => $row[28] ?? null,
            '27' => $row[29] ?? null,
            '28' => $row[30] ?? null,
            '29' => $row[31] ?? null,
            '30' => $row[32] ?? null,
            '31' => $row[33] ?? null,
        ];

        RosterKerjaSafety::insert($data);

        return null;

    }
}
