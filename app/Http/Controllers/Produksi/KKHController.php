<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\AssignmentOperator;
use App\Models\Departemen;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class KKHController extends Controller
{
    //
    public function all()
    {
        $dep = DB::connection('kkh')->table('db_payroll.dbo.tm_departemen')->where('IsDept', true)->get();

        return view('kkh.all', compact('dep'));
    }

    public function name()
    {
        $user = DB::connection('daily_foreman')
            ->table('users')
            ->where('nik', Auth::user()->nik)
            ->first();

        $role = strtoupper(trim($user->role ?? ''));
        $departemenId = (int) ($user->departemen_id ?? 0);
        $userId = (int) ($user->id ?? 0);

        if ($role === 'SEPERVISOR') {
            $role = 'SUPERVISOR';
        }
        $petugasP3kIds = [5];

        $canSeeAll =
            in_array($role, ['ADMIN', 'MANAGEMENT']) ||
            (in_array($role, ['SUPERVISOR', 'SUPERINTENDENT']) && $departemenId === 9) ||
            in_array($userId, $petugasP3kIds);

        $userProduksi = DB::connection('kkh')
            ->table('db_payroll.dbo.tbl_data_hr as hr')
            ->leftJoin('db_payroll.dbo.tm_departemen as dp', 'hr.Id_Departemen', '=', 'dp.ID_Departemen')
            ->select('hr.Nik as NIK', 'hr.Nama as NAMA')
            ->where('hr.Active', true)
            ->when(!$canSeeAll, function ($q) use ($departemenId) {
                $q->whereRaw('CAST(hr.Id_Departemen AS INT) = ?', [$departemenId]);
            })
            ->orderBy('hr.Nama')
            ->get();

        return view('kkh.name', compact('userProduksi'));
    }

    public function all_api(Request $request)
    {
        $offset = $request->input('start', 0);
        $length = $request->input('length', 10);
        $draw = $request->input('draw');

        $start = new DateTime($request->tanggalKKH);
        $tanggalKKH = $start->format('Y-m-d');

        $currentUserRole = strtoupper(trim(Auth::user()->role ?? ''));

        if ($currentUserRole === 'SEPERVISOR') {
            $currentUserRole = 'SUPERVISOR';
        }

        $kkh = DB::connection('kkh')->table('db_payroll.dbo.web_kkh as kkh')
            ->leftJoin('db_payroll.dbo.tbl_data_hr as hr', 'kkh.nik', '=', 'hr.nik')
            ->leftJoin('db_payroll.dbo.tbl_data_hr as hr2', 'kkh.nik_pengawas', '=', 'hr2.nik')
            ->leftJoin('db_payroll.dbo.tm_departemen as dp', 'hr.ID_Departemen', '=', 'dp.ID_Departemen')
            ->leftJoin('db_payroll.dbo.tm_perusahaan as pr', 'hr.ID_Perusahaan', '=', 'pr.ID_Perusahaan')
            ->select(
                'kkh.id',
                'kkh.tgl',
                'kkh.nik',
                'dp.ID_Departemen',
                DB::raw("FORMAT(kkh.tgl_input, 'yyyy-MM-dd HH:mm') as TANGGAL_DIBUAT"),
                'hr.Nik as NIK_PENGISI',
                'hr.Nama as NAMA_PENGISI',
                'kkh.shift_kkh as SHIFT',
                DB::raw("'-' as JABATAN"),
                DB::raw("
                    CASE
                        WHEN kkh.jam_pulang IS NULL OR LTRIM(RTRIM(kkh.jam_pulang)) = '' THEN '-'
                        ELSE
                            RIGHT('0' + LEFT(kkh.jam_pulang, CHARINDEX(':', kkh.jam_pulang) - 1), 2)
                            + ':' +
                            RIGHT('0' + RIGHT(kkh.jam_pulang, LEN(kkh.jam_pulang) - CHARINDEX(':', kkh.jam_pulang)), 2)
                    END AS JAM_PULANG
                "),
                DB::raw("
                    CASE
                        WHEN kkh.jam_tidur IS NULL OR LTRIM(RTRIM(kkh.jam_tidur)) = '' THEN '-'
                        ELSE
                            RIGHT('0' + LEFT(kkh.jam_tidur, CHARINDEX(':', kkh.jam_tidur) - 1), 2)
                            + ':' +
                            RIGHT('0' + RIGHT(kkh.jam_tidur, LEN(kkh.jam_tidur) - CHARINDEX(':', kkh.jam_tidur)), 2)
                    END AS JAM_TIDUR
                "),
                DB::raw("
                    CASE
                        WHEN kkh.jam_bangun IS NULL OR LTRIM(RTRIM(kkh.jam_bangun)) = '' THEN '-'
                        ELSE
                            RIGHT('0' + LEFT(kkh.jam_bangun, CHARINDEX(':', kkh.jam_bangun) - 1), 2)
                            + ':' +
                            RIGHT('0' + RIGHT(kkh.jam_bangun, LEN(kkh.jam_bangun) - CHARINDEX(':', kkh.jam_bangun)), 2)
                    END AS JAM_BANGUN
                "),
                DB::raw("
                    STR(
                        ROUND(
                            CASE
                                WHEN DATEDIFF(MINUTE, kkh.jam_tidur, kkh.jam_bangun) < 0 THEN
                                    DATEDIFF(MINUTE, kkh.jam_tidur, DATEADD(DAY, 1, kkh.jam_bangun)) / 60.0
                                ELSE
                                    DATEDIFF(MINUTE, kkh.jam_tidur, kkh.jam_bangun) / 60.0
                            END, 1
                        ), 10, 1
                    ) AS TOTAL_TIDUR
                "),
                DB::raw("
                    CASE
                        WHEN kkh.jam_berangkat IS NULL OR LTRIM(RTRIM(kkh.jam_berangkat)) = '' THEN '-'
                        ELSE
                            RIGHT('0' + LEFT(kkh.jam_berangkat, CHARINDEX(':', kkh.jam_berangkat) - 1), 2)
                            + ':' +
                            RIGHT('0' + RIGHT(kkh.jam_berangkat, LEN(kkh.jam_berangkat) - CHARINDEX(':', kkh.jam_berangkat)), 2)
                    END AS JAM_BERANGKAT
                "),
                'kkh.fit_or as FIT_BEKERJA',
                DB::raw('UPPER(LTRIM(RTRIM(ISNULL(kkh.keluhan, \'\')))) as KELUHAN'),
                'kkh.masalah_pribadi as MASALAH_PRIBADI',

                'kkh.verif_p3k',
                'kkh.petugas_p3k as PETUGAS_P3K',
                'kkh.catatan_p3k as CATATAN_P3K',
                'kkh.ferivikasi_pengawas',
                'kkh.nik_pengawas as NIK_PENGAWAS',
                'hr2.Nama as NAMA_PENGAWAS',
            );

        if ($request->search['value']) {
            $searchValue = '%' . $request->search['value'] . '%';
            $columnsToSearch = [
                'hr.Nik',
                'hr.Nama',
                'kkh.shift_kkh',
                'kkh.jam_pulang',
                'kkh.jam_tidur',
                'kkh.jam_bangun',
                'kkh.jam_berangkat',
                'kkh.fit_or',
                'kkh.keluhan',
                'hr2.Nama',
            ];

            $kkh->where(function ($query) use ($columnsToSearch, $searchValue) {
                foreach ($columnsToSearch as $column) {
                    $query->orWhere($column, 'like', $searchValue);
                }
            });
        }

        if (!empty($request->tanggalKKH)) {
            $kkh->where('kkh.tgl', $tanggalKKH);
        }

        $shift = $request->shift;
        if ($shift == 'Pagi') {
            $kkh->where('kkh.shift_kkh', $shift);
        } elseif ($shift == 'Malam') {
            $kkh->where('kkh.shift_kkh', $shift);
        }

        if ($request->filled('departemen') && $request->departemen !== 'Semua') {
            $kkh->where('dp.ID_Departemen', $request->departemen);
        }

        $cluster = $request->cluster;

        $user = DB::connection('daily_foreman')
            ->table('users')
            ->where('nik', Auth::user()->nik)
            ->first();

        $role = strtoupper(trim($user->role ?? ''));
        $departemenId = (int) ($user->departemen_id ?? 0);

        if ($role === 'SEPERVISOR') {
            $role = 'SUPERVISOR';
        }

        $canSeeAll =
            in_array($role, ['ADMIN', 'MANAGEMENT']) ||
            (in_array($role, ['SUPERVISOR', 'SUPERINTENDENT']) && $departemenId === 9);

        if (!$canSeeAll) {
            $kkh->whereRaw('CAST(hr.ID_Departemen AS INT) = ?', [$departemenId]);
        }

        if ($cluster == 'HD' || $cluster == 'EX') {
            $niks = AssignmentOperator::where('CLASS', $cluster)->pluck('NIK');
            $kkh->whereIn('hr.nik', $niks);
        } elseif ($cluster == 'Unit Support') {
            $excludedNiks = AssignmentOperator::whereIn('CLASS', ['HD', 'EX'])->pluck('NIK')->toArray();

            $allOperatorNiks = DB::connection('daily_foreman')
                ->table('users')
                ->whereRaw('UPPER(role) = ?', ['OPERATOR'])
                ->whereNotIn('nik', $excludedNiks)
                ->pluck('nik');

            $kkh->whereIn('hr.nik', $allOperatorNiks);
        }

        $filteredRecords = $kkh->count();

        $kkhRows = $kkh
            ->orderBy('kkh.fit_or')
            ->offset($offset)
            ->limit($length)
            ->get();

        $nikList = $kkhRows->pluck('NIK_PENGISI')->filter()->unique()->values()->toArray();

        $userRoles = DB::connection('daily_foreman')
            ->table('users')
            ->whereIn('nik', $nikList)
            ->select('nik', 'role')
            ->get()
            ->keyBy('nik');

        $kkhRows->transform(function ($row) use ($currentUserRole, $userRoles) {
            $role = optional($userRoles->get($row->NIK_PENGISI))->role;
            $row->JABATAN = strtoupper(trim($role ?? '-'));

            $jabatanPengisi = strtoupper(trim($row->JABATAN ?? ''));
            $isOperator = $jabatanPengisi === 'OPERATOR';

            $keluhan = strtoupper(trim((string) ($row->KELUHAN ?? '')));
            $totalTidur = (float) trim((string) ($row->TOTAL_TIDUR ?? 0));

            $butuhP3k = ($totalTidur < 6) || ($keluhan !== 'FIT');
            $petugasP3kIds = [5];
            $isPetugasP3k = in_array((int) Auth::user()->id, $petugasP3kIds);

            $verifP3k = (int) $row->verif_p3k === 1;
            $verifPengawas = (int) $row->ferivikasi_pengawas === 1;

            $row->verif_p3k = $verifP3k ? 1 : 0;
            $row->ferivikasi_pengawas = $verifPengawas ? 1 : 0;

            $row->BUTUH_P3K = $butuhP3k ? 1 : 0;
            $row->CAN_VERIFY_P3K = 0;
            $row->CAN_VERIFY_PENGAWAS = 0;

            if ($butuhP3k && !$verifP3k) {
                $row->CAN_VERIFY_P3K = $isPetugasP3k ? 1 : 0;
            }

            $allowedToVerify = false;

            if (!$verifPengawas) {
                //$lolosTahapP3k = (!$butuhP3k) || $verifP3k;
                $lolosTahapP3k = true;

                if ($lolosTahapP3k && $jabatanPengisi !== $currentUserRole) {
                    if ($isOperator) {
                        $allowedToVerify = in_array($currentUserRole, ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT']);
                    } else {
                        switch ($jabatanPengisi) {
                            case 'FOREMAN':
                                $allowedToVerify = in_array($currentUserRole, ['SUPERVISOR', 'SUPERINTENDENT']);
                                break;
                            case 'SUPERVISOR':
                                $allowedToVerify = $currentUserRole === 'SUPERINTENDENT';
                                break;
                            case 'SUPERINTENDENT':
                            case 'PJS. SUPERINTENDENT':
                            case 'ASISTEN MANAGEMENT':
                                $allowedToVerify = $currentUserRole === 'MANAGEMENT';
                                break;
                            default:
                                $allowedToVerify = in_array($currentUserRole, ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT']);
                        }
                    }
                }
            }

            $row->CAN_VERIFY_PENGAWAS = $allowedToVerify ? 1 : 0;

            return $row;
        });

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $filteredRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $kkhRows,
        ]);
    }

    public function verifikasiP3K(Request $request)
    {
        $request->validate([
            'rowID'   => 'required',
            'fit_or'  => 'required|in:0,1',
            'catatan' => 'required|string'
        ]);

        DB::connection('kkh')->table('web_kkh')
            ->where('id', $request->rowID)
            ->update([
                'verif_p3k'   => 1,
                'petugas_p3k' => Auth::user()->name,
                'catatan_p3k' => $request->catatan,
                'fit_or'      => (int) $request->fit_or,
            ]);

        return response()->json([
            'message' => 'Verifikasi klinik berhasil.'
        ]);
    }

    public function all_name(Request $request)
    {
        $offset = $request->input('start', 0);
        $length = $request->input('length', 10);
        $draw = $request->input('draw');

        $namaKKH = $request->namaKKH;

        if (empty($request->rangeStart) || empty($request->rangeEnd)) {
            $time = new DateTime();
            $startDate = $time->format('Y-m-d');
            $endDate = $time->format('Y-m-d');

            $start = new DateTime($startDate);
            $end = new DateTime($endDate);
        } else {
            $start = new DateTime($request->rangeStart);
            $end = new DateTime($request->rangeEnd);
        }

        $startTimeFormatted = $start->format('Y-m-d');
        $endTimeFormatted = $end->format('Y-m-d');

        $currentUserRole = strtoupper(trim(Auth::user()->role ?? ''));
        if ($currentUserRole === 'SEPERVISOR') {
            $currentUserRole = 'SUPERVISOR';
        }

        $kkh = DB::connection('kkh')->table('db_payroll.dbo.web_kkh as kkh')
            ->leftJoin('db_payroll.dbo.tbl_data_hr as hr', 'kkh.nik', '=', 'hr.nik')
            ->leftJoin('db_payroll.dbo.tbl_data_hr as hr2', 'kkh.nik_pengawas', '=', 'hr2.nik')
            ->leftJoin('db_payroll.dbo.tm_departemen as dp', 'hr.Id_Departemen', '=', 'dp.ID_Departemen')
            ->leftJoin('db_payroll.dbo.tm_perusahaan as pr', 'hr.ID_Perusahaan', '=', 'pr.ID_Perusahaan')
            ->select(
                'kkh.id',
                'kkh.tgl',
                'kkh.nik',
                DB::raw("'-' as JABATAN"),
                DB::raw("FORMAT(kkh.tgl_input, 'yyyy-MM-dd HH:mm') as TANGGAL_DIBUAT"),
                'hr.Nik as NIK_PENGISI',
                'hr.Nama as NAMA_PENGISI',
                'kkh.shift_kkh as SHIFT',
                DB::raw("
                    CASE
                        WHEN kkh.jam_pulang IS NULL OR LTRIM(RTRIM(kkh.jam_pulang)) = '' THEN '-'
                        ELSE
                            RIGHT('0' + LEFT(kkh.jam_pulang, CHARINDEX(':', kkh.jam_pulang) - 1), 2)
                            + ':' +
                            RIGHT('0' + RIGHT(kkh.jam_pulang, LEN(kkh.jam_pulang) - CHARINDEX(':', kkh.jam_pulang)), 2)
                    END AS JAM_PULANG
                "),
                DB::raw("
                    CASE
                        WHEN kkh.jam_tidur IS NULL OR LTRIM(RTRIM(kkh.jam_tidur)) = '' THEN '-'
                        ELSE
                            RIGHT('0' + LEFT(kkh.jam_tidur, CHARINDEX(':', kkh.jam_tidur) - 1), 2)
                            + ':' +
                            RIGHT('0' + RIGHT(kkh.jam_tidur, LEN(kkh.jam_tidur) - CHARINDEX(':', kkh.jam_tidur)), 2)
                    END AS JAM_TIDUR
                "),
                DB::raw("
                    CASE
                        WHEN kkh.jam_bangun IS NULL OR LTRIM(RTRIM(kkh.jam_bangun)) = '' THEN '-'
                        ELSE
                            RIGHT('0' + LEFT(kkh.jam_bangun, CHARINDEX(':', kkh.jam_bangun) - 1), 2)
                            + ':' +
                            RIGHT('0' + RIGHT(kkh.jam_bangun, LEN(kkh.jam_bangun) - CHARINDEX(':', kkh.jam_bangun)), 2)
                    END AS JAM_BANGUN
                "),
                DB::raw("
                    STR(
                        ROUND(
                            CASE
                                WHEN DATEDIFF(MINUTE, kkh.jam_tidur, kkh.jam_bangun) < 0 THEN
                                    DATEDIFF(MINUTE, kkh.jam_tidur, DATEADD(DAY, 1, kkh.jam_bangun)) / 60.0
                                ELSE
                                    DATEDIFF(MINUTE, kkh.jam_tidur, kkh.jam_bangun) / 60.0
                            END, 1
                        ), 10, 1
                    ) AS TOTAL_TIDUR
                "),
                DB::raw("
                    CASE
                        WHEN kkh.jam_berangkat IS NULL OR LTRIM(RTRIM(kkh.jam_berangkat)) = '' THEN '-'
                        ELSE
                            RIGHT('0' + LEFT(kkh.jam_berangkat, CHARINDEX(':', kkh.jam_berangkat) - 1), 2)
                            + ':' +
                            RIGHT('0' + RIGHT(kkh.jam_berangkat, LEN(kkh.jam_berangkat) - CHARINDEX(':', kkh.jam_berangkat)), 2)
                    END AS JAM_BERANGKAT
                "),
                'kkh.fit_or as FIT_BEKERJA',
                DB::raw('UPPER(LTRIM(RTRIM(ISNULL(kkh.keluhan, \'\')))) as KELUHAN'),
                'kkh.masalah_pribadi as MASALAH_PRIBADI',

                'kkh.verif_p3k',
                'kkh.petugas_p3k as PETUGAS_P3K',
                'kkh.catatan_p3k as CATATAN_P3K',

                'kkh.ferivikasi_pengawas',
                'kkh.nik_pengawas as NIK_PENGAWAS',
                'hr2.Nama as NAMA_PENGAWAS'
            )
            ->whereBetween('kkh.tgl', [$startTimeFormatted, $endTimeFormatted]);

        if ($request->search['value']) {
            $searchValue = '%' . $request->search['value'] . '%';
            $columnsToSearch = [
                'hr.Nik',
                'hr.Nama',
                'kkh.shift_kkh',
                'kkh.jam_pulang',
                'kkh.jam_tidur',
                'kkh.jam_bangun',
                'kkh.jam_berangkat',
                'kkh.fit_or',
                'kkh.keluhan',
                'hr2.Nama',
                'kkh.petugas_p3k',
                'kkh.catatan_p3k'
            ];

            $kkh->where(function ($query) use ($columnsToSearch, $searchValue) {
                foreach ($columnsToSearch as $column) {
                    $query->orWhere($column, 'like', $searchValue);
                }
            });
        }

        if (!empty($request->namaKKH)) {
            $kkh->where('hr.Nik', $namaKKH);
        }

        $user = DB::connection('daily_foreman')
            ->table('users')
            ->where('nik', Auth::user()->nik)
            ->first();

        $role = strtoupper(trim($user->role ?? ''));
        $departemenId = (int) ($user->departemen_id ?? 0);

        if ($role === 'SEPERVISOR') {
            $role = 'SUPERVISOR';
        }

        $petugasP3kIds = [5];

        $canSeeAll =
            in_array($role, ['ADMIN', 'MANAGEMENT']) ||
            (in_array($role, ['SUPERVISOR', 'SUPERINTENDENT']) && $departemenId === 9) ||
            in_array((int) Auth::user()->id, $petugasP3kIds);

        if (!$canSeeAll) {
            $kkh->whereRaw('CAST(hr.ID_Departemen AS INT) = ?', [$departemenId]);
        }

        $filteredRecords = $kkh->count();

        $kkhRows = $kkh
            ->orderBy('kkh.fit_or')
            ->offset($offset)
            ->limit($length)
            ->get();

        $nikList = $kkhRows->pluck('NIK_PENGISI')
            ->filter()
            ->unique()
            ->values()
            ->toArray();

        $userRoles = DB::connection('daily_foreman')
            ->table('users')
            ->whereIn('nik', $nikList)
            ->select('nik', 'role')
            ->get()
            ->keyBy('nik');

        $kkhRows->transform(function ($row) use ($userRoles, $currentUserRole) {
            $role = optional($userRoles->get($row->NIK_PENGISI))->role;
            $row->JABATAN = strtoupper(trim($role ?? '-'));

            $jabatanPengisi = strtoupper(trim($row->JABATAN ?? ''));
            $isOperator = $jabatanPengisi === 'OPERATOR';

            $keluhan = strtoupper(trim((string) ($row->KELUHAN ?? '')));
            $totalTidur = (float) trim((string) ($row->TOTAL_TIDUR ?? 0));

            $butuhP3k = ($totalTidur < 6) || ($keluhan !== 'FIT');
            $petugasP3kIds = [5];
            $isPetugasP3k = in_array((int) Auth::user()->id, $petugasP3kIds);

            $verifP3k = (int) $row->verif_p3k === 1;
            $verifPengawas = (int) $row->ferivikasi_pengawas === 1;

            $row->verif_p3k = $verifP3k ? 1 : 0;
            $row->ferivikasi_pengawas = $verifPengawas ? 1 : 0;

            $row->BUTUH_P3K = $butuhP3k ? 1 : 0;
            $row->CAN_VERIFY_P3K = 0;
            $row->CAN_VERIFY_PENGAWAS = 0;

            if ($butuhP3k && !$verifP3k) {
                $row->CAN_VERIFY_P3K = $isPetugasP3k ? 1 : 0;
            }

            $allowedToVerify = false;

            if (!$verifPengawas) {
                //$lolosTahapP3k = (!$butuhP3k) || $verifP3k;
                $lolosTahapP3k = true;

                if ($lolosTahapP3k && $jabatanPengisi !== $currentUserRole) {
                    if ($isOperator) {
                        $allowedToVerify = in_array($currentUserRole, ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT']);
                    } else {
                        switch ($jabatanPengisi) {
                            case 'FOREMAN':
                                $allowedToVerify = in_array($currentUserRole, ['SUPERVISOR', 'SUPERINTENDENT']);
                                break;
                            case 'SUPERVISOR':
                                $allowedToVerify = $currentUserRole === 'SUPERINTENDENT';
                                break;
                            case 'SUPERINTENDENT':
                            case 'PJS. SUPERINTENDENT':
                            case 'ASISTEN MANAGEMENT':
                                $allowedToVerify = $currentUserRole === 'MANAGEMENT';
                                break;
                            default:
                                $allowedToVerify = in_array($currentUserRole, ['FOREMAN', 'SUPERVISOR', 'SUPERINTENDENT']);
                        }
                    }
                }
            }

            $row->CAN_VERIFY_PENGAWAS = $allowedToVerify ? 1 : 0;

            return $row;
        });

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $filteredRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $kkhRows,
        ]);
    }

    public function verifikasi(Request $request)
    {

        // return $request->all();
        $rowID = $request->rowID;

        DB::connection('kkh')->table('web_kkh')
            ->where('id', $rowID)
            ->update([
                'ferivikasi_pengawas' => true,
                'nik_pengawas' => Auth::user()->nik,
                'fit_or' => 1,
            ]);

        return response()->json(['status' => 'ok']);
    }

    public function download(Request $request)
    {
        $namaKKH = $request->namaKKH;
        if (empty($request->rangeStart) || empty($request->rangeEnd)){
            $time = new DateTime();
            $startDate = $time->format('Y-m-d');
            $endDate = $time->format('Y-m-d');

            $start = new DateTime("$startDate");
            $end = new DateTime("$endDate");

        }else{
            $start = new DateTime("$request->rangeStart");
            $end = new DateTime("$request->rangeEnd");
        }
        $startTimeFormatted = $start->format('Y-m-d');
        $endTimeFormatted = $end->format('Y-m-d');

        $kkh = DB::connection('kkh')->table('db_payroll.dbo.web_kkh as kkh')
            ->leftJoin('db_payroll.dbo.tbl_data_hr as hr', 'kkh.nik', '=', 'hr.nik')
            ->leftJoin('db_payroll.dbo.tbl_data_hr as hr2', 'kkh.nik_pengawas', '=', 'hr2.nik')
            ->leftJoin('db_payroll.dbo.tm_departemen as dp', 'hr.Id_Departemen', '=', 'dp.ID_Departemen')
            ->leftJoin('db_payroll.dbo.tm_perusahaan as pr', 'hr.ID_Perusahaan', '=', 'pr.ID_Perusahaan')
            ->leftJoin('db_payroll.dbo.tm_jabatan as jb', 'hr.ID_Jabatan', '=', 'jb.ID_Jabatan')
            ->select(
                'kkh.id',
                'kkh.tgl',
                DB::raw("FORMAT(kkh.tgl_input, 'yyyy-MM-dd HH:mm') as TANGGAL_DIBUAT"),
                'pr.Perusahaan as PERUSAHAAN',
                'dp.Departemen as DEPARTEMEN',
                'jb.Jabatan as JABATAN',
                'hr.Nik as NIK_PENGISI',
                'hr.Nama as NAMA_PENGISI',
                'hr.Shift as SIKLUS_KERJA',
                DB::raw("
                    CASE
                        WHEN kkh.jam_pulang IS NULL OR LTRIM(RTRIM(kkh.jam_pulang)) = '' THEN '-'
                        ELSE
                            RIGHT('0' + LEFT(kkh.jam_pulang, CHARINDEX(':', kkh.jam_pulang) - 1), 2)
                            + ':' +
                            RIGHT('0' + RIGHT(kkh.jam_pulang, LEN(kkh.jam_pulang) - CHARINDEX(':', kkh.jam_pulang)), 2)
                    END AS JAM_PULANG
                "),
                DB::raw("
                    CASE
                        WHEN kkh.jam_tidur IS NULL OR LTRIM(RTRIM(kkh.jam_tidur)) = '' THEN '-'
                        ELSE
                            RIGHT('0' + LEFT(kkh.jam_tidur, CHARINDEX(':', kkh.jam_tidur) - 1), 2)
                            + ':' +
                            RIGHT('0' + RIGHT(kkh.jam_tidur, LEN(kkh.jam_tidur) - CHARINDEX(':', kkh.jam_tidur)), 2)
                    END AS JAM_TIDUR
                "),
                DB::raw("
                    CASE
                        WHEN kkh.jam_bangun IS NULL OR LTRIM(RTRIM(kkh.jam_bangun)) = '' THEN '-'
                        ELSE
                            RIGHT('0' + LEFT(kkh.jam_bangun, CHARINDEX(':', kkh.jam_bangun) - 1), 2)
                            + ':' +
                            RIGHT('0' + RIGHT(kkh.jam_bangun, LEN(kkh.jam_bangun) - CHARINDEX(':', kkh.jam_bangun)), 2)
                    END AS JAM_BANGUN
                "),
                DB::raw("
                    STR(
                        ROUND(
                            CASE
                                WHEN DATEDIFF(MINUTE, kkh.jam_tidur, kkh.jam_bangun) < 0 THEN
                                    DATEDIFF(MINUTE, kkh.jam_tidur, DATEADD(DAY, 1, kkh.jam_bangun)) / 60.0
                                ELSE
                                    DATEDIFF(MINUTE, kkh.jam_tidur, kkh.jam_bangun) / 60.0
                            END, 1
                        ), 10, 1
                    ) AS TOTAL_TIDUR
                "),
                 DB::raw("
                    CASE
                        WHEN kkh.jam_berangkat IS NULL OR LTRIM(RTRIM(kkh.jam_berangkat)) = '' THEN '-'
                        ELSE
                            RIGHT('0' + LEFT(kkh.jam_berangkat, CHARINDEX(':', kkh.jam_berangkat) - 1), 2)
                            + ':' +
                            RIGHT('0' + RIGHT(kkh.jam_berangkat, LEN(kkh.jam_berangkat) - CHARINDEX(':', kkh.jam_berangkat)), 2)
                    END AS JAM_BERANGKAT
                "),
                // DB::raw("
                //     CASE
                //         WHEN kkh.fit_or IS NULL THEN '-'
                //         WHEN kkh.fit_or = 0 THEN 'TIDAK'
                //         ELSE 'YA'
                //     END as FIT_BEKERJA
                // "),
                DB::raw("CASE WHEN kkh.fit_or IS NULL OR kkh.fit_or = 0 THEN 'Perlu Verifikasi' ELSE 'Ya' END as FIT_BEKERJA"),
                DB::raw('UPPER(kkh.keluhan) as KELUHAN'),
                'kkh.masalah_pribadi as MASALAH_PRIBADI',
                'kkh.verifikasi as VERIFIKASI',
                'kkh.nama_verifikasi as NAMA_VERIFIKASI',
                'kkh.ferivikasi_pengawas',
                'kkh.nik_pengawas as NIK_PENGAWAS',
                'hr2.Nama as NAMA_PENGAWAS'
            )
            // ->where('dp.Departemen', 'Production')
            ->whereBetween('kkh.tgl', [$startTimeFormatted, $endTimeFormatted]);

        if (!empty($request->namaKKH)) {
            $kkh->where('hr.Nik', $namaKKH);
        }

        $kkh = $kkh
            ->orderBy('kkh.tgl')
            ->get();

        $absen = DB::connection('kkh')
            ->table('db_payroll.dbo.hr_tbl_absen_harian')
            ->select('Tahun','Bulan','Tgl','ID_Absen')
            ->where('NIK', $namaKKH)
            ->where(function($q) use ($start, $end){

                $q->whereBetween(DB::raw("DATEFROMPARTS(Tahun,Bulan,Tgl)"), [
                    $start->format('Y-m-d'),
                    $end->format('Y-m-d')
                ]);

            })
            ->get()
            ->keyBy(function ($item) {
                return Carbon::create($item->Tahun,$item->Bulan,$item->Tgl)->format('Y-m-d');
            });

        $period = CarbonPeriod::create($startTimeFormatted, $endTimeFormatted);

        $kkhByDate = $kkh->keyBy(function ($item) {
            return Carbon::parse($item->tgl)->format('Y-m-d');
        });

        $finalData = collect();

        foreach ($period as $date) {

            $tgl = $date->format('Y-m-d');

            $absenId = isset($absen[$tgl]) ? $absen[$tgl]->ID_Absen : null;

            if (isset($kkhByDate[$tgl])) {

                $row = $kkhByDate[$tgl];
                $row->DATA_KOSONG = false;
                $row->ID_ABSEN = $absenId;

                $finalData->push($row);

        } else {

                $row = new \stdClass();
                $row->id = null;
                $row->tgl = $tgl;

                $row->ID_ABSEN = $absenId;

                $row->NIK_PENGAWAS = null;
                $row->NAMA_PENGAWAS = '-';
                $row->QR_CODE_PENGAWAS = null;

                $row->TANGGAL_DIBUAT = '-';
                $row->PERUSAHAAN = '-';
                $row->DEPARTEMEN = '-';
                $row->JABATAN = '-';
                $row->NIK_PENGISI = '-';
                $row->NAMA_PENGISI = '-';
                $row->SIKLUS_KERJA = '-';
                $row->JAM_PULANG = '-';
                $row->JAM_TIDUR = '-';
                $row->JAM_BANGUN = '-';
                $row->TOTAL_TIDUR = '-';
                $row->JAM_BERANGKAT = '-';
                $row->FIT_BEKERJA = '-';
                $row->KELUHAN = '-';
                $row->MASALAH_PRIBADI = '-';
                $row->VERIFIKASI = '-';
                $row->NAMA_VERIFIKASI = '-';

                $row->DATA_KOSONG = true;

                $finalData->push($row);
            }
        }

        $kkh = $finalData;

        if ($kkh->isEmpty()) {
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        } else {
            foreach ($kkh as $item) {

                $qrTempFolder = storage_path('app/qr-temp');
                if (!File::exists($qrTempFolder)) {
                    File::makeDirectory($qrTempFolder, 0755, true);
                }

                if ($item->NIK_PENGAWAS != null) {
                    $fileName = 'qr_pengawas_' . $item->id . '.png';
                    $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                    QrCode::size(150)->format('png')->generate(route('verified.index', ['encodedNik' => base64_encode($item->NIK_PENGAWAS)]), $filePath);

                    $item->QR_CODE_PENGAWAS = $filePath;
                } else {
                    $item->QR_CODE_PENGAWAS = null;
                }
            }
        }

        $identitas = DB::connection('kkh')
        ->table('db_payroll.dbo.tbl_data_hr as hr')
        ->leftJoin('db_payroll.dbo.tm_departemen as dp', 'hr.Id_Departemen', '=', 'dp.ID_Departemen')
        ->leftJoin('db_payroll.dbo.tm_perusahaan as pr', 'hr.ID_Perusahaan', '=', 'pr.ID_Perusahaan')
        ->leftJoin('db_payroll.dbo.tm_jabatan as jb', 'hr.ID_Jabatan', '=', 'jb.ID_Jabatan')
        ->select(
            'pr.Perusahaan',
            'dp.Departemen',
            'jb.Jabatan',
            'hr.Nik',
            'hr.Nama',
            'hr.Shift'
        )
        ->where('hr.Nik', $namaKKH)
        ->first();

        $pdf = PDF::loadView('kkh.download', compact('kkh', 'identitas'));

        return $pdf->download('KKH - ' . $identitas->Nama . '.pdf');
    }

    public function dashboard()
    {
        $now = Carbon::now();

        $user = DB::connection('daily_foreman')
            ->table('users')
            ->where('nik', Auth::user()->nik)
            ->first();

        $role = strtoupper(trim($user->role ?? ''));
        $departemenId = (int) ($user->departemen_id ?? 0);

        if ($role === 'SEPERVISOR') {
            $role = 'SUPERVISOR';
        }

        $canSeeAll =
            in_array($role, ['ADMIN', 'MANAGEMENT']) ||
            (in_array($role, ['SUPERVISOR', 'SUPERINTENDENT']) && $departemenId === 9);

        $kkh = DB::connection('kkh')
            ->table('db_payroll.dbo.web_kkh as kkh')
            ->leftJoin('db_payroll.dbo.tbl_data_hr as hr', 'kkh.nik', '=', 'hr.nik')
            ->leftJoin('db_payroll.dbo.tbl_data_hr as hr2', 'kkh.nik_pengawas', '=', 'hr2.nik')
            ->leftJoin('db_payroll.dbo.tm_departemen as dp', 'hr.Id_Departemen', '=', 'dp.ID_Departemen')
            ->leftJoin('db_payroll.dbo.tm_perusahaan as pr', 'hr.ID_Perusahaan', '=', 'pr.ID_Perusahaan')
            ->leftJoin('db_payroll.dbo.tm_jabatan as jb', 'hr.ID_Jabatan', '=', 'jb.ID_Jabatan')
            ->select(
                'kkh.id',
                'kkh.tgl',
                DB::raw("FORMAT(kkh.tgl_input, 'yyyy-MM-dd HH:mm') as TANGGAL_DIBUAT"),
                'hr.Nik as NIK_PENGISI',
                'hr.Nama as NAMA_PENGISI',
                'kkh.shift_kkh as SHIFT',
                'jb.Jabatan as JABATAN',
                'dp.DEPARTEMEN as DEPARTEMEN',
                DB::raw("
                    CASE
                        WHEN kkh.jam_pulang IS NULL OR LTRIM(RTRIM(kkh.jam_pulang)) = '' THEN '-'
                        ELSE
                            RIGHT('0' + LEFT(kkh.jam_pulang, CHARINDEX(':', kkh.jam_pulang) - 1), 2)
                            + ':' +
                            RIGHT('0' + RIGHT(kkh.jam_pulang, LEN(kkh.jam_pulang) - CHARINDEX(':', kkh.jam_pulang)), 2)
                    END AS JAM_PULANG
                "),
                DB::raw("
                    CASE
                        WHEN kkh.jam_tidur IS NULL OR LTRIM(RTRIM(kkh.jam_tidur)) = '' THEN '-'
                        ELSE
                            RIGHT('0' + LEFT(kkh.jam_tidur, CHARINDEX(':', kkh.jam_tidur) - 1), 2)
                            + ':' +
                            RIGHT('0' + RIGHT(kkh.jam_tidur, LEN(kkh.jam_tidur) - CHARINDEX(':', kkh.jam_tidur)), 2)
                    END AS JAM_TIDUR
                "),
                DB::raw("
                    CASE
                        WHEN kkh.jam_bangun IS NULL OR LTRIM(RTRIM(kkh.jam_bangun)) = '' THEN '-'
                        ELSE
                            RIGHT('0' + LEFT(kkh.jam_bangun, CHARINDEX(':', kkh.jam_bangun) - 1), 2)
                            + ':' +
                            RIGHT('0' + RIGHT(kkh.jam_bangun, LEN(kkh.jam_bangun) - CHARINDEX(':', kkh.jam_bangun)), 2)
                    END AS JAM_BANGUN
                "),
                DB::raw("
                    STR(
                        ROUND(
                            CASE
                                WHEN DATEDIFF(MINUTE, kkh.jam_tidur, kkh.jam_bangun) < 0 THEN
                                    DATEDIFF(MINUTE, kkh.jam_tidur, DATEADD(DAY, 1, kkh.jam_bangun)) / 60.0
                                ELSE
                                    DATEDIFF(MINUTE, kkh.jam_tidur, kkh.jam_bangun) / 60.0
                            END, 1
                        ), 10, 1
                    ) AS TOTAL_TIDUR
                "),
                DB::raw("
                    CASE
                        WHEN kkh.jam_berangkat IS NULL OR LTRIM(RTRIM(kkh.jam_berangkat)) = '' THEN '-'
                        ELSE
                            RIGHT('0' + LEFT(kkh.jam_berangkat, CHARINDEX(':', kkh.jam_berangkat) - 1), 2)
                            + ':' +
                            RIGHT('0' + RIGHT(kkh.jam_berangkat, LEN(kkh.jam_berangkat) - CHARINDEX(':', kkh.jam_berangkat)), 2)
                    END AS JAM_BERANGKAT
                "),
                'kkh.fit_or as FIT_BEKERJA',
                DB::raw('UPPER(kkh.keluhan) as KELUHAN'),
                'kkh.masalah_pribadi as MASALAH_PRIBADI',
                'kkh.ferivikasi_pengawas',
                'kkh.nik_pengawas as NIK_PENGAWAS',
                'hr2.Nama as NAMA_PENGAWAS'
            )
            ->whereNotIn('jb.Jabatan', ['Manager', 'Asisten Manager', 'Superintendent', 'Pjs. Superintendent'])
            ->whereDate('kkh.tgl', $now)
            ->when(!$canSeeAll, function ($q) use ($departemenId) {
                $q->whereRaw('CAST(hr.Id_Departemen AS INT) = ?', [$departemenId]);
            });

        $dataKKH = $kkh->get();

        $kkhBelumDiverifikasi = $dataKKH->where('ferivikasi_pengawas', '!=', 1);
        $kkhUnfit = $dataKKH->where('FIT_BEKERJA', '!=', 1);
        $kkhdibawah6Jam = $dataKKH->filter(function ($item) {
            return floatval(trim($item->TOTAL_TIDUR)) < 6;
        });

        return view('kkh.dashboard', [
            'kkhBelumDiverifikasi' => $kkhBelumDiverifikasi,
            'kkhUnfit' => $kkhUnfit,
            'kkhdibawah6Jam' => $kkhdibawah6Jam,
        ]);
    }
}
