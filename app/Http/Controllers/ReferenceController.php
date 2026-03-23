<?php

namespace App\Http\Controllers;

use App\Models\RefConf;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    //
    public function index()
    {
        $config = RefConf::all();

        return view('reference.index', compact('config'));
    }

    public function insert(Request $request)
    {
        try {
            if($request->statusenabled == 'on'){
                $isActive = true;
            }else{
                $isActive = false;
            }
            RefConf::create([
                'keterangan' => $request->keterangan,
                'value' => $request->value,
                'statusenabled' => $isActive,
            ]);

            return redirect()->back()->with('success', 'Berhasil menambahkan reference');
        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Gagal menambahkan reference', $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        try {
            if($request->statusenabled == '1'){
                $isActive = true;
            }else{
                $isActive = false;
            }
            RefConf::where('id', $id)->update([
                'keterangan' => $request->keterangan,
                'value' => $request->value,
                'statusenabled' => $isActive,
            ]);

            return redirect()->back()->with('success', 'Berhasil update reference');
        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Gagal update reference', $th->getMessage());
        }
    }
}
