<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HealthyMenuController extends Controller
{

    public function index()
    {
        $data = DB::connection('kantin')->table('KANTIN_MESS.dbo.healthy_menu')->select(
                'id',
                'nik',
                'name',
                'additional',
                'updated_by',
                'deleted_by',
                'created_at',
                'updated_at'
            )
            ->orderBy('id')
            ->get();

        return response()->json([
            'success' => true,
            'total' => $data->count(),
            'data' => $data
        ]);
    }
}
