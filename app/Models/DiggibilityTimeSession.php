<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiggibilityTimeSession extends Model
{
    //
    protected $table = 'tc_diggibility_timesession';

    protected $guarded = [];

    public function passes()
    {
        return $this->hasMany(
            DiggibilityTimePass::class,
            'timesession_id',
            'id'
        );
    }
}
