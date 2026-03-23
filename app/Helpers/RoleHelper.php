<?php

use Illuminate\Support\Facades\Auth;

if (! function_exists('canAccess')) {
    function canAccess(string $routeName): bool
    {
        $user = Auth::user();
        if (! $user || ! $user->roleRel) return false;

        $roleRoutes = $user->roleRel->allowed_routes ?? [];
        if (is_string($roleRoutes)) {
            $roleRoutes = json_decode($roleRoutes, true) ?? [];
        }

        if (in_array('*', $roleRoutes)) {
            return true;
        }

        $deptRoutes = $user->departemenRel->menu_routes ?? [];
        if (is_string($deptRoutes)) {
            $deptRoutes = json_decode($deptRoutes, true) ?? [];
        }

        return in_array($routeName, $roleRoutes) || in_array($routeName, $deptRoutes);
    }

}
