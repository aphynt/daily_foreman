<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FLTVehicle extends Model
{
    //
    protected $connection = 'focus';
    protected $table = 'FLT_VEHICLE';

    protected $guarded = [];
}
