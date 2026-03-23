<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

if (!function_exists('getConfigArrayById')) {

    function getConfigArrayById(int $id): array
    {
        $value = DB::table('ref_config')
            ->where('id', $id)
            ->where('statusenabled', true)
            ->value('value');

        if (!$value) return [];

        return json_decode($value, true) ?? [];
    }
}
