<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiggibilityTimePass extends Model
{
    //
    protected $table = 'tc_diggibility_timepass';

    protected $guarded = [];

    public function session()
    {
        return $this->belongsTo(
            DiggibilityTimeSession::class,
            'timesession_id',
            'id'
        );
    }
}
