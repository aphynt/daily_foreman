<?php

namespace App\Services\Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

class EmployeeIdentityService
{
    public function matches(
        string $nik,
        string $noKtp,
        string $dateOfBirth
    ): bool {
        $cfg = config('password_recovery.identity');

        $connection = $cfg['connection'] ?? 'kkh';
        $table = $cfg['table'] ?? 'tbl_data_hr';
        $nikColumn = $cfg['nik_column'] ?? 'Nik';
        $ktpColumn = $cfg['ktp_column'] ?? 'No_KTP';
        $dobColumn = $cfg['dob_column'] ?? 'DOB';

        $nik = trim($nik);
        $noKtp = $this->normalizeKtp($noKtp);

        if ($nik === '' || $noKtp === '') {
            return false;
        }

        try {
            $query = $connection
                ? DB::connection($connection)->table($table)
                : DB::table($table);

            $row = $query
                ->where($nikColumn, $nik)
                ->whereRaw(
                    "REPLACE(REPLACE(REPLACE(REPLACE(LTRIM(RTRIM(CAST([$ktpColumn] AS VARCHAR(50)))), ' ', ''), '-', ''), '.', ''), '/', '') = ?",
                    [$noKtp]
                )
                ->select([$dobColumn])
                ->first();

            if (
                !$row ||
                !isset($row->{$dobColumn}) ||
                trim((string) $row->{$dobColumn}) === ''
            ) {
                return false;
            }

            $inputDob = Carbon::createFromFormat(
                'Y-m-d',
                $dateOfBirth
            )->startOfDay();

            $databaseDob = Carbon::parse(
                $row->{$dobColumn}
            )->startOfDay();

            return $databaseDob->isSameDay($inputDob);
        } catch (Throwable $e) {
            report($e);

            return false;
        }
    }
    private function normalizeKtp(string $value): string
    {
        return preg_replace(
            '/[\s\.\-\/]+/',
            '',
            trim($value)
        ) ?? '';
    }
}
