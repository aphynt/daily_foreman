<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefRoute extends Model
{
    //
    protected $table = 'ref_routes';

    protected $guarded = [];

    protected $casts = [
        'allowed_routes' => 'array',
    ];
}
