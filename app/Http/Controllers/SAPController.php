<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SAPController extends Controller
{
    //
    public function index(Request $request)
    {
        $sap = DB::table('ref_sap as sap')
            ->leftJoin('ref_departemen as dep', 'sap.departemen_id', '=', 'dep.id')
            ->select(
                'sap.id',
                'sap.uuid',
                'sap.statusenabled',
                'sap.nama_file',
                'sap.route_name',
                'dep.keterangan as nama_departemen'
            )
            ->where('sap.statusenabled', true);

        // Search
        if ($request->filled('search')) {
            $search = trim($request->search);

            $sap->where(function ($q) use ($search) {
                $q->where('sap.nama_file', 'like', '%' . $search . '%')
                ->orWhere('dep.keterangan', 'like', '%' . $search . '%');
            });
        }

        // Sorting
        $sap = $sap
            ->orderBy('dep.keterangan', 'asc')
            ->orderBy('sap.nama_file', 'asc')
            ->get();

        $sap = $sap->filter(function ($item) {
            return canAccess($item->route_name);
        })->values();

        return view('sap.index', compact('sap'));
    }
}
