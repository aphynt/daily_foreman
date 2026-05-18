<?php

use Illuminate\Support\Facades\Auth;

if (! function_exists('canAccess')) {
    function canAccess(string $routeName): bool
    {
        $user = Auth::user();
        if (! $user) return false;

        // Ambil route dari user
        $userRoutes = $user->allowed_routes ?? [];
        if (is_string($userRoutes)) {
            $userRoutes = json_decode($userRoutes, true) ?? [];
        }

        // Ambil route dari role
        $roleRoutes = $user->roleRel->allowed_routes ?? [];
        if (is_string($roleRoutes)) {
            $roleRoutes = json_decode($roleRoutes, true) ?? [];
        }

        // Ambil route dari departemen
        $deptRoutes = $user->departemenRel->menu_routes ?? [];
        if (is_string($deptRoutes)) {
            $deptRoutes = json_decode($deptRoutes, true) ?? [];
        }

        // Gabungkan semua
        $allowedRoutes = array_unique(array_merge($userRoutes, $roleRoutes, $deptRoutes));

        // Jika ada '*', beri akses semua
        if (in_array('*', $allowedRoutes)) {
            return true;
        }

        return in_array($routeName, $allowedRoutes);
    }
}
