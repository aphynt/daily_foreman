<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatchingFleetController extends Controller
{
    //
    public function index()
    {
        $result = DB::connection('focus_reporting')->select(
                'SET NOCOUNT ON;EXEC FOCUS_REPORTING.dbo.APP_REPORT_GET_MATCHING_FLEET_DATA'
            );

        try {
            

            $data = collect($result)->map(function ($item) {
                return (array) $item;
            });

            $matchingFleet = $data->groupBy(function ($item) {
                return $item['PIT'] ?? 'UNKNOWN';
            });

            return view('matching-fleet.index', compact(
                'matchingFleet'
            ));

        } catch (\Throwable $e) {
            return view('matching-fleet.index', [
                'matchingFleet' => collect(),
                'errorMessage' => 'Gagal mengambil data Matching Fleet.'
            ]);
        }
    }
}
