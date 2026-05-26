<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\ChecklistP2H;
use App\Models\ChecklistP2HDetail;
use App\Models\FLTShift;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class P2HController extends Controller
{
    //
    public function index()
    {
        $shift = FLTShift::all();
        $data = [
            'shift' => $shift
        ];

        return view('safety.p2h.index', compact('data'));
    }

    public function monitoring()
    {
        $shift = FLTShift::all();
        $data = [
            'shift' => $shift
        ];

        return view('safety.p2h.monitoring', compact('data'));
    }

    public function api_monitoring(Request $request)
    {
        $start = new DateTime($request->tanggalP2H);
        $tanggalP2H = $start->format('Y-m-d');

        $offset = $request->input('start', 0);
        $length = $request->input('length', 10);
        $draw = $request->input('draw');

        $verifikator = DB::table('OPR_CHECKLISTP2H as p2h')
                ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'p2h.VERIFIED_FOREMAN', '=', 'gl.NRP')
                ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'p2h.VERIFIED_SUPERVISOR', '=', 'spv.NRP')
                ->leftJoin('focus.dbo.PRS_PERSONAL as mec', 'p2h.VERIFIED_MEKANIK', '=', 'mec.NRP')
                ->select(
                    'p2h.VHC_ID',
                    'p2h.OPR_SHIFTNO',
                    'p2h.OPR_REPORTTIME',
                    'p2h.VERIFIED_MEKANIK',
                    'mec.PERSONALNAME as NAMAMEKANIK',
                    'p2h.VERIFIED_FOREMAN',
                    'gl.PERSONALNAME as NAMAFOREMAN',
                    'p2h.VERIFIED_SUPERVISOR',
                    'spv.PERSONALNAME as NAMASUPERVISOR',
                    'p2h.VERIFIED_SUPERINTENDENT',
                )->get();

        $supportQuery = DB::connection('focus')->table('FOCUS.dbo.OPR_OPRCHECKLIST as A')
            ->select(
                'A.ID',
                DB::raw("FORMAT(A.OPR_REPORTTIME, 'yyyy-MM-dd HH:mm:ss') as OPR_REPORTTIME"),
                'A.OPR_SHIFTDATE',
                'A.OPR_SHIFTNO',
                'B.SHIFTDESC as OPR_SHIFTDESC',
                'A.OPR_NRP',
                'D.PERSONALNAME',
                'A.VHC_ID',
                'A.MTR_HOURMETER',
                DB::raw('COALESCE(C.VAL_NOTOK, 0) as VAL_NOTOK'),
                'p2h.VERIFIED_MEKANIK',
                'mec.PERSONALNAME as NAMAMEKANIK',
                'p2h.VERIFIED_FOREMAN',
                'gl.PERSONALNAME as NAMAFOREMAN',
                'p2h.VERIFIED_SUPERVISOR',
                'spv.PERSONALNAME as NAMASUPERVISOR'
            )
            ->leftJoin('FOCUS.dbo.FLT_SHIFT as B', 'A.OPR_SHIFTNO', '=', 'B.SHIFTNO')
            ->leftJoin('FOCUS.dbo.PRS_PERSONAL as D', 'A.OPR_NRP', '=', 'D.NRP')
            ->leftJoin(DB::raw('(
                SELECT VHC_ID, OPR_REPORTTIME, COUNT(*) AS VAL_NOTOK
                FROM FOCUS.dbo.OPR_OPRCHECKLISTITEM
                WHERE CHECKLISTVAL = 0
                GROUP BY VHC_ID, OPR_REPORTTIME
            ) as C'), function($join) {
                $join->on('C.VHC_ID', '=', 'A.VHC_ID')
                    ->on('C.OPR_REPORTTIME', '=', 'A.OPR_REPORTTIME');
            })
            ->leftJoin('OPR_CHECKLISTP2H as p2h', function($join) {
                $join->on('A.VHC_ID', '=', 'p2h.VHC_ID')
                    ->on('A.OPR_REPORTTIME', '=', 'p2h.OPR_REPORTTIME');
            })
            ->leftJoin('focus.dbo.PRS_PERSONAL as mec', 'p2h.VERIFIED_MEKANIK', '=', 'mec.NRP')
            ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'p2h.VERIFIED_FOREMAN', '=', 'gl.NRP')
            ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'p2h.VERIFIED_SUPERVISOR', '=', 'spv.NRP');
            if (in_array(Auth::user()->position, ['FOREMAN MEKANIK', 'PJS FOREMAN MEKANIK', 'JR FOREMAN MEKANIK', 'SUPERVISOR MEKANIK', 'LEADER MEKANIK'])) {
            $supportQuery->where('VAL_NOTOK', '>=', '1');
        }

        if ($request->search['value']) {
            $searchValue = '%' . $request->search['value'] . '%';
            $columnsToSearch = ['A.OPR_NRP', 'D.PERSONALNAME', 'A.VHC_ID'];

            $supportQuery->where(function($query) use ($columnsToSearch, $searchValue) {
                foreach ($columnsToSearch as $column) {
                    $query->orWhere($column, 'like', $searchValue);
                }
            });
        }

        if (!empty($request->shiftP2H)) {
            $supportQuery->where('A.OPR_SHIFTNO', $request->shiftP2H);
        }

        if (!empty($request->tanggalP2H)) {
            $supportQuery->where('A.OPR_SHIFTDATE', $tanggalP2H);
        }

        if(in_array(Auth::user()->position, ['FOREMAN MEKANIK', 'PJS FOREMAN MEKANIK', 'JR FOREMAN MEKANIK', 'SUPERVISOR MEKANIK', 'LEADER MEKANIK']) and Auth::user()->section == 'WHEEL') {
            $supportQuery->where(function($query) {
                $query->where('A.VHC_ID', 'like', 'MG%')
                    ->orWhere('A.VHC_ID', 'like', 'HD%');
            });
        }elseif(in_array(Auth::user()->position, ['FOREMAN MEKANIK', 'PJS FOREMAN MEKANIK', 'JR FOREMAN MEKANIK', 'SUPERVISOR MEKANIK', 'LEADER MEKANIK']) and in_array(Auth::user()->section, ['TRACK EXCA'])) {
            $supportQuery->where(function($query) {
                $query->where('A.VHC_ID', 'like', 'EX%');
            });
        }elseif(in_array(Auth::user()->position, ['FOREMAN MEKANIK', 'PJS FOREMAN MEKANIK', 'JR FOREMAN MEKANIK', 'SUPERVISOR MEKANIK', 'LEADER MEKANIK']) and in_array(Auth::user()->section, ['TRACK DOZER'])) {
            $supportQuery->where(function($query) {
                $query->where('A.VHC_ID', 'like', 'BD%');
            });
        }

        $supportQuery->where(function($query) {
            $query->whereNotNull('p2h.VERIFIED_FOREMAN')
                  ->orWhereNotNull('p2h.VERIFIED_SUPERVISOR')
                  ->orWhereNotNull('VAL_NOTOK', '>=', '1');
        });

        $filteredRecords = $supportQuery->count();

        $supportQuery = $supportQuery
            ->orderByDesc('VAL_NOTOK')

            ->orderBy('A.VHC_ID')
            ->orderBy('A.OPR_REPORTTIME')
            ->offset($offset)
            ->limit($length)
            ->get();

        // return $supportQuery;




        // $supportQuery->whereNotExists(function ($query) use ($verifikator) {
        //     $query->select(DB::raw(1))
        //         ->from('OPR_CHECKLISTP2H as p2h')
        //         ->whereColumn('p2h.VHC_ID', 'A.VHC_ID')
        //         ->whereColumn('p2h.OPR_SHIFTNO', 'A.OPR_SHIFTNO')
        //         ->whereDate('p2h.OPR_REPORTTIME', DB::raw("CAST(A.OPR_SHIFTDATE AS DATE)"));
        // });


        // Return JSON response
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $filteredRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $supportQuery,
        ]);
    }

    public function api(Request $request)
    {
        $limit = $request->input('length', 10);
        $offset = $request->input('start', 0);

        $pageNumber = ($limit > 0) ? ($offset / $limit) + 1 : 1;
        $pageSize = ($limit > 0) ? $limit : 500;

        $shiftDate = !empty($request->tanggalP2H)
            ? date('Y-m-d', strtotime($request->tanggalP2H))
            : null;

        $searchValueTrim = $request->search['value'] ?? null;

        $shiftP2H = $request->input('shiftP2H');

        $shiftNo = in_array((int)$shiftP2H, [6,7], true)
            ? (int)$shiftP2H
            : null;

        $cluster = in_array($request->cluster, ['EX','HD','MG','BD'])
            ? $request->cluster
            : null;

        $statusVerifikasi = $request->input('statusVerifikasi');

        $userRoleList = [
            'FOREMAN',
            'PJS FOREMAN',
            'SUPERVISOR',
            'PJS SUPERVISOR'
        ];

        $isForeman =
            in_array(Auth::user()->role, $userRoleList)
            && Auth::user()->departemen_id == 11;

        $userSection = $isForeman
            ? Auth::user()->section
            : null;

        /*
        |--------------------------------------------------------------------------
        | USERS (SQL SERVER)
        |--------------------------------------------------------------------------
        */
        $users = DB::connection('daily_foreman')
            ->table('users')
            ->select('nik', 'name')
            ->get()
            ->keyBy(fn($u) => trim($u->nik));


        $checklistIds = DB::connection('p2h')
            ->table('opr_oprchecklist')
            ->select(
                'uuid',
                'vhc_id',
                'opr_reporttime',
                'opr_nrp',
                'opr_shiftno',
                'opr_shiftdate',
                'mtr_hourmeter',
                'verified_operator',
                'dateverified_operator',
                'verified_mekanik',
                'dateverified_mekanik',
                'verified_foreman',
                'dateverified_foreman',
                'verified_supervisor',
                'dateverified_supervisor'
            )

            ->when($shiftNo, fn($q) =>
                $q->where('opr_shiftno', $shiftNo)
            )

            ->when($shiftDate, fn($q) =>
                $q->whereDate('opr_shiftdate', $shiftDate)
            )

            ->when($cluster, fn($q) =>
                $q->where('vhc_id', 'like', $cluster.'%')
            )

            ->when($searchValueTrim, function($q) use ($searchValueTrim){

                $q->where(function($q2) use ($searchValueTrim){

                    $q2->where('opr_nrp', 'ilike', "%{$searchValueTrim}%")
                    ->orWhere('vhc_id', 'ilike', "%{$searchValueTrim}%");

                });
            })

            ->when(
                $statusVerifikasi == 'Sudah Diverifikasi',
                function ($q) {

                    $q->where(function ($q2) {

                        $q2->whereNotNull('verified_foreman')
                        ->orWhereNotNull('verified_supervisor');

                    });
                }
            )

            ->when(
                $statusVerifikasi == 'Belum Diverifikasi',
                function ($q) {

                    $q->where(function ($q2) {

                        $q2->whereNull('verified_foreman')
                        ->whereNull('verified_supervisor');

                    });
                }
            )

            ->get();


        /*
        |--------------------------------------------------------------------------
        | NOT OK COUNTS
        |--------------------------------------------------------------------------
        */
        $notOkCounts = DB::connection('p2h')
            ->table('opr_oprchecklistitem')
            ->select(
                'vhc_id',
                'opr_reporttime',
                DB::raw('count(*) as total_notok')
            )
            ->whereIn(
                'vhc_id',
                $checklistIds->pluck('vhc_id')->unique()->toArray()
            )
            ->whereIn(
                'opr_reporttime',
                $checklistIds->pluck('opr_reporttime')->unique()->toArray()
            )
            ->where('checklistval', 0)
            ->groupBy('vhc_id', 'opr_reporttime')
            ->get()
            ->keyBy(fn($item) =>
                trim($item->vhc_id) . '_' .
                Carbon::parse($item->opr_reporttime)->format('Y-m-d H:i:s')
            );

        /*
        |--------------------------------------------------------------------------
        | P2H DATA (POSTGRESQL)
        |--------------------------------------------------------------------------
        */
        $p2hData = DB::connection('p2h')
            ->table('opr_oprchecklist as p')
            ->whereIn(
                'p.vhc_id',
                $checklistIds->pluck('vhc_id')->unique()->toArray()
            )
            ->whereIn(
                'p.opr_reporttime',
                $checklistIds->pluck('opr_reporttime')->unique()->toArray()
            )
            ->select([
                'p.*'
            ])
            ->get()
            ->keyBy(fn($row) =>
                trim($row->vhc_id) . '_' .
                Carbon::parse($row->opr_reporttime)->format('Y-m-d H:i:s')
            );

        /*
        |--------------------------------------------------------------------------
        | RESULTS
        |--------------------------------------------------------------------------
        */
        $results = $checklistIds->map(function($row)
            use (
                $users,
                $p2hData,
                $notOkCounts,
                $isForeman,
                $userSection
            ) {

            $vhcId = $row->vhc_id ?? null;
            $vhcPrefix = substr($vhcId, 0, 2);

            $oprReportTime = $row->opr_reporttime ?? null;
            $oprName = optional(
                $users->get(
                    strtoupper(trim($row->opr_nrp ?? ''))
                )
            )->name;

            if (!$vhcId || !$oprReportTime) {
                return null;
            }

            $opr_nrp_fix =
                (substr($row->opr_nrp ?? '', -2) === 'S1')
                ? substr($row->opr_nrp,0,-1)
                : ($row->opr_nrp ?? '');

            $key =
                trim($vhcId) . '_' .
                Carbon::parse($oprReportTime)->format('Y-m-d H:i:s');

            $p2h = $p2hData[$key] ?? null;

            $valNotOk =
                $notOkCounts[$key]->total_notok ?? 0;

            $sectionOk = true;

            if ($isForeman && $userSection) {

                if (
                    $userSection == 'WHEEL'
                    && !str_starts_with($vhcId, 'MG')
                    && !str_starts_with($vhcId, 'HD')
                ) {
                    $sectionOk = false;
                }

                if (
                    $userSection == 'TRACK EXCA'
                    && !str_starts_with($vhcId, 'EX')
                ) {
                    $sectionOk = false;
                }

                if (
                    $userSection == 'TRACK DOZER'
                    && !str_starts_with($vhcId, 'BD')
                ) {
                    $sectionOk = false;
                }
            }

            if (!$sectionOk) {
                return null;
            }

            return (object)[

                'VHC_ID' => $vhcId,

                'VHC_PREFIX' => $vhcPrefix,

                'OPR_REPORTTIME' => $oprReportTime,

                'OPR_NRP' => $opr_nrp_fix,

                'PERSONALNAME' => $oprName,

                'VAL_NOTOK' => $valNotOk,

                'DATEVERIFIED_OPERATOR' =>
                    $p2h?->dateverified_operator ?? null,

                'VERIFIED_OPERATOR' =>
                    $p2h?->verified_operator ?? null,

                'DATEVERIFIED_MEKANIK' =>
                    $p2h?->dateverified_mekanik ?? null,

                'VERIFIED_MEKANIK' =>
                    $p2h?->verified_mekanik ?? null,

                'NAMAMEKANIK' =>
                    $users[
                        trim($p2h?->verified_mekanik ?? '')
                    ]->name ?? null,

                'DATEVERIFIED_FOREMAN' =>
                    $p2h?->dateverified_foreman
                    ?? $p2h?->dateverified_supervisor
                    ?? null,

                'VERIFIED_FOREMAN' =>
                    $p2h?->verified_foreman
                    ?? $p2h?->verified_supervisor
                    ?? null,

                'NAMAFOREMAN' =>
                    $users[
                        trim(
                            $p2h?->verified_foreman
                            ?? $p2h?->verified_supervisor
                            ?? ''
                        )
                    ]->name ?? null,

                'DATEVERIFIED_SUPERVISOR' =>
                    $p2h?->dateverified_supervisor ?? null,

                'VERIFIED_SUPERVISOR' =>
                    $p2h?->verified_supervisor ?? null,

                'NAMASUPERVISOR' =>
                    $users[
                        trim($p2h?->verified_supervisor ?? '')
                    ]->name ?? null,

                'MTR_HOURMETER' =>
                    $row->mtr_hourmeter ?? null,

                'OPR_SHIFTDATE' =>
                    $row->opr_shiftdate ?? null,

                'OPR_SHIFTNO' =>
                    $row->opr_shiftno ?? null,

                'IS_FOREMAN_ROW' =>
                    $isForeman && !$sectionOk,

                'SECTION_OK' =>
                    $sectionOk
            ];

        })->filter()->values();

        $totalRecords = $results->count();

        /*
        |--------------------------------------------------------------------------
        | SORTING
        |--------------------------------------------------------------------------
        */
        $results = $results->sort(function ($a, $b) {

            if ($a->VAL_NOTOK != $b->VAL_NOTOK) {
                return $b->VAL_NOTOK <=> $a->VAL_NOTOK;
            }

            return strcmp($a->VHC_ID, $b->VHC_ID);

        })->values();

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $results
        ]);
    }

    public function show(Request $request)
    {

        if (empty($request->rangeStart) || empty($request->rangeEnd)) {

            $time = new DateTime();

            $start = new DateTime($time->format('Y-m-d'));
            $end   = new DateTime($time->format('Y-m-d'));

        } else {

            $start = new DateTime($request->rangeStart);
            $end   = new DateTime($request->rangeEnd);
        }

        $startTimeFormatted = $start->format('Y-m-d');
        $endTimeFormatted   = $end->format('Y-m-d');

        /*
        |--------------------------------------------------------------------------
        | USERS (POSTGRES)
        |--------------------------------------------------------------------------
        */
        $users = DB::connection('daily_foreman')
            ->table('users')
            ->select('nik', 'name')
            ->get()
            ->keyBy(fn($u) => trim($u->nik));

        /*
        |--------------------------------------------------------------------------
        | SHIFT
        |--------------------------------------------------------------------------
        */
        $shiftMap = DB::connection('focus')
            ->table('FLT_SHIFT')
            ->select('SHIFTNO', 'SHIFTDESC')
            ->get()
            ->keyBy('SHIFTNO');

        /*
        |--------------------------------------------------------------------------
        | DATA P2H POSTGRES
        |--------------------------------------------------------------------------
        */
        $data = DB::connection('p2h')
            ->table('opr_oprchecklist as p2h')
            ->select(
                'p2h.uuid',
                'p2h.statusenabled',
                'p2h.vhc_id',
                'p2h.mtr_hourmeter',
                'p2h.opr_shiftno',
                'p2h.opr_reporttime',
                'p2h.sys_createdat',
                'p2h.verified_operator',
                'p2h.dateverified_operator',
                'p2h.verified_mekanik',
                'p2h.dateverified_mekanik',
                'p2h.verified_foreman',
                'p2h.dateverified_foreman',
                'p2h.verified_supervisor',
                'p2h.dateverified_supervisor'
            )
            ->whereBetween(
                DB::raw('DATE(p2h.opr_reporttime)'),
                [$startTimeFormatted, $endTimeFormatted]
            )
            ->where(function ($query) {

        $query->whereNotNull('p2h.verified_foreman')
            ->orWhereNotNull('p2h.verified_supervisor');

    })
            ->where('p2h.statusenabled', true)
            ->get()
            ->map(function ($row) use ($users, $shiftMap) {

                $row->SHIFTDESC =
                    $shiftMap[$row->opr_shiftno]->SHIFTDESC
                    ?? null;

                $row->NAMAOPERATOR =
                    $users[trim($row->verified_operator ?? '')]->name
                    ?? null;

                $row->NAMAMEKANIK =
                    $users[trim($row->verified_mekanik ?? '')]->name
                    ?? null;

                $row->NAMAFOREMAN =
                    $users[trim($row->verified_foreman ?? '')]->name
                    ?? null;

                $row->NAMASUPERVISOR =
                    $users[trim($row->verified_supervisor ?? '')]->name
                    ?? null;

                $row->NAMASUPERINTENDENT =
                    $users[trim($row->verified_superintendent ?? '')]->name
                    ?? null;

                return $row;

            });

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */
        return view(
            'safety.p2h.show',
            compact('data')
        );
    }

    public function verifikasi(Request $request)
{
    $request->validate([
        'VHC_ID' => 'required|string',
        'OPR_REPORTTIME' => 'required|date',
        'OPR_NRP' => 'required|string'
    ]);

    DB::beginTransaction();

    try {

        /*
        |--------------------------------------------------------------------------
        | MASTER CHECKLIST
        |--------------------------------------------------------------------------
        */
        $checklistItems = DB::connection('focus')
            ->table('FLT_EQUCHECKLISTITEM')
            ->select(
                'checklistgroupid',
                'checklistitemid',
                'checklistitemdescription'
            )
            ->get();

        $checklistMap = [];

        foreach ($checklistItems as $item) {

            $groupId = strtoupper(trim((string)$item->checklistgroupid));
            $itemId  = trim((string)$item->checklistitemid);

            $checklistMap[$groupId][$itemId]
                = $item->checklistitemdescription;
        }

        /*
        |--------------------------------------------------------------------------
        | DETAIL
        |--------------------------------------------------------------------------
        */
        $oprReportTime = Carbon::parse(
            $request['OPR_REPORTTIME']
        )->format('Y-m-d H:i:s');

        $detail = DB::connection('p2h')
            ->table('opr_oprchecklistitem as a')
            ->select(
                'a.id',
                'a.uuid',
                'a.equ_typeid',
                'a.checklistgroupid',
                'a.checklistitemid',
                'a.checklistnotes',
                'a.checklistval',
                'a.opr_reporttime',
                'a.opr_shiftdate',
                'a.opr_shiftno',
                'a.vhc_id'
            )
            ->where('a.vhc_id', $request['VHC_ID'])
            ->whereRaw(
                "date_trunc('second', a.opr_reporttime) = ?::timestamp",
                [$oprReportTime]
            )
            ->orderBy('a.checklistgroupid')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | MAPPING DESCRIPTION
        |--------------------------------------------------------------------------
        */
        $groupKeys = array_keys($checklistMap);

        usort($groupKeys, function ($a, $b) {
            return strlen($b) <=> strlen($a);
        });

        $detail = $detail->map(function ($row)
            use ($checklistMap, $groupKeys) {

            $groupId = strtoupper(trim((string)$row->checklistgroupid));
            $itemId  = trim((string)$row->checklistitemid);

            $description = null;

            if (isset($checklistMap[$groupId][$itemId])) {

                $description =
                    $checklistMap[$groupId][$itemId];
            }

            if ($description === null) {

                foreach ($groupKeys as $groupKey) {

                    if (
                        ($groupId === $groupKey
                        || str_contains($groupId, $groupKey))
                        && isset(
                            $checklistMap[$groupKey][$itemId]
                        )
                    ) {

                        $description =
                            $checklistMap[$groupKey][$itemId];

                        break;
                    }
                }
            }

            if ($description === null) {

                foreach ($groupKeys as $groupKey) {

                    if (isset($checklistMap[$groupKey][$itemId])) {

                        $description =
                            $checklistMap[$groupKey][$itemId];

                        break;
                    }
                }
            }

            $row->checklistitemdescription =
                $description ?? null;

            return $row;

        })
        ->unique(function ($row) {

            return strtoupper(
                trim((string)$row->checklistgroupid)
            )
            . '|'
            . strtoupper(
                trim((string)$row->checklistitemdescription)
            );

        })
        ->values();

        $first = $detail->first();

        if (!$first) {

            return response()->json([
                'error' => 'Detail checklist tidak ditemukan'
            ], 404);
        }

        /*
        |--------------------------------------------------------------------------
        | HEADER POSTGRES
        |--------------------------------------------------------------------------
        */
        $checkdataP2H = ChecklistP2H::where(
                'vhc_id',
                $first->vhc_id
            )
            ->where(
                'opr_shiftno',
                $first->opr_shiftno
            )
            ->whereRaw(
                "date_trunc('second', opr_reporttime) = ?::timestamp",
                [$oprReportTime]
            )
            ->first();

        if (!$checkdataP2H) {

            return response()->json([
                'error' => 'Header checklist tidak ditemukan'
            ], 404);
        }

        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        */
        $user = Auth::user();

        $role = strtoupper(trim($user->role));

        $departemenId = (int)$user->departemen_id;

        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA
        |--------------------------------------------------------------------------
        */
        if ($departemenId == 11) {

            $updateData = [
                'verified_mekanik' => $user->nik,
                'dateverified_mekanik' => now(),
            ];

        } elseif ($departemenId == 8) {

            $updateData = match ($role) {

                'FOREMAN' => [
                    'verified_foreman' => $user->nik,
                    'dateverified_foreman' => now(),
                ],

                'SUPERVISOR' => [
                    'verified_supervisor' => $user->nik,
                    'dateverified_supervisor' => now(),
                ],

                default => abort(
                    403,
                    'Anda tidak memiliki akses verifikasi.'
                ),
            };

        } else {

            abort(
                403,
                'Departemen tidak memiliki akses.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE HEADER
        |--------------------------------------------------------------------------
        */
        $checkdataP2H->update($updateData);


        foreach ($detail as $item) {

            $groupKey = strtoupper(
                trim((string)$item->checklistgroupid)
            );

            $descKey = strtoupper(
                trim((string)$item->checklistitemdescription)
            );

            ChecklistP2HDetail::where(
                'vhc_id',
                $first->vhc_id
            )
            ->whereRaw(
                "date_trunc('second', opr_reporttime) = ?::timestamp",
                [$oprReportTime]
            )
            ->where(
                'checklistgroupid',
                $item->checklistgroupid
            )
            ->where(
                'checklistitemid',
                $item->checklistitemid
            )
            ->update([
                'sys_updatedby' => $user->nik,
                'sys_updatedat' => now(),
            ]);
        }

        DB::commit();

        return response()->json([
            'status' => 'ok'
        ]);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'error' => 'Gagal memverifikasi data',
            'message' => $e->getMessage()
        ], 500);
    }
}

    public function detail_monitoring(Request $request)
    {
       $detail = DB::table('FOCUS.dbo.OPR_OPRCHECKLISTITEM as A')
        ->select(
            'A.ID',
            'A.CHECKLISTGROUPID',
            'A.CHECKLISTITEMID',
            'B.CHECKLISTITEMDESCRIPTION',
            'A.CHECKLISTNOTES',
            'A.CHECKLISTVAL',
            'A.CHECKLISTVAL as VAL',
            'A.OPR_REPORTTIME',
            'A.OPR_SHIFTDATE',
            'A.OPR_SHIFTNO',
            'A.VHC_ID',
        )
        ->leftJoin('FOCUS.dbo.FLT_EQUCHECKLISTITEM as B', function($join) {
            $join->on('A.EQU_TYPEID', '=', 'B.EQU_TYPEID')
                ->on('A.CHECKLISTGROUPID', '=', 'B.CHECKLISTGROUPID')
                ->on('A.CHECKLISTITEMID', '=', 'B.CHECKLISTITEMID');
        })
        ->leftJoin('FOCUS.dbo.FLT_EQUCHECKLISTGROUP as C', function($join) {
            $join->on('A.EQU_TYPEID', '=', 'C.EQU_TYPEID')
                ->on('A.CHECKLISTGROUPID', '=', 'C.CHECKLISTGROUPID');
        })
        ->where('A.VHC_ID', $request['VHC_ID'])
        ->whereRaw("DATEADD(ms, -DATEPART(ms, A.OPR_REPORTTIME), A.OPR_REPORTTIME) = ?", [$request['OPR_REPORTTIME']])
        ->orderBy('A.CHECKLISTGROUPID')
        ->orderBy('B.CHECKLISTITEMDESCRIPTION')
        ->get()
        ->unique('CHECKLISTITEMDESCRIPTION');

        // dd($detail);



        $jumlahAATerisi = $detail->filter(function ($item) {
            return $item->CHECKLISTVAL == 0 && ($item->CHECKLISTGROUPID == 'AA' || $item->CHECKLISTGROUPID == 'A');
        })->count();

        // dd($jumlahAATerisi);

        $checkdataP2H = ChecklistP2H::where('VHC_ID', $detail->first()->VHC_ID)
        ->where('OPR_SHIFTNO', $detail->first()->OPR_SHIFTNO)
        ->where('OPR_REPORTTIME', $detail->first()->OPR_REPORTTIME)->first();

        $verifikasiMekanik = false;
        $detailP2H = "";

        if($checkdataP2H != null){
            if($checkdataP2H->VERIFIED_MEKANIK != null){
                $verifikasiMekanik = true;

                $detailP2H = DB::table('OPR_CHECKLISTP2H as p2h')
                ->leftJoin('OPR_CHECKLISTP2H_DETAIL as ph', 'p2h.UUID', '=', 'ph.UUID_OPR_CHECKLISTP2H')
                ->select(
                    'ph.GROUPID as CHECKLISTGROUPID',
                    'ph.GROUPID as CHECKLISTGROUPDESCRIPTION',
                    'ph.ITEMDESCRIPTION as CHECKLISTITEMDESCRIPTION',
                    'ph.VALUE as CHECKLISTVAL',
                    'ph.NOTES as CHECKLISTNOTES',
                    'ph.CATATAN_MEKANIK',
                    'ph.KBJ',
                    'ph.JAWABAN',
                    'p2h.OPR_REPORTTIME',
                    'p2h.OPR_SHIFTDATE',
                    'p2h.OPR_SHIFTNO',
                    'p2h.VHC_ID',
                    'p2h.MTR_HOURMETER',
                    )
                ->where('UUID_OPR_CHECKLISTP2H', $checkdataP2H->UUID)->where('p2h.STATUSENABLED', true)->get();

                $normalizedDetailP2H = $detailP2H->map(function ($item) {
                    return (object)[
                        'ID' => null,
                        'CHECKLISTGROUPID' => $item->CHECKLISTGROUPID,
                        'CHECKLISTITEMID' => null,
                        'CHECKLISTITEMDESCRIPTION' => $item->CHECKLISTITEMDESCRIPTION,
                        'CHECKLISTNOTES' => $item->CHECKLISTNOTES,
                        'CHECKLISTVAL' => $item->CHECKLISTVAL,
                        'VAL' => $item->CHECKLISTVAL,
                        'CATATAN_MEKANIK' => $item->CATATAN_MEKANIK ?? null,
                        'KBJ' => $item->KBJ ?? null,
                        'JAWABAN' => $item->JAWABAN ?? null,
                        'OPR_REPORTTIME' => $item->OPR_REPORTTIME,
                        'OPR_SHIFTDATE' => $item->OPR_SHIFTDATE,
                        'OPR_SHIFTNO' => $item->OPR_SHIFTNO,
                        'VHC_ID' => $item->VHC_ID,
                        'SOURCE' => 'P2H',
                    ];
                });

                $normalizedDetail = $detail->map(function ($item) {
                    return (object)[
                    'ID' => $item->ID,
                    'CHECKLISTGROUPID' => $item->CHECKLISTGROUPID,
                    'CHECKLISTITEMID' => $item->CHECKLISTITEMID,
                    'CHECKLISTITEMDESCRIPTION' => $item->CHECKLISTITEMDESCRIPTION,
                    'CHECKLISTNOTES' => $item->CHECKLISTNOTES,
                    'CHECKLISTVAL' => $item->CHECKLISTVAL,
                    'VAL' => $item->VAL,
                    'CATATAN_MEKANIK' => null,
                    'KBJ' => null,
                    'JAWABAN' => null,
                    'OPR_REPORTTIME' => $item->OPR_REPORTTIME,
                    'OPR_SHIFTDATE' => $item->OPR_SHIFTDATE,
                    'OPR_SHIFTNO' => $item->OPR_SHIFTNO,
                    'VHC_ID' => $item->VHC_ID,
                    'SOURCE' => 'DETAIL',
                ];
                });

                $keyFn = fn($item) => implode('|', [
                    $item->CHECKLISTGROUPID,
                    $item->CHECKLISTITEMDESCRIPTION,
                    $item->VHC_ID,
                    $item->OPR_REPORTTIME
                ]);

                $combined = $normalizedDetailP2H->keyBy($keyFn);

                $normalizedDetail->each(function ($item) use (&$combined, $keyFn) {
                    $key = $keyFn($item);
                    if (! $combined->has($key)) {
                        $combined->put($key, $item);
                    }
                });

                $detailP2H = $combined->values();


            }else{
                $verifikasiMekanik = false;
            }
        }



        if($checkdataP2H == null){
            ChecklistP2H::create([
                'UUID' => (string) Uuid::uuid4()->toString(),
                'STATUSENABLED' => true,
                'CREATED_BY' => Auth::user()->id,
                'VHC_ID' => $detail->first()->VHC_ID,
                'MTR_HOURMETER' => $request['MTR_HOURMETER'],
                'OPR_SHIFTNO' => $detail->first()->OPR_SHIFTNO,
                'OPR_REPORTTIME' => $detail->first()->OPR_REPORTTIME,
                'OPR_SHIFTDATE' => $detail->first()->OPR_SHIFTDATE,
                'VERIFIED_OPERATOR' => $request['OPR_NRP'],
                'DATEVERIFIED_OPERATOR' => $detail->first()->OPR_REPORTTIME,
            ]);
        }

        // dd($detailP2H);
        // dd($detail);

        // dd($verifikasiMekanik);
        // dd($jumlahAATerisi);

        if(substr($detail->first()->VHC_ID, 0, 2) == 'EX'){
            return view('safety.p2h.detail_monitoring.ex', compact('detail', 'jumlahAATerisi', 'verifikasiMekanik', 'detailP2H', 'checkdataP2H'));

        }elseif(substr($detail->first()->VHC_ID, 0, 2) == 'HD'){
            return view('safety.p2h.detail_monitoring.hd', compact('detail', 'jumlahAATerisi', 'verifikasiMekanik', 'detailP2H', 'checkdataP2H'));

        }elseif(substr($detail->first()->VHC_ID, 0, 2) == 'BD'){
            return view('safety.p2h.detail_monitoring.bd', compact('detail', 'jumlahAATerisi', 'verifikasiMekanik', 'detailP2H', 'checkdataP2H'));

        }elseif(substr($detail->first()->VHC_ID, 0, 2) == 'MG'){
            return view('safety.p2h.detail_monitoring.mg', compact('detail', 'jumlahAATerisi', 'verifikasiMekanik', 'detailP2H', 'checkdataP2H'));

        }else{
            return view('safety.p2h.detail_monitoring.hd', compact('detail', 'jumlahAATerisi', 'verifikasiMekanik', 'detailP2H', 'checkdataP2H'));

        }
    }


    public function detail(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | CHECKLIST GROUP
        |--------------------------------------------------------------------------
        */
        $groups = DB::connection('focus')
            ->table('FLT_EQUCHECKLISTGROUP')
            ->select(
                'EQU_TYPEID',
                'CHECKLISTGROUPID',
                'CHECKLISTGROUPDESCRIPTION'
            )
            ->get()
            ->keyBy(fn($row) =>
                strtoupper(trim($row->EQU_TYPEID))
                . '_'
                . strtoupper(trim($row->CHECKLISTGROUPID))
            );

        /*
        |--------------------------------------------------------------------------
        | CHECKLIST ITEM MASTER
        |--------------------------------------------------------------------------
        */
        $checklistItems = DB::connection('focus')
            ->table('FLT_EQUCHECKLISTITEM')
            ->select(
                'EQU_TYPEID',
                'CHECKLISTGROUPID',
                'CHECKLISTITEMID',
                'CHECKLISTITEMDESCRIPTION'
            )
            ->get();

        $checklistMap = [];

        foreach ($checklistItems as $item) {

            $groupKey = strtoupper(
                trim((string)$item->CHECKLISTGROUPID)
            );

            $itemKey = trim(
                (string)$item->CHECKLISTITEMID
            );

            $checklistMap[$groupKey][$itemKey]
                = $item->CHECKLISTITEMDESCRIPTION;
        }

        /*
        |--------------------------------------------------------------------------
        | REPORT TIME
        |--------------------------------------------------------------------------
        */
        $oprReportTime = Carbon::parse(
            $request['OPR_REPORTTIME']
        )->format('Y-m-d H:i:s');

        /*
        |--------------------------------------------------------------------------
        | DETAIL FROM POSTGRES
        |--------------------------------------------------------------------------
        */
        $detail = DB::connection('p2h')
            ->table('opr_oprchecklistitem as a')
            ->select(
                'a.id',
                'a.uuid',
                'a.equ_typeid',
                'a.checklistgroupid',
                'a.checklistitemid',
                'a.checklistnotes',
                'a.checklistval',
                'a.catatan_mekanik',
                'a.kbj',
                'a.jawaban',
                'a.opr_reporttime',
                'a.opr_shiftdate',
                'a.opr_shiftno',
                'a.vhc_id'
            )
            ->where(
                'a.vhc_id',
                $request['VHC_ID']
            )
            ->whereRaw(
                "date_trunc('second', a.opr_reporttime) = ?::timestamp",
                [$oprReportTime]
            )
            ->orderBy('a.checklistgroupid')
            ->orderBy('a.checklistitemid')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | DESCRIPTION MAPPING
        |--------------------------------------------------------------------------
        */
        $groupKeys = array_keys($checklistMap);

        usort($groupKeys, fn($a, $b) =>
            strlen($b) <=> strlen($a)
        );

        $detail = $detail->map(function ($row)
            use ($groups, $checklistMap, $groupKeys) {

            $groupId = strtoupper(
                trim((string)$row->checklistgroupid)
            );

            $itemId = trim(
                (string)$row->checklistitemid
            );

            $description = null;

            if (isset($checklistMap[$groupId][$itemId])) {

                $description =
                    $checklistMap[$groupId][$itemId];
            }

            if ($description === null) {

                foreach ($groupKeys as $grpKey) {

                    if (
                        str_contains($groupId, $grpKey)
                        && isset(
                            $checklistMap[$grpKey][$itemId]
                        )
                    ) {

                        $description =
                            $checklistMap[$grpKey][$itemId];

                        break;
                    }
                }
            }

            if ($description === null) {

                foreach ($groupKeys as $grpKey) {

                    if (isset($checklistMap[$grpKey][$itemId])) {

                        $description =
                            $checklistMap[$grpKey][$itemId];

                        break;
                    }
                }
            }

            $row->checklistitemdescription =
                $description ?? 'Deskripsi tidak tersedia';

            return $row;

        })
        ->unique(fn($row) =>
            strtoupper(
                trim((string)$row->checklistgroupid)
            )
            . '|'
            . strtoupper(
                trim((string)$row->checklistitemdescription)
            )
        )
        ->values();

        /*
        |--------------------------------------------------------------------------
        | COUNT AA / A
        |--------------------------------------------------------------------------
        */
        $jumlahAATerisi = $detail->filter(function ($item) {

            return $item->checklistval == 0
                && (
                    $item->checklistgroupid == 'AA'
                    || $item->checklistgroupid == 'A'
                );

        })->count();

        /*
        |--------------------------------------------------------------------------
        | HEADER POSTGRES
        |--------------------------------------------------------------------------
        */
        $checkdataP2H = ChecklistP2H::where(
                'vhc_id',
                $detail->first()->vhc_id
            )
            ->where(
                'opr_shiftno',
                $detail->first()->opr_shiftno
            )
            ->whereRaw(
                "date_trunc('second', opr_reporttime) = ?::timestamp",
                [$oprReportTime]
            )
            ->first();

        /*
        |--------------------------------------------------------------------------
        | VERIFIKASI MEKANIK
        |--------------------------------------------------------------------------
        */
        $verifikasiMekanik = false;

        $detailP2H = collect();

        if ($checkdataP2H != null) {

            if ($checkdataP2H->verified_mekanik != null) {

                $verifikasiMekanik = true;

                $detailP2H = DB::connection('p2h')
                    ->table('opr_oprchecklistitem')
                    ->select(
                        'uuid as UUID',
                        'checklistgroupid as CHECKLISTGROUPID',
                        'checklistitemid as CHECKLISTITEMID',
                        'checklistnotes as CHECKLISTNOTES',
                        'checklistval as CHECKLISTVAL',
                        'catatan_mekanik as CATATAN_MEKANIK',
                        'kbj as KBJ',
                        'jawaban as JAWABAN',
                        'opr_reporttime as OPR_REPORTTIME',
                        'opr_shiftdate as OPR_SHIFTDATE',
                        'opr_shiftno as OPR_SHIFTNO',
                        'vhc_id as VHC_ID'
                    )
                    ->where(
                        'vhc_id',
                        $checkdataP2H->vhc_id
                    )
                    ->whereRaw(
                        "date_trunc('second', opr_reporttime) = ?::timestamp",
                        [
                            Carbon::parse(
                                $checkdataP2H->opr_reporttime
                            )->format('Y-m-d H:i:s')
                        ]
                    )
                    ->orderBy('checklistgroupid')
                    ->orderBy('checklistitemid')
                    ->get();

                $detailP2H = $detailP2H->map(function ($item)
                    use ($checklistMap, $groupKeys) {

                    $groupId = strtoupper(
                        trim((string)$item->CHECKLISTGROUPID)
                    );

                    $itemId = trim(
                        (string)$item->CHECKLISTITEMID
                    );

                    $description = null;

                    if (isset($checklistMap[$groupId][$itemId])) {

                        $description =
                            $checklistMap[$groupId][$itemId];
                    }

                    if ($description === null) {

                        foreach ($groupKeys as $grpKey) {

                            if (
                                str_contains($groupId, $grpKey)
                                && isset(
                                    $checklistMap[$grpKey][$itemId]
                                )
                            ) {

                                $description =
                                    $checklistMap[$grpKey][$itemId];

                                break;
                            }
                        }
                    }

                    if ($description === null) {

                        foreach ($groupKeys as $grpKey) {

                            if (isset($checklistMap[$grpKey][$itemId])) {

                                $description =
                                    $checklistMap[$grpKey][$itemId];

                                break;
                            }
                        }
                    }

                    $item->CHECKLISTITEMDESCRIPTION =
                        $description ?? 'Deskripsi tidak tersedia';

                    return $item;

                })
                ->unique(function ($item) {

                    return strtoupper(
                        trim($item->CHECKLISTGROUPID)
                    )
                    . '|'
                    . trim($item->CHECKLISTITEMID);

                })
                ->values();

            } else {

                $verifikasiMekanik = false;
            }
        }

        if ($checkdataP2H == null) {

            ChecklistP2H::create([

                'uuid' =>
                    (string)Uuid::uuid4()->toString(),

                'statusenabled' => true,

                'sys_createdby' =>
                    Auth::user()->nik,

                'sys_createdat' => now(),

                'vhc_id' =>
                    $detail->first()->vhc_id,

                'mtr_hourmeter' =>
                    $request['MTR_HOURMETER'],

                'opr_shiftno' =>
                    $detail->first()->opr_shiftno,

                'opr_reporttime' =>
                    $detail->first()->opr_reporttime,

                'opr_shiftdate' =>
                    $detail->first()->opr_shiftdate,

                'verified_operator' =>
                    $request['OPR_NRP'],

                'dateverified_operator' =>
                    $detail->first()->opr_reporttime,
            ]);
        }

        $detail = $detail->map(function ($row) {

            return (object)[

                'ID' =>
                    $row->id,

                    'UUID' =>
                    $row->uuid,

                'EQU_TYPEID' =>
                    strtoupper($row->equ_typeid ?? ''),

                'CHECKLISTGROUPID' =>
                    strtoupper($row->checklistgroupid ?? ''),

                'CHECKLISTITEMID' =>
                    $row->checklistitemid,

                'CHECKLISTNOTES' =>
                    $row->checklistnotes,

                'CHECKLISTVAL' =>
                    $row->checklistval,

                'CATATAN_MEKANIK' =>
                    $row->catatan_mekanik,

                'KBJ' =>
                    $row->kbj,

                'JAWABAN' =>
                    $row->jawaban,

                'OPR_REPORTTIME' =>
                    $row->opr_reporttime,

                'OPR_SHIFTDATE' =>
                    $row->opr_shiftdate,

                'OPR_SHIFTNO' =>
                    $row->opr_shiftno,

                'VHC_ID' =>
                    strtoupper($row->vhc_id ?? ''),

                'CHECKLISTITEMDESCRIPTION' =>
                    $row->checklistitemdescription ?? null,
            ];
        });

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */
        $prefix = substr(
            $detail->first()->VHC_ID,
            0,
            2
        );


        if ($prefix == 'EX') {

            return view(
                'safety.p2h.detail.ex',
                compact(
                    'detail',
                    'jumlahAATerisi',
                    'verifikasiMekanik',
                    'detailP2H',
                    'checkdataP2H'
                )
            );

        } elseif ($prefix == 'HD') {

            return view(
                'safety.p2h.detail.hd',
                compact(
                    'detail',
                    'jumlahAATerisi',
                    'verifikasiMekanik',
                    'detailP2H',
                    'checkdataP2H'
                )
            );

        } elseif ($prefix == 'BD') {

            return view(
                'safety.p2h.detail.bd',
                compact(
                    'detail',
                    'jumlahAATerisi',
                    'verifikasiMekanik',
                    'detailP2H',
                    'checkdataP2H'
                )
            );

        } elseif ($prefix == 'MG') {

            return view(
                'safety.p2h.detail.mg',
                compact(
                    'detail',
                    'jumlahAATerisi',
                    'verifikasiMekanik',
                    'detailP2H',
                    'checkdataP2H'
                )
            );

        } else {

            return view(
                'safety.p2h.detail.hd',
                compact(
                    'detail',
                    'jumlahAATerisi',
                    'verifikasiMekanik',
                    'detailP2H',
                    'checkdataP2H'
                )
            );
        }
    }

    public function preview($uuid)
    {
        $data = DB::table('prd_opr_checklistp2h as p2h')
        ->leftJoin('prd_opr_checklistp2h_list as ph', 'p2h.UUID', '=', 'ph.UUID_OPR_CHECKLISTP2H')
        ->leftJoin('focus.focus.dbo.FLT_SHIFT as sh', 'p2h.OPR_SHIFTNO', '=', 'sh.SHIFTNO')
        ->leftJoin('users as opr', 'p2h.VERIFIED_OPERATOR', '=', 'opr.nik')
        ->leftJoin('users as gl', 'p2h.VERIFIED_FOREMAN', '=', 'gl.nik')
        ->leftJoin('users as spv', 'p2h.VERIFIED_SUPERVISOR', '=', 'spv.nik')
        ->leftJoin('users as spt', 'p2h.VERIFIED_SUPERINTENDENT', '=', 'spt.nik')
        ->leftJoin('users as mec', 'p2h.VERIFIED_MEKANIK', '=', 'mec.nik')
        ->select(
            'p2h.UUID',
            'p2h.STATUSENABLED',
            'p2h.VHC_ID',
            'p2h.MTR_HOURMETER',
            'sh.SHIFTDESC',
            'p2h.OPR_REPORTTIME',
            'p2h.VERIFIED_OPERATOR',
            'p2h.DATEVERIFIED_OPERATOR',
            'p2h.VERIFIED_MEKANIK',
            'opr.name as NAMAOPERATOR',
            'p2h.DATEVERIFIED_MEKANIK',
            'mec.name as NAMAMEKANIK',
            'p2h.VERIFIED_FOREMAN',
            'gl.name as NAMAFOREMAN',
            'p2h.DATEVERIFIED_FOREMAN',
            'p2h.VERIFIED_SUPERVISOR',
            'spv.name as NAMASUPERVISOR',
            'p2h.DATEVERIFIED_SUPERVISOR',
            'p2h.VERIFIED_SUPERINTENDENT',
            'spt.name as NAMASUPERINTENDENT',
            'p2h.DATEVERIFIED_SUPERINTENDENT',
            'ph.GROUPID',
            'ph.ITEMDESCRIPTION',
            'ph.VALUE',
            'ph.CATATAN_MEKANIK',
            'ph.NOTES',
            'ph.KBJ',
            'ph.JAWABAN',
        )
        ->where('ph.UUID_OPR_CHECKLISTP2H', $uuid)
        ->where('p2h.STATUSENABLED', true)
        ->orderBy('ph.GROUPID')
        ->orderBy('ph.ITEMDESCRIPTION')
        // ->where(function ($query) {
        //     $query->whereNotNull('p2h.DATEVERIFIED_FOREMAN')
        //         ->orWhereNotNull('p2h.DATEVERIFIED_SUPERVISOR');
        // })
        ->get();

        if($data->isEmpty()){
            return redirect()->back()->with('info', 'Maaf, data P2H belum diverifikasi');
        }

        if(substr($data->first()->VHC_ID, 0, 2) == 'EX'){
            return view('safety.p2h.preview.ex', compact('data'));

        }elseif(substr($data->first()->VHC_ID, 0, 2) == 'HD'){
            return view('safety.p2h.preview.hd', compact('data'));

        }elseif(substr($data->first()->VHC_ID, 0, 2) == 'BD'){
            return view('safety.p2h.preview.bd', compact('data'));

        }elseif(substr($data->first()->VHC_ID, 0, 2) == 'MG'){
            return view('safety.p2h.preview.mg', compact('data'));

        }else{
            return view('safety.p2h.preview.hd', compact('data'));

        }
    }

    public function verifiedSuperintendent($uuid)
    {
        try {
            $updateData = [
                'VERIFIED_SUPERINTENDENT' => Auth::user()->nik,
                'DATEVERIFIED_SUPERINTENDENT' => Carbon::now(),
            ];

        ChecklistP2H::where('UUID', $uuid)->update($updateData);

        return redirect()->back()->with('success', 'P2H berhasil diverifikasi');
        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'P2H gagal diverifikasi');
        }
    }

    public function detail_post(Request $request)
{
    /*
    |--------------------------------------------------------------------------
    | VALIDASI ROLE
    |--------------------------------------------------------------------------
    */
    if (in_array(Auth::user()->role, ['ADMIN', 'MANAGEMENT'])) {

        return redirect()
            ->back()
            ->with(
                'info',
                'Maaf, verifikasi hanya dapat dilakukan oleh pengawas!'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | REQUEST
    |--------------------------------------------------------------------------
    */
    $uuid = $request->UUID;
    $uuidItems = $request->UUID ?? [];
    /*
    |--------------------------------------------------------------------------
    | HEADER POSTGRES
    |--------------------------------------------------------------------------
    */

    $groupIds = $request->CHECKLISTGROUPID ?? [];

    $kbjs = $request->KBJ ?? [];

    $mekanik = $request->CATATAN_MEKANIK ?? [];

    $jawabans = $request->JAWABAN ?? [];

    $count = count($groupIds);

    DB::beginTransaction();

    try {

        /*
        |--------------------------------------------------------------------------
        | UPDATE DETAIL POSTGRES
        |--------------------------------------------------------------------------
        */
        for ($i = 0; $i < $count; $i++) {

            ChecklistP2HDetail::where(
                    'uuid',
                    $uuidItems[$i]
                )
                ->update([

                    'kbj' =>
                        $kbjs[$i] ?? null,

                    'catatan_mekanik' =>
                        $mekanik[$i] ?? null,

                    'jawaban' =>
                        $jawabans[$i] ?? null,

                    'sys_updateby' =>
                        Auth::user()->nik,


                ]);
        }



        $role = strtoupper(
            trim(Auth::user()->role)
        );

        $departemenId = (int)
            Auth::user()->departemen_id;

        dd([
    'role_raw' => Auth::user()->role,
    'role_upper' => $role,
    'departemen_id' => $departemenId,
]);
        if (
            $departemenId == 11
            && in_array($role, [

                'FOREMAN',
                'SUPERVISOR',
                'SUPERINTENDENT',
            ])
        ) {

            /*
            |--------------------------------------------------------------------------
            | DEPT 11 = MEKANIK
            |--------------------------------------------------------------------------
            */
            $updateData = [

                'verified_mekanik' =>
                    Auth::user()->nik,

                'dateverified_mekanik' =>
                    Carbon::now(),
            ];

        } else {

            /*
            |--------------------------------------------------------------------------
            | NORMAL ROLE
            |--------------------------------------------------------------------------
            */
            $updateData = match ($role) {

                'FOREMAN' => [

                    'verified_foreman' =>
                        Auth::user()->nik,

                    'dateverified_foreman' =>
                        Carbon::now(),
                ],

                'SUPERVISOR' => [

                    'verified_supervisor' =>
                        Auth::user()->nik,

                    'dateverified_supervisor' =>
                        Carbon::now(),
                ],

                'SUPERINTENDENT' => [

                    'verified_superintendent' =>
                        Auth::user()->nik,

                    'dateverified_superintendent' =>
                        Carbon::now(),
                ],

                default => [

                    'verified_mekanik' =>
                        Auth::user()->nik,

                    'dateverified_mekanik' =>
                        Carbon::now(),
                ],
            };
        }

        /*
        |--------------------------------------------------------------------------
        | SYSTEM UPDATE
        |--------------------------------------------------------------------------
        */
        $updateData['sys_updateby']
            = Auth::user()->nik;

        $updateData['sys_updateat']
            = now();


        /*
        |--------------------------------------------------------------------------
        | UPDATE HEADER
        |--------------------------------------------------------------------------
        */
        ChecklistP2H::where(
        'vhc_id',
        $request->VHC_ID
    )
    ->whereRaw(
        "date_trunc('second', opr_reporttime) = ?::timestamp",
        [
            Carbon::parse(
                $request->OPR_REPORTTIME
            )->format('Y-m-d H:i:s')
        ]
    )
    ->update($updateData);

        DB::commit();

        return redirect()
            ->route('p2h.index')
            ->with(
                'success',
                'P2H berhasil diverifikasi'
            );

    } catch (\Throwable $th) {

        DB::rollBack();

        return redirect()
            ->route('p2h.index')
            ->with(
                'info',
                $th->getMessage()
            );
    }
}

    public function cetak($uuid)
    {
        $data = DB::table('prd_opr_checklistp2h as p2h')
        ->leftJoin('prd_opr_checklistp2h_list as ph', 'p2h.UUID', '=', 'ph.UUID_OPR_CHECKLISTP2H')
        ->leftJoin('focus.focus.dbo.FLT_SHIFT as sh', 'p2h.OPR_SHIFTNO', '=', 'sh.SHIFTNO')
        ->leftJoin('focus.focus.dbo.PRS_PERSONAL as opr', 'p2h.VERIFIED_OPERATOR', '=', 'opr.NRP')
        ->leftJoin('focus.focus.dbo.PRS_PERSONAL as gl', 'p2h.VERIFIED_FOREMAN', '=', 'gl.NRP')
        ->leftJoin('focus.focus.dbo.PRS_PERSONAL as spv', 'p2h.VERIFIED_SUPERVISOR', '=', 'spv.NRP')
        ->leftJoin('focus.focus.dbo.PRS_PERSONAL as spt', 'p2h.VERIFIED_SUPERINTENDENT', '=', 'spt.NRP')
        ->leftJoin('focus.focus.dbo.PRS_PERSONAL as mec', 'p2h.VERIFIED_MEKANIK', '=', 'mec.NRP')
        ->select(
            'p2h.UUID',
            'p2h.STATUSENABLED',
            'p2h.VHC_ID',
            'p2h.MTR_HOURMETER',
            'sh.SHIFTDESC',
            'p2h.OPR_REPORTTIME',
            'p2h.VERIFIED_OPERATOR',
            'p2h.DATEVERIFIED_OPERATOR',
            'opr.NRP as NRPOPERATOR',
            'opr.PERSONALNAME as NAMAOPERATOR',
            'p2h.VERIFIED_MEKANIK',
            'p2h.DATEVERIFIED_MEKANIK',
            'mec.NRP as NRPMEKANIK',
            'mec.PERSONALNAME as NAMAMEKANIK',
            'p2h.VERIFIED_FOREMAN',
            'gl.NRP as NRPFOREMAN',
            'gl.PERSONALNAME as NAMAFOREMAN',
            'p2h.DATEVERIFIED_FOREMAN',
            'p2h.VERIFIED_SUPERVISOR',
            'spv.NRP as NRPSUPERVISOR',
            'spv.PERSONALNAME as NAMASUPERVISOR',
            'p2h.DATEVERIFIED_SUPERVISOR',
            'p2h.VERIFIED_SUPERINTENDENT',
            'spt.NRP as NRPSUPERINTENDENT',
            'spt.PERSONALNAME as NAMASUPERINTENDENT',
            'p2h.DATEVERIFIED_SUPERINTENDENT',
            'ph.GROUPID',
            'ph.ITEMDESCRIPTION',
            'ph.VALUE',
            'ph.NOTES',
            'ph.KBJ',
            'ph.JAWABAN',
            'ph.CATATAN_MEKANIK',
        )
        ->where('ph.UUID_OPR_CHECKLISTP2H', $uuid)
        ->where('p2h.STATUSENABLED', true)
        ->orderBy('ph.GROUPID')
        ->orderBy('ph.ITEMDESCRIPTION')
        // ->where(function ($query) {
        //     $query->whereNotNull('p2h.DATEVERIFIED_FOREMAN')
        //         ->orWhereNotNull('p2h.DATEVERIFIED_SUPERVISOR');
        // })
        ->get();

        if ($data->isEmpty()) {
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        } else {
            foreach ($data as $item) {
                $item->VERIFIED_OPERATOR = $item->VERIFIED_OPERATOR != null
                    ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $item->NAMAOPERATOR)
                    : null;

                $item->VERIFIED_MEKANIK = $item->VERIFIED_MEKANIK != null
                    ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $item->NAMAMEKANIK)
                    : null;

                $item->VERIFIED_FOREMAN = $item->VERIFIED_FOREMAN != null
                    ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $item->NAMAFOREMAN)
                    : null;

                $item->VERIFIED_SUPERVISOR = $item->VERIFIED_SUPERVISOR != null
                    ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $item->NAMASUPERVISOR)
                    : null;

                $item->VERIFIED_SUPERINTENDENT = $item->VERIFIED_SUPERINTENDENT != null
                    ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $item->NAMASUPERINTENDENT)
                    : null;
            }
        }


        if(substr($data->first()->VHC_ID, 0, 2) == 'EX'){
            return view('safety.p2h.cetak.ex', compact('data'));

        }elseif(substr($data->first()->VHC_ID, 0, 2) == 'HD'){
            return view('safety.p2h.cetak.hd', compact('data'));

        }elseif(substr($data->first()->VHC_ID, 0, 2) == 'BD'){
            return view('safety.p2h.cetak.bd', compact('data'));

        }elseif(substr($data->first()->VHC_ID, 0, 2) == 'MG'){
            return view('safety.p2h.cetak.mg', compact('data'));

        }else{
            return view('safety.p2h.cetak.hd', compact('data'));

        }
    }

    public function download($uuid)
    {
        $data = DB::table('prd_opr_checklistp2h as p2h')
        ->leftJoin('prd_opr_checklistp2h_list as ph', 'p2h.UUID', '=', 'ph.UUID_OPR_CHECKLISTP2H')
        ->leftJoin('focus.focus.dbo.FLT_SHIFT as sh', 'p2h.OPR_SHIFTNO', '=', 'sh.SHIFTNO')
        ->leftJoin('focus.focus.dbo.PRS_PERSONAL as opr', 'p2h.VERIFIED_OPERATOR', '=', 'opr.NRP')
        ->leftJoin('focus.focus.dbo.PRS_PERSONAL as gl', 'p2h.VERIFIED_FOREMAN', '=', 'gl.NRP')
        ->leftJoin('focus.focus.dbo.PRS_PERSONAL as spv', 'p2h.VERIFIED_SUPERVISOR', '=', 'spv.NRP')
        ->leftJoin('focus.focus.dbo.PRS_PERSONAL as spt', 'p2h.VERIFIED_SUPERINTENDENT', '=', 'spt.NRP')
        ->leftJoin('focus.focus.dbo.PRS_PERSONAL as mec', 'p2h.VERIFIED_MEKANIK', '=', 'mec.NRP')
        ->select(
            'p2h.UUID',
            'p2h.STATUSENABLED',
            'p2h.VHC_ID',
            'p2h.MTR_HOURMETER',
            'sh.SHIFTDESC',
            'p2h.OPR_REPORTTIME',
            'p2h.VERIFIED_OPERATOR',
            'p2h.DATEVERIFIED_OPERATOR',
            'opr.NRP as NRPOPERATOR',
            'opr.PERSONALNAME as NAMAOPERATOR',
            'p2h.VERIFIED_MEKANIK',
            'p2h.DATEVERIFIED_MEKANIK',
            'mec.NRP as NRPMEKANIK',
            'mec.PERSONALNAME as NAMAMEKANIK',
            'p2h.VERIFIED_FOREMAN',
            'gl.NRP as NRPFOREMAN',
            'gl.PERSONALNAME as NAMAFOREMAN',
            'p2h.DATEVERIFIED_FOREMAN',
            'p2h.VERIFIED_SUPERVISOR',
            'spv.NRP as NRPSUPERVISOR',
            'spv.PERSONALNAME as NAMASUPERVISOR',
            'p2h.DATEVERIFIED_SUPERVISOR',
            'p2h.VERIFIED_SUPERINTENDENT',
            'spt.NRP as NRPSUPERINTENDENT',
            'spt.PERSONALNAME as NAMASUPERINTENDENT',
            'p2h.DATEVERIFIED_SUPERINTENDENT',
            'ph.GROUPID',
            'ph.ITEMDESCRIPTION',
            'ph.VALUE',
            'ph.NOTES',
            'ph.KBJ',
            'ph.JAWABAN',
            'ph.CATATAN_MEKANIK',
        )
        ->where('ph.UUID_OPR_CHECKLISTP2H', $uuid)
        ->where('p2h.STATUSENABLED', true)
        ->orderBy('ph.GROUPID')
        ->orderBy('ph.ITEMDESCRIPTION')
        // ->where(function ($query) {
        //     $query->whereNotNull('p2h.DATEVERIFIED_FOREMAN')
        //         ->orWhereNotNull('p2h.DATEVERIFIED_SUPERVISOR');
        // })
        ->get();

        if ($data->isEmpty()) {
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        } else {
            $item = $data->first();

            $qrTempFolder = storage_path('app/qr-temp');
                if (!File::exists($qrTempFolder)) {
                    File::makeDirectory($qrTempFolder, 0755, true);
                }

                if($item->VERIFIED_OPERATOR != null){
                    $fileName = 'VERIFIED_OPERATOR' . $item->UUID . '.png';
                    $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                    QrCode::size(150)->format('png')->generate('Telah dibuat oleh: ' . $item->NAMAOPERATOR, $filePath);
                    $item->VERIFIED_OPERATOR = $filePath;
                }else{
                    $item->VERIFIED_OPERATOR == null;
                }

                if($item->VERIFIED_MEKANIK != null){
                    $fileName = 'VERIFIED_MEKANIK' . $item->UUID . '.png';
                    $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                    QrCode::size(150)->format('png')->generate(route('verified.index', ['encodedNik' => base64_encode($item->VERIFIED_MEKANIK)]), $filePath);
                    $item->VERIFIED_MEKANIK = $filePath;
                }else{
                    $item->VERIFIED_MEKANIK == null;
                }

                if($item->VERIFIED_FOREMAN != null){
                    $fileName = 'VERIFIED_FOREMAN' . $item->UUID . '.png';
                    $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                    QrCode::size(150)->format('png')->generate(route('verified.index', ['encodedNik' => base64_encode($item->VERIFIED_FOREMAN)]), $filePath);
                    $item->VERIFIED_FOREMAN = $filePath;
                }else{
                    $item->VERIFIED_FOREMAN == null;
                }

                if($item->VERIFIED_SUPERVISOR != null){
                    $fileName = 'VERIFIED_SUPERVISOR' . $item->UUID . '.png';
                    $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                    QrCode::size(150)->format('png')->generate(route('verified.index', ['encodedNik' => base64_encode($item->VERIFIED_SUPERVISOR)]), $filePath);
                    $item->VERIFIED_SUPERVISOR = $filePath;
                }else{
                    $item->VERIFIED_SUPERVISOR == null;
                }

                if($item->VERIFIED_SUPERINTENDENT != null){
                    $fileName = 'VERIFIED_SUPERINTENDENT' . $item->UUID . '.png';
                    $filePath = $qrTempFolder . DIRECTORY_SEPARATOR . $fileName;

                    QrCode::size(150)->format('png')->generate(route('verified.index', ['encodedNik' => base64_encode($item->VERIFIED_SUPERINTENDENT)]), $filePath);
                    $item->VERIFIED_SUPERINTENDENT = $filePath;
                }else{
                    $item->VERIFIED_SUPERINTENDENT == null;
                }

        }



        if(substr($data->first()->VHC_ID, 0, 2) == 'EX'){
            $pdf = PDF::loadView('safety.p2h.download.ex', compact('data'));
            return $pdf->download('P2H Excavator-'. $data->first()->OPR_REPORTTIME .'-'. $data->first()->SHIFTDESC .'-'. $data->first()->VHC_ID .'.pdf');

        }elseif(substr($data->first()->VHC_ID, 0, 2) == 'HD'){
            $pdf = PDF::loadView('safety.p2h.download.hd', compact('data'));
            return $pdf->download('P2H Heavy Dump Truck-'. $data->first()->OPR_REPORTTIME .'-'. $data->first()->SHIFTDESC .'-'. $data->first()->VHC_ID .'.pdf');

        }elseif(substr($data->first()->VHC_ID, 0, 2) == 'BD'){
            $pdf = PDF::loadView('safety.p2h.download.bd', compact('data'));
            return $pdf->download('P2H Bull Dozer-'. $data->first()->OPR_REPORTTIME .'-'. $data->first()->SHIFTDESC .'-'. $data->first()->VHC_ID .'.pdf');

        }elseif(substr($data->first()->VHC_ID, 0, 2) == 'MG'){
            $pdf = PDF::loadView('safety.p2h.download.mg', compact('data'));
            return $pdf->download('P2H Motor Grader-'. $data->first()->OPR_REPORTTIME .'-'. $data->first()->SHIFTDESC .'-'. $data->first()->VHC_ID .'.pdf');

        }else{
            return redirect()->back()->with('info', 'Data tidak ditemukan');

        }
    }
}
