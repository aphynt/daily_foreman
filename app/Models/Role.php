<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'ref_roles';

    protected $guarded = [];

    protected $casts = [
        'allowed_routes' => 'array',
    ];

    public function routes()
    {
        return $this->belongsToMany(
            RefRoute::class,
            'role_route',
            'role_id',
            'route_id'
        );
    }
}
