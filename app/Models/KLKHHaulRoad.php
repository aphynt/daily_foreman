<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class KLKHHaulRoad extends Model
{
    //
    protected $table = 'prd_klkh_haulroad';

    protected $guarded = [];

    // public static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         $model->uuid = (string) Uuid::uuid4()->toString();
    //     });
    // }
}
