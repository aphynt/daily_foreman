<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;

class PayloadRitationController extends Controller
{
    //
    public function index()
    {
        $data = DB::connection('focus_reporting')->select('SET NOCOUNT ON;EXEC dbo.RPT_REALTIME_PAYLOAD_RITATION');

        $data = collect($data)->map(function ($item) {
            return (object) array_map(function ($value) {
                return is_numeric($value) ? round($value, 1) : $value;
            }, (array) $item);
        });


        return view('payloadritation.index', compact('data'));
    }

    public function api()
    {
        $data = DB::connection('focus_reporting')->select('SET NOCOUNT ON;EXEC dbo.RPT_REALTIME_PAYLOAD_RITATION');

        $data = collect($data);

        return response()->json($data);

        return view('payloadritation.index', compact('data'));
    }

    public function exa()
    {
        $time = new DateTime();
        $startDate = $time->format('Y-m-d');
        $endDate = $time->format('Y-m-d');
        $waktuSekarang = Carbon::now();
        $jam = $waktuSekarang->hour;
        if ($jam >= 7 && $jam < 18) {
            $shift = 6;
        } else {
            $shift = 7;
        }
        $dataexa = DB::table('focus.dbo.PRD_LOADLIST')
        ->select([
            'OPR_REPORTTIME',
            'VHC_ID',
            'LOD_LOADERID',
            'LOC_NAME',
            'OPR_NAME',
            'OPR_SHIFTNO',
            'LOD_MAT_ID',
            DB::raw('ROUND(LOD_TONNAGE, 2) as LOD_TONNAGE'),
            DB::raw('ROUND(LOD_VOLUME, 2) as LOD_VOLUME'),
            'NET_IPADDRESS',
        ])
        ->whereBetween('OPR_SHIFTDATE', [$startDate, $endDate])
        ->where('OPR_SHIFTNO', $shift)
        ->orderBy('OPR_REPORTTIME')
        ->get();
    $data = $dataexa->groupBy('LOD_LOADERID');



        return view('payloadritation.exa', compact('data'));
    }

    public function exa_new()
    {

        $time = new DateTime();

        $waktuSekarang = Carbon::now();
        $jam = $waktuSekarang->hour;
        if ($jam >= 7 && $jam < 18) {

            $shift = 6;
            $startDate = $time->format('Y-m-d');
            $endDate = $time->format('Y-m-d');
        } else {
            $shift = 7;
            $startDate = $time->format('Y-m-d');
            $endDate = $time->modify('+1 day')->format('Y-m-d');
        }

        $data = collect(DB::connection('focus_reporting')->select('SET NOCOUNT ON;EXEC dbo.RPT_REALTIME_PAYLOAD_RITATION_NEW'));

        $data = $data->filter(function ($item) {
            return !empty($item->ASG_LOADERID);
        });

        $grouped = $data->groupBy('ASG_LOADERID')->sortBy('ASG_LOADERID')->map(function ($group) {
            return $group->reduce(function ($carry, $item) use ($group) {
                $groupCount = $group->count();

                foreach ($item as $key => $value) {
                    $averageFields = [
                        'PAYLOAD_LASTHOUR',
                        'PAYLOAD_SHIFT',
                    ];

                    if (in_array($key, $averageFields) && is_numeric($value)) {
                        $carry[$key] = isset($carry[$key])
                            ? (($carry[$key] * ($groupCount - 1) + $value) / $groupCount)
                            : $value;
                    } elseif (is_numeric($value)) {
                        $carry[$key] = isset($carry[$key]) ? $carry[$key] + $value : $value;
                    } else {
                        $carry[$key] = $carry[$key] ?? $value;
                    }
                }
                return $carry;
            });
        });

        return view('payloadritation.exa_new', compact('grouped'));
    }
}
