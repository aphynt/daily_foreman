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

        $offset = $request->input('start', 0);   // Offset
        $length = $request->input('length', 10); // Default 10 items
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

        // Optional: filter berdasarkan kata kunci pencarian
        if ($request->search['value']) {
            $searchValue = '%' . $request->search['value'] . '%';
            $columnsToSearch = ['A.OPR_NRP', 'D.PERSONALNAME', 'A.VHC_ID'];

            $supportQuery->where(function($query) use ($columnsToSearch, $searchValue) {
                foreach ($columnsToSearch as $column) {
                    $query->orWhere($column, 'like', $searchValue);
                }
            });
        }

        // Filter shift jika ada
        if (!empty($request->shiftP2H)) {
            $supportQuery->where('A.OPR_SHIFTNO', $request->shiftP2H);
        }

        // Filter tanggal jika ada
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

        //menampilkan hanya P2H yang diatas 0, dengan role sbb



        // Hanya ambil data yang sudah diverifikasi oleh foreman atau supervisor
        $supportQuery->where(function($query) {
            $query->whereNotNull('p2h.VERIFIED_FOREMAN')
                  ->orWhereNotNull('p2h.VERIFIED_SUPERVISOR')
                  ->orWhereNotNull('VAL_NOTOK', '>=', '1');
        });

        // Hitung total hasil filter
        $filteredRecords = $supportQuery->count();

        // Ambil data dengan urutan dan paginasi
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


        // Ambil data untuk halaman saat ini

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
        $pageSize = ($limit > 0) ? $limit : 50;
        $extraFetch = 3;
        $fetchSize = $pageSize * $extraFetch;

        $shiftDate = !empty($request->tanggalP2H) ? date('Y-m-d', strtotime($request->tanggalP2H)) : null;
        $searchValueTrim = $request->search['value'] ?? null;
        $shiftP2H = $request->input('shiftP2H');
        $shiftNo = in_array((int)$shiftP2H, [6,7], true) ? (int)$shiftP2H : null;
        $cluster = in_array($request->cluster, ['EX','HD','MG','BD']) ? $request->cluster : null;

        $userRoleList = ['FOREMAN MEKANIK','PJS FOREMAN MEKANIK','JR FOREMAN MEKANIK','SUPERVISOR MEKANIK','LEADER MEKANIK'];
        $isForeman = in_array(Auth::user()->position, $userRoleList);
        $userSection = $isForeman ? Auth::user()->section : null;

        // --- Users SQL Server ---
        $users = DB::connection('daily_foreman')->table('users')->get()->keyBy('NIK');

        // --- Ambil checklist IDs dari PostgreSQL ---
        $checklistIds = DB::connection('p2h')->table('opr_oprchecklist')
            ->select('vhc_id','opr_reporttime','opr_nrp','opr_shiftno','opr_shiftdate','mtr_hourmeter')
            ->when($shiftNo, fn($q) => $q->where('opr_shiftno', $shiftNo))
            ->when($shiftDate, fn($q) => $q->whereDate('opr_shiftdate', $shiftDate))
            ->when($cluster, fn($q) => $q->where('vhc_id','like',$cluster.'%'))
            ->when($searchValueTrim, fn($q) => $q->where(function($q2) use ($searchValueTrim){
                $q2->where('opr_nrp','ilike',"%{$searchValueTrim}%")
                ->orWhere('vhc_id','ilike',"%{$searchValueTrim}%");
            }))
            ->get();

        $oprTimes = $checklistIds->pluck('opr_reporttime')
            ->map(fn($t) => Carbon::parse($t)->format('Y-m-d H:i:s'))
            ->unique()
            ->toArray();

        // --- Ambil p2h data dari SQL Server ---
        $p2hData = DB::connection('daily_foreman')
            ->table('prd_opr_checklistp2h')
            ->whereIn('VHC_ID', $checklistIds->pluck('vhc_id')->unique()->toArray())
            ->where(function($query) use ($oprTimes) {
                foreach ($oprTimes as $time) {
                    $query->orWhereRaw("CONVERT(varchar(19), OPR_REPORTTIME, 120) = ?", [$time]);
                }
            })
            ->get()
            ->keyBy(fn($row) => trim($row->VHC_ID) . '_' . Carbon::parse($row->OPR_REPORTTIME)->format('Y-m-d H:i:s'));

        // --- Mapping checklist PostgreSQL ---
        $results = $checklistIds->map(function($row) use ($users, $p2hData, $isForeman, $userSection) {
            $vhcId = $row->vhc_id ?? null;
            $vhcPrefix = substr($vhcId, 0, 2); // ambil 2 huruf pertama

            $oprReportTime = $row->opr_reporttime ?? null;
            if (!$vhcId || !$oprReportTime) return null;

            $opr_nrp_fix = (substr($row->opr_nrp ?? '', -2) === 'S1') ? substr($row->opr_nrp,0,-1) : ($row->opr_nrp ?? '');
            $key = trim($vhcId) . '_' . Carbon::parse($oprReportTime)->format('Y-m-d H:i:s');
            $p2h = $p2hData[$key] ?? null;

            $personal = $users[$opr_nrp_fix] ?? null;
            $mekanik = $p2h?->VERIFIED_MEKANIK ? ($users[$p2h->VERIFIED_MEKANIK] ?? null) : null;
            $foreman = $p2h?->VERIFIED_FOREMAN ? ($users[$p2h->VERIFIED_FOREMAN] ?? null) : null;
            $supervisor = $p2h?->VERIFIED_SUPERVISOR ? ($users[$p2h->VERIFIED_SUPERVISOR] ?? null) : null;

            // Filter section untuk mekanik
            $sectionOk = true;
            if ($isForeman && $userSection) {
                if ($userSection==='WHEEL' && !str_starts_with($vhcId,'MG%') && !str_starts_with($vhcId,'HD%')) $sectionOk=false;
                if ($userSection==='TRACK EXCA' && !str_starts_with($vhcId,'EX')) $sectionOk=false;
                if ($userSection==='TRACK DOZER' && !str_starts_with($vhcId,'BD')) $sectionOk=false;
            }

            return (object)[
                'VHC_ID' => $vhcId,
                'VHC_PREFIX' => $vhcPrefix,
                'OPR_REPORTTIME' => $oprReportTime,
                'OPR_NRP' => $opr_nrp_fix,
                'PERSONALNAME' => $personal?->NAME ?? null,
                'VAL_NOTOK' => DB::connection('p2h')->table('opr_oprchecklistitem')
                                    ->where('vhc_id',$vhcId)
                                    ->where('opr_reporttime',$oprReportTime)
                                    ->where('checklistval',0)
                                    ->count(),
                'DATEVERIFIED_MEKANIK' => $p2h?->DATEVERIFIED_MEKANIK ?? null,
                'VERIFIED_MEKANIK' => $p2h?->VERIFIED_MEKANIK ?? null,
                'NAMAMEKANIK' => $mekanik?->NAME ?? null,
                'DATEVERIFIED_FOREMAN' => $p2h?->DATEVERIFIED_FOREMAN ?? $p2h?->DATEVERIFIED_SUPERVISOR ?? null,
                'VERIFIED_FOREMAN' => $p2h?->VERIFIED_FOREMAN ?? $p2h?->VERIFIED_SUPERVISOR ?? null,
                'NAMAFOREMAN' => $foreman?->NAME ?? $supervisor?->NAME ?? null,
                'DATEVERIFIED_SUPERVISOR' => $p2h?->DATEVERIFIED_SUPERVISOR ?? null,
                'VERIFIED_SUPERVISOR' => $p2h?->VERIFIED_SUPERVISOR ?? null,
                'NAMASUPERVISOR' => $supervisor?->NAME ?? null,
                'MTR_HOURMETER' => $row->mtr_hourmeter ?? null,
                'OPR_SHIFTDATE' => $row->opr_shiftdate ?? null,
                'OPR_SHIFTNO' => $row->opr_shiftno ?? null,
                'IS_FOREMAN_ROW' => $isForeman && !$sectionOk,
                'SECTION_OK' => $sectionOk
            ];
        })->filter()->values();

        $totalRecords = $results->count();

        // --- Sorting ---
        $results = $results->sortBy(function($row) {
            $priority = (!$row->NAMAFOREMAN) ? 0 : ((!$row->NAMASUPERVISOR) ? 1 : 2);
            $valNotOk = -($row->VAL_NOTOK ?? 0);
            return [$priority, $valNotOk];
        })->values();

        // --- Slice untuk pagination DataTables ---
        $results = $results->slice(0, $pageSize)->values();

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $results
        ]);
    }

    public function show(Request $request)
    {

        if (empty($request->rangeStart) || empty($request->rangeEnd)){
            $time = new DateTime();
            $startDate = $time->format('Y-m-d');
            $endDate = $time->format('Y-m-d');

            $start = new DateTime("$request->rangeStart");
            $end = new DateTime("$request->rangeEnd");

        }else{
            $start = new DateTime("$request->rangeStart");
            $end = new DateTime("$request->rangeEnd");
        }

        $startTimeFormatted = $start->format('Y-m-d');
        $endTimeFormatted = $end->format('Y-m-d');

        $data = DB::table('prd_opr_checklistp2h as p2h')
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
            'p2h.CREATED_AT',
            'p2h.VERIFIED_OPERATOR',
            'p2h.DATEVERIFIED_OPERATOR',
            'opr.PERSONALNAME as NAMAOPERATOR',
            'p2h.VERIFIED_MEKANIK',
            'p2h.DATEVERIFIED_MEKANIK',
            'mec.PERSONALNAME as NAMAMEKANIK',
            'p2h.VERIFIED_FOREMAN',
            'gl.PERSONALNAME as NAMAFOREMAN',
            'p2h.DATEVERIFIED_FOREMAN',
            'p2h.VERIFIED_SUPERVISOR',
            'spv.PERSONALNAME as NAMASUPERVISOR',
            'p2h.DATEVERIFIED_SUPERVISOR',
            'p2h.VERIFIED_SUPERINTENDENT',
            'spt.PERSONALNAME as NAMASUPERINTENDENT',
            'p2h.DATEVERIFIED_SUPERINTENDENT',
        )
        ->whereBetween(DB::raw('CAST(p2h.OPR_REPORTTIME AS DATE)'), [$startTimeFormatted, $endTimeFormatted])
        ->where(function ($query) {
            $query->whereNotNull('p2h.VERIFIED_FOREMAN')  // Jika Foreman tidak null
                ->orWhereNull('p2h.VERIFIED_SUPERVISOR') // Supervisor boleh null
                ->orWhereNull('p2h.VERIFIED_SUPERINTENDENT'); // Superintendent boleh null
        })
        ->where('p2h.STATUSENABLED', true);
        // $data = $data->where(function($query) {
        //     if (!in_array(Auth::user()->role, ['ADMIN', 'MANAGEMENT'])) {
        //         $query->where('p2h.VERIFIED_FOREMAN', Auth::user()->nik)
        //           ->orWhere('p2h.VERIFIED_SUPERVISOR', Auth::user()->nik)
        //           ->orWhere('p2h.VERIFIED_SUPERINTENDENT', Auth::user()->nik)
        //           ->orWhere('p2h.VERIFIED_MEKANIK', Auth::user()->nik);
        //     }
        // });
        $data = $data->get();

        return view('safety.p2h.show', compact('data'));
    }

    public function verifikasi(Request $request)
    {
        $request->validate([
            'VHC_ID' => 'required|string',
            'OPR_REPORTTIME' => 'required|date',
            'OPR_NRP' => 'required|string'
        ]);

        DB::beginTransaction(); // Mulai transaksi

        try {
            // Ambil semua checklist items dari SQL Server
            $checklistItems = DB::connection('focus')
                ->table('FLT_EQUCHECKLISTITEM')
                ->select('checklistgroupid','checklistitemid','checklistitemdescription')
                ->get();

            // Mapping checklist items agar selalu ada default string
            $checklistMap = [];
            foreach ($checklistItems as $item) {
                $groupId = strtoupper(trim((string)$item->checklistgroupid));
                $itemId = trim((string)$item->checklistitemid);
                $checklistMap[$groupId][$itemId] = $item->checklistitemdescription;
            }

            // Ambil detail dari PostgreSQL
            $oprReportTime = (new \DateTime($request['OPR_REPORTTIME']))->format('Y-m-d H:i:s');
            $detail = DB::connection('p2h')->table('opr_oprchecklistitem as a')
                ->select('a.id','a.equ_typeid','a.checklistgroupid','a.checklistitemid','a.checklistnotes','a.checklistval','a.opr_reporttime','a.opr_shiftdate','a.opr_shiftno','a.vhc_id')
                ->where('a.vhc_id', $request['VHC_ID'])
                ->whereRaw("date_trunc('second', a.opr_reporttime) = ?", [$oprReportTime])
                ->orderBy('a.checklistgroupid')
                ->get();

            $groupKeys = array_keys($checklistMap);
                usort($groupKeys, function ($a, $b) {
                    return strlen($b) <=> strlen($a);
                });

                $detail = $detail->map(function ($row) use ($checklistMap, $groupKeys) {
                    $groupId = strtoupper(trim((string) $row->checklistgroupid));
                    $itemId = trim((string) $row->checklistitemid);

                    $description = null;

                    // 1. Coba exact match dulu
                    if (isset($checklistMap[$groupId][$itemId])) {
                        $description = $checklistMap[$groupId][$itemId];
                    }

                    // 2. Kalau belum ketemu, coba group match
                    if ($description === null) {
                        foreach ($groupKeys as $groupKey) {
                            if (
                                ($groupId === $groupKey || str_contains($groupId, $groupKey))
                                && isset($checklistMap[$groupKey][$itemId])
                            ) {
                                $description = $checklistMap[$groupKey][$itemId];
                                break;
                            }
                        }
                    }

                    // 3. Kalau tetap belum ketemu, fallback by itemId
                    if ($description === null) {
                        foreach ($groupKeys as $groupKey) {
                            if (isset($checklistMap[$groupKey][$itemId])) {
                                $description = $checklistMap[$groupKey][$itemId];
                                break;
                            }
                        }
                    }

                    $row->checklistitemdescription = $description ?? null;

                    return $row;
                })
                // Hilangkan item double berdasarkan group + deskripsi
                ->unique(function ($row) {
                    return strtoupper(trim((string) $row->checklistgroupid)) . '|' .
                        strtoupper(trim((string) $row->checklistitemdescription));
                })
                ->values();

            $first = $detail->first();

            // Ambil atau create header P2H
            $checkdataP2H = ChecklistP2H::where('vhc_id', $first->vhc_id)
                ->where('opr_shiftno', $first->opr_shiftno)
                ->where('opr_reporttime', $first->opr_reporttime)
                ->first();

            $user = Auth::user();
            $role = strtoupper(trim($user->role));
            $departemenId = (int) $user->departemen_id;

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
                    default => abort(403, 'Anda tidak memiliki akses verifikasi untuk fitur ini.'),
                };
            } else {
                abort(403, 'Departemen tidak memiliki akses verifikasi.');
            }

            if ($checkdataP2H) {
                $checkdataP2H->update($updateData);
                $dataP2H = $checkdataP2H;
            } else {
                $dataP2H = ChecklistP2H::create(array_merge([
                    'uuid' => (string) Uuid::uuid4()->toString(),
                    'statusenabled' => true,
                    'created_by' => $user->id,
                    'vhc_id' => $first->vhc_id,
                    'mtr_hourmeter' => $request['MTR_HOURMETER'] ?? null,
                    'opr_shiftno' => $first->opr_shiftno,
                    'opr_reporttime' => $first->opr_reporttime,
                    'opr_shiftdate' => $first->opr_shiftdate,
                    'verified_operator' => $request['OPR_NRP'],
                    'dateverified_operator' => $first->opr_reporttime,
                ], $updateData));
            }

            // Insert detail P2H
            foreach ($detail as $item) {
                ChecklistP2HDetail::create([
                    'uuid' => (string) Uuid::uuid4()->toString(),
                    'uuid_opr_checklistp2h' => $dataP2H->uuid,
                    'groupid' => $item->checklistgroupid,
                    'itemdescription' => $item->checklistitemdescription,
                    'value' => $item->checklistval,
                    'notes' => $item->checklistnotes,
                    'created_by' => $user->id,
                    'statusenabled' => true,
                ]);
            }

            // foreach ($detail as $item) {
            //     ChecklistP2HDetail::updateOrCreate(
            //         [
            //             // Kunci pencarian agar tidak double
            //             'uuid_opr_checklistp2h' => $dataP2H->uuid,
            //             'groupid' => $item->checklistgroupid,
            //             'itemdescription' => $item->checklistitemdescription,
            //         ],
            //         [
            //             // Data yang di-update jika sudah ada
            //             'value' => $item->checklistval,
            //             'notes' => $item->checklistnotes,
            //             'created_by' => $user->id,
            //             'statusenabled' => true,
            //         ]
            //     );
            // }

            DB::commit();
            return response()->json(['status' => 'ok']);
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
            // return $item->CHECKLISTVAL == 0 && $item->CHECKLISTGROUPID == 'AA';
            //Kode A atau AA harus muncul
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

                                // Langkah 1: Normalisasi struktur $detailP2H agar fieldnya sepadan dengan $detail
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

                // Langkah 2: Tambahkan flag 'SOURCE' ke $detail untuk penanda asal data
                $normalizedDetail = $detail->map(function ($item) {
                    return (object)[
                    'ID' => $item->ID,
                    'CHECKLISTGROUPID' => $item->CHECKLISTGROUPID,
                    'CHECKLISTITEMID' => $item->CHECKLISTITEMID,
                    'CHECKLISTITEMDESCRIPTION' => $item->CHECKLISTITEMDESCRIPTION,
                    'CHECKLISTNOTES' => $item->CHECKLISTNOTES,
                    'CHECKLISTVAL' => $item->CHECKLISTVAL,
                    'VAL' => $item->VAL,
                    'CATATAN_MEKANIK' => null,  // Ditambahkan manual karena tidak ada di query
                    'KBJ' => null,
                    'JAWABAN' => null,
                    'OPR_REPORTTIME' => $item->OPR_REPORTTIME,
                    'OPR_SHIFTDATE' => $item->OPR_SHIFTDATE,
                    'OPR_SHIFTNO' => $item->OPR_SHIFTNO,
                    'VHC_ID' => $item->VHC_ID,
                    'SOURCE' => 'DETAIL',
                ];
                });

                // Langkah 3: Gabungkan dengan key unik berdasarkan field penting
                $keyFn = fn($item) => implode('|', [
                    $item->CHECKLISTGROUPID,
                    $item->CHECKLISTITEMDESCRIPTION,
                    $item->VHC_ID,
                    $item->OPR_REPORTTIME
                ]);

                // Step 4: Buat collection awal dari $detailP2H
                $combined = $normalizedDetailP2H->keyBy($keyFn);

                // Step 5: Tambahkan dari $detail jika belum ada
                $normalizedDetail->each(function ($item) use (&$combined, $keyFn) {
                    $key = $keyFn($item);
                    if (! $combined->has($key)) {
                        $combined->put($key, $item);
                    }
                });

                // Final output
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
       // --- Ambil semua group description dari SQL Server ---
        $groups = DB::connection('focus')
            ->table('FLT_EQUCHECKLISTGROUP')
            ->select('EQU_TYPEID','CHECKLISTGROUPID','CHECKLISTGROUPDESCRIPTION')
            ->get()
            ->keyBy(fn($row) => strtoupper(trim($row->EQU_TYPEID)) . '_' . strtoupper(trim($row->CHECKLISTGROUPID)));

        // --- Ambil semua item description dari SQL Server ---
        $checklistItems = DB::connection('focus')
            ->table('FLT_EQUCHECKLISTITEM')
            ->select('EQU_TYPEID','CHECKLISTGROUPID','CHECKLISTITEMID','CHECKLISTITEMDESCRIPTION')
            ->get();

        // Mapping item description ke array 2 dimensi [group][item]
        $checklistMap = [];
        foreach ($checklistItems as $item) {
            $groupKey = strtoupper(trim((string)$item->CHECKLISTGROUPID));
            $itemKey  = trim((string)$item->CHECKLISTITEMID);
            $checklistMap[$groupKey][$itemKey] = $item->CHECKLISTITEMDESCRIPTION;
        }

        // --- Ambil detail dari PostgreSQL ---
        $oprReportTime = (new \DateTime($request['OPR_REPORTTIME']))->format('Y-m-d H:i:s');

        $detail = DB::connection('p2h')
            ->table('opr_oprchecklistitem as a')
            ->select('a.id','a.equ_typeid','a.checklistgroupid','a.checklistitemid','a.checklistnotes','a.checklistval','a.opr_reporttime','a.opr_shiftdate','a.opr_shiftno','a.vhc_id')
            ->where('a.vhc_id', $request['VHC_ID'])
            ->when($oprReportTime, fn($q) => $q->whereRaw("date_trunc('second', a.opr_reporttime) = ?", [$oprReportTime]))
            ->orderBy('a.checklistgroupid')
            ->get();

        // --- Mapping description + fallback + hilangkan duplikasi ---
        $groupKeys = array_keys($checklistMap);
        usort($groupKeys, fn($a,$b) => strlen($b) <=> strlen($a)); // panjang dulu untuk substring match

        $detail = $detail->map(function($row) use ($groups, $checklistMap, $groupKeys) {
            $groupId = strtoupper(trim((string)$row->checklistgroupid));
            $itemId  = trim((string)$row->checklistitemid);

            $description = null;

            // 1️⃣ Exact match
            if (isset($checklistMap[$groupId][$itemId])) {
                $description = $checklistMap[$groupId][$itemId];
            }

            // 2️⃣ Substring match di groupKeys
            if ($description === null) {
                foreach ($groupKeys as $grpKey) {
                    if ((str_contains($groupId, $grpKey)) && isset($checklistMap[$grpKey][$itemId])) {
                        $description = $checklistMap[$grpKey][$itemId];
                        break;
                    }
                }
            }

            // 3️⃣ Fallback by itemId
            if ($description === null) {
                foreach ($groupKeys as $grpKey) {
                    if (isset($checklistMap[$grpKey][$itemId])) {
                        $description = $checklistMap[$grpKey][$itemId];
                        break;
                    }
                }
            }

            $row->checklistitemdescription = $description ?? 'Deskripsi tidak tersedia';
            return $row;
        })
        // Hilangkan item double berdasarkan kombinasi group + description
        ->unique(fn($row) => strtoupper(trim((string)$row->checklistgroupid)) . '|' . strtoupper(trim((string)$row->checklistitemdescription)))
        ->values();

        // --- Hitung jumlah item AA/A yang val=0 ---
        $jumlahAATerisi = $detail->filter(function ($item) {
            return $item->checklistval == 0 && ($item->checklistgroupid == 'AA' || $item->checklistgroupid == 'A');
        })->count();

        // Ambil data P2H
        $checkdataP2H = ChecklistP2H::where('VHC_ID', $detail->first()->vhc_id)
            ->where('OPR_SHIFTNO', $detail->first()->opr_shiftno)
            ->where('OPR_REPORTTIME', $detail->first()->opr_reporttime)
            ->first();

        $verifikasiMekanik = false;
        $detailP2H = "";

        if($checkdataP2H != null){
            if($checkdataP2H->VERIFIED_MEKANIK != null){
                $verifikasiMekanik = true;

                $detailP2H = DB::table('prd_opr_checklistp2h as p2h')
                ->leftJoin('prd_opr_checklistp2h_list as ph', 'p2h.UUID', '=', 'ph.UUID_OPR_CHECKLISTP2H')
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

                                // Langkah 1: Normalisasi struktur $detailP2H agar fieldnya sepadan dengan $detail
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
                // Langkah 2: Tambahkan flag 'SOURCE' ke $detail untuk penanda asal data
                $normalizedDetail = $detail->map(function ($item) {
                    return (object)[
                    'ID' => $item->id,
                    'CHECKLISTGROUPID' => $item->checklistgroupid,
                    'CHECKLISTITEMID' => $item->checklistitemid,
                    'CHECKLISTITEMDESCRIPTION' => $item->checklistitemdescription,
                    'CHECKLISTNOTES' => $item->checklistnotes,
                    'CHECKLISTVAL' => $item->checklistval,
                    'VAL' => $item->checklistval,
                    'CATATAN_MEKANIK' => null,  // Ditambahkan manual karena tidak ada di query
                    'KBJ' => null,
                    'JAWABAN' => null,
                    'OPR_REPORTTIME' => $item->opr_reporttime,
                    'OPR_SHIFTDATE' => $item->opr_shiftdate,
                    'OPR_SHIFTNO' => $item->opr_shiftno,
                    'VHC_ID' => $item->vhc_id,
                    'SOURCE' => 'DETAIL',
                ];
                });

                // Langkah 3: Gabungkan dengan key unik berdasarkan field penting
                $keyFn = fn($item) => implode('|', [
                    $item->CHECKLISTGROUPID,
                    $item->CHECKLISTITEMDESCRIPTION,
                    $item->VHC_ID,
                    $item->OPR_REPORTTIME
                ]);

                // Step 4: Buat collection awal dari $detailP2H
                $combined = $normalizedDetailP2H->keyBy($keyFn);

                // Step 5: Tambahkan dari $detail jika belum ada
                $normalizedDetail->each(function ($item) use (&$combined, $keyFn) {
                    $key = $keyFn($item);
                    if (! $combined->has($key)) {
                        $combined->put($key, $item);
                    }
                });

                // Final output
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
                'VHC_ID' => $detail->first()->vhc_id,
                'MTR_HOURMETER' => $request['MTR_HOURMETER'],
                'OPR_SHIFTNO' => $detail->first()->opr_shiftno,
                'OPR_REPORTTIME' => $detail->first()->opr_reporttime,
                'OPR_SHIFTDATE' => $detail->first()->opr_shiftdate,
                'VERIFIED_OPERATOR' => $request['OPR_NRP'],
                'DATEVERIFIED_OPERATOR' => $detail->first()->opr_reporttime,
            ]);
        }
        $detail = $detail->map(function ($row) {
            return (object)[
                'ID' => $row->id,
                'EQU_TYPEID' => strtoupper($row->equ_typeid ?? ''),
                'CHECKLISTGROUPID' => strtoupper($row->checklistgroupid ?? ''),
                'CHECKLISTITEMID' => $row->checklistitemid,
                'CHECKLISTNOTES' => $row->checklistnotes,
                'CHECKLISTVAL' => $row->checklistval,
                'OPR_REPORTTIME' => $row->opr_reporttime,
                'OPR_SHIFTDATE' => $row->opr_shiftdate,
                'OPR_SHIFTNO' => $row->opr_shiftno,
                'VHC_ID' => strtoupper($row->vhc_id ?? ''),
                'CHECKLISTITEMDESCRIPTION' => strtoupper($row->checklistitemdescription ?? null),
            ];
        });


        if(substr($detail->first()->VHC_ID, 0, 2) == 'EX'){
            return view('safety.p2h.detail.ex', compact('detail', 'jumlahAATerisi', 'verifikasiMekanik', 'detailP2H', 'checkdataP2H'));

        }elseif(substr($detail->first()->VHC_ID, 0, 2) == 'HD'){
            return view('safety.p2h.detail.hd', compact('detail', 'jumlahAATerisi', 'verifikasiMekanik', 'detailP2H', 'checkdataP2H'));

        }elseif(substr($detail->first()->VHC_ID, 0, 2) == 'BD'){
            return view('safety.p2h.detail.bd', compact('detail', 'jumlahAATerisi', 'verifikasiMekanik', 'detailP2H', 'checkdataP2H'));

        }elseif(substr($detail->first()->VHC_ID, 0, 2) == 'MG'){
            return view('safety.p2h.detail.mg', compact('detail', 'jumlahAATerisi', 'verifikasiMekanik', 'detailP2H', 'checkdataP2H'));

        }else{
            return view('safety.p2h.detail.hd', compact('detail', 'jumlahAATerisi', 'verifikasiMekanik', 'detailP2H', 'checkdataP2H'));

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
        // dd($request->all());
         if (in_array(Auth::user()->role, ['ADMIN', 'MANAGEMENT'])) {
            return redirect()->back()->with('info', 'Maaf, verifikasi hanya dapat dilakukan oleh pengawas!');
        }

        $vhcId = $request->VHC_ID;
        $shift = $request->OPR_SHIFTNO;
        $reportTime = Carbon::parse($request->OPR_REPORTTIME);

        $checkdataP2H = ChecklistP2H::where('VHC_ID', $vhcId)
        ->where('OPR_SHIFTNO', $shift)
        ->where('OPR_REPORTTIME', $reportTime)->first();

        $groupIds = $request->CHECKLISTGROUPID;
        $descriptions = $request->CHECKLISTITEMDESCRIPTION;
        $values = $request->CHECKLISTVAL;
        $notes = $request->CHECKLISTNOTES;
        $kbjs = $request->KBJ ?? [];
        $mekanik = $request->CATATAN_MEKANIK ?? [];
        $jawabans = $request->JAWABAN ?? [];

        $count = count($groupIds);

        try {
            for ($i = 0; $i < $count; $i++) {
                ChecklistP2HDetail::updateOrInsert(
                    [
                        'UUID_OPR_CHECKLISTP2H' => $checkdataP2H->UUID,
                        'GROUPID' => $groupIds[$i],
                        'ITEMDESCRIPTION' => $descriptions[$i],
                    ],
                    [
                        'UUID' => (string) Uuid::uuid4()->toString(), // <-- Tambahkan UUID
                        'VALUE' => $values[$i],
                        'NOTES' => $notes[$i],
                        'KBJ' => $kbjs[$i] ?? null,
                        'CATATAN_MEKANIK' => $mekanik[$i] ?? null,
                        'JAWABAN' => $jawabans[$i] ?? null,
                        'CREATED_BY' => Auth::user()->id,
                        'STATUSENABLED' => true,
                        'UPDATED_AT' => now(), // kalau pakai timestamps
                    ]
                );
            }
        $position = strtoupper(trim(Auth::user()->position));
        $updateData = match ($position) {
            // 1. MEKANIK (Prioritas Atas)
            'FOREMAN MEKANIK',
            'PJS FOREMAN MEKANIK',
            'JR FOREMAN MEKANIK',
            'SUPERVISOR MEKANIK',
            'LEADER MEKANIK' => [
                'VERIFIED_MEKANIK' => Auth::user()->nik,
                'DATEVERIFIED_MEKANIK' => Carbon::now(),
            ],

            // 2. PRODUKSI
            'FOREMAN' => [
                'VERIFIED_FOREMAN' => Auth::user()->nik,
                'DATEVERIFIED_FOREMAN' => Carbon::now(),
            ],
            'SUPERVISOR' => [
                'VERIFIED_SUPERVISOR' => Auth::user()->nik,
                'DATEVERIFIED_SUPERVISOR' => Carbon::now(),
            ],
            'SUPERINTENDENT' => [
                'VERIFIED_SUPERINTENDENT' => Auth::user()->nik,
                'DATEVERIFIED_SUPERINTENDENT' => Carbon::now(),
            ],

            // 3. DEFAULT (Jika posisi tidak terdaftar, dianggap Mekanik)
            default => [
                'VERIFIED_MEKANIK' => Auth::user()->nik,
                'DATEVERIFIED_MEKANIK' => Carbon::now(),
            ],
        };

        ChecklistP2H::where('UUID', $checkdataP2H->UUID)->update($updateData);

        return redirect()->route('p2h.index')->with('success', 'P2H berhasil diverifikasi');

        } catch (\Throwable $th) {
           return redirect()->route('p2h.index')->with('info', $th->getMessage());
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
            $item = $data->first(); // ambil data pertama

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
