<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Departemen;
use App\Models\RefRoute;

class PermissionController extends Controller
{

    public function index()
{
    // ================= MASTER ROUTE =================
    $masterRoutes = DB::table('ref_routes')->get()->keyBy('route');
    // key = route, value = object(name, route, dll)

    // ================= DEPARTEMEN =================
    $departemenRaw = DB::table('ref_departemen')
        ->where('statusenabled', 1)
        ->get();

    $departemen = $departemenRaw->map(function ($row) use ($masterRoutes) {

        $routes = [];

        if ($row->menu_routes) {
            $json = json_decode($row->menu_routes, true);

            if (is_array($json)) {
                foreach ($json as $rt) {

                    $ref = $masterRoutes->get($rt);

                    $routes[] = [
                        'name'  => $ref->name ?? null,
                        'route' => $rt
                    ];
                }
            }
        }

        return [
            'departemen' => $row->keterangan,
            'routes' => $routes
        ];
    });


    // ================= ROLES =================
    $rolesRaw = DB::table('ref_roles')->get();

    $roles = $rolesRaw->map(function ($row) use ($masterRoutes) {

        $routes = [];

        if ($row->allowed_routes) {
            $json = json_decode($row->allowed_routes, true);

            if (is_array($json)) {
                foreach ($json as $rt) {

                    $ref = $masterRoutes->get($rt);

                    $routes[] = [
                        'name'  => $ref->name ?? null,
                        'route' => $rt
                    ];
                }
            }
        }

        return [
            'role' => $row->name,
            'routes' => $routes
        ];
    });

    return view('permission.index', compact('departemen','roles'));
}


    public function saveRole(Request $request)
    {
        $roleId = $request->role_id;
        $routes = $request->routes ?? [];

        DB::table('role_route')->where('role_id',$roleId)->delete();

        foreach ($routes as $routeId) {
            DB::table('role_route')->insert([
                'role_id'=>$roleId,
                'route_id'=>$routeId
            ]);
        }

        return back()->with('success','Role permission updated');
    }

    public function saveDept(Request $request)
    {
        $deptId = $request->departemen_id;
        $routes = $request->routes ?? [];

        DB::table('departemen_route')->where('departemen_id',$deptId)->delete();

        foreach ($routes as $routeId) {
            DB::table('departemen_route')->insert([
                'departemen_id'=>$deptId,
                'route_id'=>$routeId
            ]);
        }

        return back()->with('success','Departemen permission updated');
    }
}
