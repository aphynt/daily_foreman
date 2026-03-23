<?php

namespace App\Http\Controllers;

use App\Models\SOP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SOPController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = DB::table('ref_sop as sop')
            ->leftJoin('ref_departemen as dep', 'sop.departemen_id', 'dep.id')
            ->select(
                'sop.id',
                'sop.uuid',
                'sop.statusenabled',
                'sop.nama_file',
                'sop.route_name',
                'dep.keterangan as nama_departemen'
            )
            ->where('sop.statusenabled', true);

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('sop.nama_file', 'like', '%' . $request->search . '%')
                ->orWhere('dep.keterangan', 'like', '%' . $request->search . '%');
            });
        }

        $sop = $query->get();

        return view('sop.index', compact('sop'));
    }

    public function preview($uuid)
    {
        $data = DB::table('ref_sop as sop')
        ->leftJoin('ref_departemen as dep', 'sop.departemen_id', 'dep.id')
        ->select(
            'sop.id',
            'sop.uuid',
            'sop.url',
            'sop.statusenabled',
            'sop.nama_file',
            'dep.keterangan as nama_departemen',
        )
        ->where('sop.uuid', $uuid)
        ->where('sop.statusenabled', true)->first();

        if (!$data) {
            return redirect()->back()->with('info', 'Maaf, SOP tidak ditemukan');
        }

        $fileUrl = route('sop.show', $uuid);

        $response = Http::withOptions([
            'verify' => false,
            'timeout' => 10,
        ])->head($data->url);


        $contentType = $response->header('Content-Type');
        return view('sop.preview', compact(
            'data',
            'fileUrl',
            'contentType'
        ));
    }
}
