<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SAPController extends Controller
{
    //
    public function index()
    {
        $sap = DB::table('ref_sap as sap')
        ->leftJoin('ref_departemen as dep', 'sap.departemen_id', 'dep.id')
        ->select(
            'sap.id',
            'sap.uuid',
            'sap.statusenabled',
            'sap.nama_file',
            'sap.route_name',
            'dep.keterangan as nama_departemen',
        )
        ->where('sap.statusenabled', true)->get()
            ->filter(function ($item) {
            return canAccess($item->route_name);
        });

        return view('sap.index', compact('sap'));
    }
}
