<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    //
    protected $table = 'ref_departemen';

    protected $guarded = [];

    protected $casts = [
        'allowed_routes' => 'array',
    ];

    public function routes()
    {
        return $this->belongsToMany(
            RefRoute::class,
            'departemen_route',
            'departemen_id',
            'route_id'
        );
    }
}
